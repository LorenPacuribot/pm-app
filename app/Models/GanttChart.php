<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GanttChart extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ganttcharts';

    protected $fillable = [
        'project_id',
        'milestone_id',
        'start_date',
        'end_date',
        'days',
        'delay',
        'actual_end_date',
        'budget'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function milestone(): BelongsTo
    {
        return $this->belongsTo(Milestone::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($ganttChart) {
            // Ensure days and delay are integers
            $ganttChart->days = (int) $ganttChart->days;
            $ganttChart->delay = (int) $ganttChart->delay;

            if ($ganttChart->isDirty('actual_end_date')) {
                // When manually updating actual_end_date, recalculate delay
                $calculatedEndDate = self::addBusinessDays($ganttChart->start_date, $ganttChart->days, 0);
                $ganttChart->delay = self::calculateDelay($calculatedEndDate, $ganttChart->actual_end_date);
            } elseif ($ganttChart->isDirty('delay')) {
                // When updating delay, recalculate actual_end_date
                $ganttChart->actual_end_date = self::addBusinessDays($ganttChart->start_date, $ganttChart->days, $ganttChart->delay);
            }

            // Update end_date (excluding delay)
            $ganttChart->end_date = self::addBusinessDays($ganttChart->start_date, $ganttChart->days, 0);

            $ganttChart->saveQuietly(); // Avoid infinite loop from model events

            // Update subsequent milestones
            $milestones = GanttChart::where('project_id', $ganttChart->project_id)
                ->where('start_date', '>', $ganttChart->start_date)
                ->orderBy('start_date', 'asc')
                ->get();

            $previousActualEndDate = $ganttChart->actual_end_date;

            foreach ($milestones as $milestone) {
                // Adjust the start date of the next milestone based on previous actual_end_date
                $milestone->start_date = self::getNextBusinessDay($previousActualEndDate);

                // Recalculate end dates
                $milestone->end_date = self::addBusinessDays($milestone->start_date, (int) $milestone->days, 0);
                $milestone->actual_end_date = self::addBusinessDays($milestone->start_date, (int) $milestone->days, (int) $milestone->delay);

                $milestone->saveQuietly();
                $previousActualEndDate = $milestone->actual_end_date;
            }
        });

        static::saved(function ($ganttChart) {
            $ganttChart->updateTaskMonitoring();
        });
    }

    /**
     * Add business days to a date, considering weekends.
     */
    public static function addBusinessDays($startDate, $days, $delay)
    {
        $days = (int) $days;
        $delay = (int) $delay;

        $date = Carbon::parse($startDate)->addDays($delay);
        $addedDays = 0;

        while ($addedDays < $days) {
            $date->addDay();
            if (!$date->isWeekend()) {
                $addedDays++;
            }
        }

        return $date;
    }

    /**
     * Calculate delay when actual_end_date is set manually.
     */
    public static function calculateDelay($expectedEndDate, $actualEndDate)
    {
        $expected = Carbon::parse($expectedEndDate);
        $actual = Carbon::parse($actualEndDate);
        $delay = 0;

        while ($expected->lessThan($actual)) {
            $expected->addDay();
            if (!$expected->isWeekend()) {
                $delay++;
            }
        }

        return $delay;
    }

    /**
     * Get the next business day after a given date.
     */
    public static function getNextBusinessDay($previousEndDate)
    {
        $date = Carbon::parse($previousEndDate)->addDay();

        while ($date->isWeekend()) {
            $date->addDay();
        }

        return $date;
    }
    public function updateTaskMonitoring()
    {
        $taskMonitoring = TaskMonitoringStatus::where('project_id', $this->project_id)->first();

        if ($taskMonitoring) {
            // Get the last actual_end_date of the latest milestone in the project
            $lastActualEndDate = GanttChart::where('project_id', $this->project_id)
                ->whereNotNull('actual_end_date') // Ensure we're not picking NULL values
                ->orderBy('actual_end_date', 'desc')
                ->orderBy('end_date', 'desc') // Secondary order for reliability
                ->value('actual_end_date');

            $taskMonitoring->extended_closure = $lastActualEndDate;
            $taskMonitoring->actual_closure = $lastActualEndDate; // They should both refer to the final milestone

            // Summing up all the necessary days
            $taskMonitoring->original_days = GanttChart::where('project_id', $this->project_id)->sum('days');
            $taskMonitoring->actual_days = GanttChart::where('project_id', $this->project_id)->sum('days')
                                        + GanttChart::where('project_id', $this->project_id)->sum('delay');
            $taskMonitoring->delay_days = GanttChart::where('project_id', $this->project_id)->sum('delay');

            $taskMonitoring->save();
        }
    }

}
