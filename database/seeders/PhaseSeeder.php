<?php

namespace Database\Seeders;

use App\Models\Phase;
use App\Models\Milestone;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
 // Ensure Milestones exist before inserting Phases
 $milestones = Milestone::pluck('id', 'name'); // Get IDs by milestone names

 $phases = [
     [
         'name' => 'Phase 1',
         'description' => 'Phase 1 Description',
         'milestone_id' => $milestones['Template Design Creation'] ?? null, // Adjust based on actual names
     ],
     [
         'name' => 'Phase 2',
         'description' => 'Phase 2 Description',
         'milestone_id' => $milestones['Template Design Review/Approval'] ?? null,
     ],
     [
         'name' => 'Phase 3',
         'description' => 'Phase 3 Description',
         'milestone_id' => $milestones['Internal Pages Mockup Creation'] ?? null,
     ],
     [
         'name' => 'Phase 4',
         'description' => 'Phase 4 Description',
         'milestone_id' => $milestones['Final Documentation'] ?? null,
     ],
 ];

 // Insert Phases only if their Milestone exists
 foreach ($phases as $phase) {
     if ($phase['milestone_id']) {
         Phase::create([
             'name' => $phase['name'],
             'description' => $phase['description'],
             'milestone_id' => $phase['milestone_id'],
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now(),
         ]);
     }
 }
}
}
