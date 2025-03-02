<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Milestone;
use App\Models\Phase;
use App\Models\TaskType;
use Illuminate\Support\Str;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $milestones = Milestone::all();
        $taskTypes = TaskType::all();
        $phases = Phase::all();

        foreach ($taskTypes as $taskType) {
            foreach ($phases as $phase) {
                $milestone = $milestones->random(); // Assign a random milestone

                Task::create([
                    'milestone_id' => $milestone->id,
                    'phase_id' => $phase->id,
                    'task_type_id' => $taskType->id,
                    'name' => $taskType->name . ' - ' . $phase->name,
                    'instructions' => 'Instructions for ' . $taskType->name . ' in ' . $phase->name,
                    'links' => 'https://example.com/' . Str::slug($taskType->name . '-' . $phase->name),
                ]);
            }
        }
    }
}
