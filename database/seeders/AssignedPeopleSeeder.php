<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssignedPeopleSeeder extends Seeder
{
    public function run(): void
    {
        $people = [
            ['name' => 'Loren', 'role' => 'Project Manager'],
            ['name' => 'Maverick', 'role' => 'Designer'],
            ['name' => 'Reymar', 'role' => 'Designer'],
            ['name' => 'Christian', 'role' => 'Developer'],
            ['name' => 'Jegg', 'role' => 'Developer'],
            ['name' => 'Jovel', 'role' => 'Developer'],
            ['name' => 'Awill', 'role' => 'Developer'],
            ['name' => 'Jomart', 'role' => 'Developer'],
            ['name' => 'Leo', 'role' => 'PM Lead'],
            ['name' => 'Clyde', 'role' => 'Engineering Lead'],
            ['name' => 'Hannah', 'role' => 'QA Lead'],
        ];

        foreach ($people as $person) {
            DB::table('assigned_people')->insert([
                'name' => $person['name'],
                'role' => $person['role'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
