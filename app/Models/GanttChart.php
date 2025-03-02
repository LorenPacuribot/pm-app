<?php

namespace App\Models;

use DateTime;
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
        if ($ganttChart->isDirty(['days', 'delay'])) { // Only trigger when days or delay changes
            // Recalculate the end date of the current milestone
            $ganttChart->end_date = $ganttChart->addBusinessDays($ganttChart->start_date, $ganttChart->days, $ganttChart->delay);

            // Update all subsequent milestones
            $milestones = GanttChart::where('project_id', $ganttChart->project_id)
                ->where('start_date', '>=', $ganttChart->start_date)
                ->orderBy('start_date', 'asc')
                ->get();

            $previousEndDate = $ganttChart->end_date; // Start from the updated milestone

            foreach ($milestones as $milestone) {
                if ($milestone->id !== $ganttChart->id) { // Skip the currently updated milestone
                    // Set new start date (next business day)
                    $milestone->start_date = $ganttChart->getNextMilestoneStartDate($previousEndDate);

                    // Calculate new end date
                    $milestone->end_date = $ganttChart->addBusinessDays($milestone->start_date, $milestone->days, $milestone->delay);

                    $milestone->save(); // Save changes
                    $previousEndDate = $milestone->end_date; // Update for the next iteration
                }
            }
        }
    });
}


}
