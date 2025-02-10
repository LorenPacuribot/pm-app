<?php

namespace Database\Seeders;

use App\Models\Milestone;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MilestoneSeeder extends Seeder
{
    public function run()
    {
        $milestones = [
            'Site Architecture & Analysis',
            'Template Design Creation',
            'Template Design Review/Approval',
            'Internal Pages Mockup Creation',
            'Final Documentation',
            'Project Plan Review/Approval',
            'Slicing & Development',
            'Initial Full Review (QA)',
            'Review/Approval for Uploading',
            'Uploading/Launching',
            'Final Full Review (QA)',
            'Review/Approval for Project Closure / Video Manual',
            'Project Closure',
        ];

        foreach ($milestones as $milestone) {
            Milestone::create([
                'name' => $milestone,
            ]);
        }
    }
}
