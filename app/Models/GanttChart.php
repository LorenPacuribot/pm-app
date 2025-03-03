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
            if ($ganttChart->isDirty(['days', 'delay'])) {
                // Ensure delay and days are integers
                $ganttChart->days = (int) $ganttChart->days;
                $ganttChart->delay = (int) $ganttChart->delay;

                // Recalculate the end date
                $ganttChart->end_date = self::addBusinessDays($ganttChart->start_date, $ganttChart->days, $ganttChart->delay);

                $ganttChart->saveQuietly();

                // Get all subsequent milestones
                $milestones = GanttChart::where('project_id', $ganttChart->project_id)
                    ->where('start_date', '>', $ganttChart->start_date)
                    ->orderBy('start_date', 'asc')
                    ->get();

                $previousEndDate = $ganttChart->end_date;

                foreach ($milestones as $milestone) {
                    $milestone->start_date = self::getNextMilestoneStartDate($previousEndDate);
                    $milestone->end_date = self::addBusinessDays($milestone->start_date, (int) $milestone->days, (int) $milestone->delay);

                    $milestone->saveQuietly();
                    $previousEndDate = $milestone->end_date;
                }
            }
        });
    }



    /**
     * Add business days to a date, considering weekends.
     */
    public static function addBusinessDays($startDate, $days, $delay)
    {
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
     * Get the next available business day as the start date.
     */
    public static function getNextMilestoneStartDate($previousEndDate)
    {
        $date = Carbon::parse($previousEndDate)->addDay();

        while ($date->isWeekend()) {
            $date->addDay();
        }

        return $date;
    }
}
