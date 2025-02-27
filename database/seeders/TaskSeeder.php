<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            [
                'id' => 1,
                'phase_id' => 1,
                'milestone_id' => 1,
                'name' => 'Task 1',
                'description' => 'task 1 description',
                'documentNeeded' => 'task 1 description',
                'created_at' => Carbon::parse('2025-02-11 14:20:35'),
                'updated_at' => Carbon::parse('2025-02-11 14:20:35'),
                'deleted_at' => null,
            ],

            [
                'id' => 2,
                'phase_id' => 2,
                'milestone_id' => 1,
                'name' => 'Task 1',
                'description' => 'task 1 description',
                'documentNeeded' => 'task 1 description',
                'created_at' => Carbon::parse('2025-02-11 14:20:35'),
                'updated_at' => Carbon::parse('2025-02-11 14:20:35'),
                'deleted_at' => null,
            ],
            [
                'id' => 3,
                'phase_id' => 2,
                'milestone_id' => 2,
                'name' => 'Task 2',
                'description' => 'task 2 Description',
                'documentNeeded' => 'task 2 description',
                'created_at' => Carbon::parse('2025-02-11 14:21:00'),
                'updated_at' => Carbon::parse('2025-02-11 14:21:00'),
                'deleted_at' => null,
            ],
            [
                'id' => 4,
                'phase_id' => 3,
                'milestone_id' => 1,
                'name' => 'Task 3',
                'description' => 'task 3 description ',
                'documentNeeded' => 'task 3 description ',
                'created_at' => Carbon::parse('2025-02-11 14:21:35'),
                'updated_at' => Carbon::parse('2025-02-11 14:21:35'),
                'deleted_at' => null,
            ],
            [
                'id' => 5,
                'phase_id' => 4,
                'milestone_id' => 2,
                'name' => 'Task 4',
                'description' => 'task 4 description ',
                'documentNeeded' => 'task 4',
                'created_at' => Carbon::parse('2025-02-11 14:21:56'),
                'updated_at' => Carbon::parse('2025-02-11 14:21:56'),
                'deleted_at' => null,
            ],
        ]);
    }
}
