<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('task_types')->insert([
            [
                'id' => 1,
                'name' => 'Custom Wordpress',
                'created_at' => Carbon::parse('2025-02-11 14:20:35'),
                'updated_at' => Carbon::parse('2025-02-11 14:20:35'),
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'name' => 'Premium Theme',
                'created_at' => Carbon::parse('2025-02-11 14:20:35'),
                'updated_at' => Carbon::parse('2025-02-11 14:20:35'),
                'deleted_at' => null,
            ],

            [
                'id' => 3,
                'name' => 'NSC | Custom Wordpress',
                'created_at' => Carbon::parse('2025-02-11 14:20:35'),
                'updated_at' => Carbon::parse('2025-02-11 14:20:35'),
                'deleted_at' => null,
            ],
            [
                'id' => 4,
                'name' => 'NSC | Premium Theme',
                'created_at' => Carbon::parse('2025-02-11 14:20:35'),
                'updated_at' => Carbon::parse('2025-02-11 14:20:35'),
                'deleted_at' => null,
            ],



        ]);
    }
}
