<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {

        $this->call([

        UserSeeder::class,
        MilestoneSeeder::class,
        PhaseSeeder::class,
        TaskTypeSeeder::class,
        TaskSeeder::class,
       MessageSeeder::class,
        TaskCardSeeder::class,
      //  ProjectSeeder::class,

        EmailSeeder::class,
        WebsiteStructureSeeder::class,

        VersesSeeder::class,
        AssignedPeopleSeeder::class,
        ]);
    }
}
