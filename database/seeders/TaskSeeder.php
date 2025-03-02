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
                'milestone_id'=> 1,
                'phase_id'=> 1,
                'task_type_id'=> 1,
                'name' => 'task test',
                'created_at' => Carbon::parse('2025-02-11 14:20:35'),
                'updated_at' => Carbon::parse('2025-02-11 14:20:35'),
                'deleted_at' => null,
            ],
        ]);
    }
}


