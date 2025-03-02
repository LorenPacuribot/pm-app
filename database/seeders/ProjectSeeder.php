<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'id' => 1,
                'name' => 'Project ABC',
                'created_at' => Carbon::parse('2025-02-11 14:20:35'),
                'updated_at' => Carbon::parse('2025-02-11 14:20:35'),
                'deleted_at' => null,
            ],

            [
                'id' => 2,
                'name' => 'Project XYZ',
                'created_at' => Carbon::parse('2025-02-11 14:20:35'),
                'updated_at' => Carbon::parse('2025-02-11 14:20:35'),
                'deleted_at' => null,
            ],
        ]);
    }
}
