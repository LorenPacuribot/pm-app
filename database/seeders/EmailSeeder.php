<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phases = [
            ['id' => 1, 'name' => 'Project Activation', 'milestone_id' => 1],
            ['id' => 2, 'name' => 'Site Architecture & Analysis', 'milestone_id' => 1],
            ['id' => 3, 'name' => 'Template Design Creation', 'milestone_id' => 2],
            ['id' => 4, 'name' => 'Template Review and approval from UI Lead', 'milestone_id' => 2],
            ['id' => 5, 'name' => 'Template Design Review/Approval', 'milestone_id' => 3],
            ['id' => 6, 'name' => 'Client Design comments', 'milestone_id' => 3],
            ['id' => 7, 'name' => 'Internal Pages Mockup Creation', 'milestone_id' => 4],
            ['id' => 8, 'name' => 'Project Plan and Project Discussion Documentation', 'milestone_id' => 5],
            ['id' => 9, 'name' => 'Project Plan & Final Design Review/Approval', 'milestone_id' => 6],
            ['id' => 10, 'name' => 'Project Discussion', 'milestone_id' => 6],
            ['id' => 11, 'name' => 'Slicing & Development', 'milestone_id' => 7],
            ['id' => 12, 'name' => 'Initial Full Review', 'milestone_id' => 8],
            ['id' => 13, 'name' => 'Initial Full Review Fixes', 'milestone_id' => 8],
            ['id' => 14, 'name' => 'Initial Full Review Fixes Verification', 'milestone_id' => 8],
            ['id' => 15, 'name' => 'Review/Approval for Uploading & ask Hosting Credentials', 'milestone_id' => 9],
            ['id' => 16, 'name' => 'Devsite Client Comments', 'milestone_id' => 9],
            ['id' => 17, 'name' => 'User/ Video Manual', 'milestone_id' => 9],
            ['id' => 18, 'name' => 'Uploading/Launching', 'milestone_id' => 10],
            ['id' => 19, 'name' => 'Final Full Review', 'milestone_id' => 11],
            ['id' => 20, 'name' => 'Final Full Review Fixes', 'milestone_id' => 11],
            ['id' => 21, 'name' => 'Final Full Review Fixes Verification', 'milestone_id' => 11],
            ['id' => 22, 'name' => 'Review/Approval for Project Closure', 'milestone_id' => 12],
            ['id' => 23, 'name' => 'Livesite client comments', 'milestone_id' => 12],
            ['id' => 24, 'name' => 'Project archiving', 'milestone_id' => 11],
            ['id' => 25, 'name' => 'Project Closure', 'milestone_id' => 13],
        ];

        $emails = [];

        foreach ($phases as $phase) {
            $emails[] = [
                'milestone_id' => $phase['milestone_id'],
                'phase_id' => $phase['id'],
                'subject' => 'Notification for ' . $phase['name'],
                'content' => 'Instructions for ' . $phase['name'] . '.',
                'response' => 'Responses for' . $phase['id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('emails')->insert($emails);
    }
}
