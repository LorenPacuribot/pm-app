<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskCardSeeder extends Seeder
{
    public function run(): void
    {
        $taskcards = [
            [
                'phase_id' => 1,
                'name' => 'New Project Activated',
                'instruction' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ New Project Activated \n\nGoal/Task: Created this space for project discussion\n\nQuick Links you might need:\n\n\n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 2,
                'name' => 'Site Architecture & Analysis',
                'instruction' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Site Architecture & Analysis\n\nGoal/Task: Analyze the project requirements, define team structure, and plan the site’s architecture and timeline efficiently.\n\nQuick Links you might need:\n\n\n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 3,
                'name' => 'Template Design Creation',
                'instruction' => 'Good Morning, Designer,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Template Design Creation\n\nGoal/Task: Develop two high-quality template options based on the client’s needs — a homepage and an internal page — ensuring brand alignment and user focus.\n\nQuick Links you might need:\n\n- Project Documentation \n- Content Checklist\n- Design Questionnaire Responses\n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 4,
                'name' => 'Template Review and approval from UI Lead',
                'instruction' => 'Good Morning, sir Jayclyde ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Template Review and approval from UI Lead\n\nGoal/Task: Conduct an internal review of the templates to ensure they meet quality standards before client presentation.\n\nQuick Links you might need:\n\n- Figma Design \n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 5,
                'name' => 'Template Design Review/Approval',
                'instruction' => 'Good Morning, PM  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Template Design Review/Approval\n\nGoal/Task: Present templates to the client, gather their feedback, and finalize the chosen design direction.\n\nQuick Links you might need:\n\n- Figma Design \n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 6,
                'name' => 'Client Design comments',
                'instruction' => 'Good Morning, Designer ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Client Design comments\n\nGoal/Task: Apply client feedback to refine the template designs in preparation for full page mockups.\n\nQuick Links you might need:\n\n- Drive Link of the PDF \n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 7,
                'name' => 'Internal Pages Mockup Creation',
                'instruction' => 'Good Morning, Designer ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Internal Pages Mockup Creation\n\nGoal/Task: Create complete mockups for all internal site pages aligned with the approved template.\n\nQuick Links you might need:\n\n\n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 8,
                'name' => 'Project Plan and Project Discussion Documentation',
                'instruction' => 'Good Morning, PM  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Project Plan and Project Discussion Documentation\n\nGoal/Task: Finalize and document deliverables, milestones, and project plans for client and team reference.\n\nQuick Links you might need:\n\n\n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 9,
                'name' => 'Project Plan & Final Design Review/Approval',
                'instruction' => 'Good Morning, Sir Dan  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Project Plan & Final Design Review/Approval\n\nGoal/Task: Would like to ask approval for the final designs and  project plan before moving forward\n\nQuick Links you might need:\n\n- Project Plan \n- Figma\n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 10,
                'name' => 'Project Discussion',
                'instruction' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Project Discussion\n\nGoal/Task: Hold a discussion to align understanding of the project’s full context, objectives, and deliverables.\n\nQuick Links you might need:\n\n\n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 11,
                'name' => 'Slicing & Development',
                'instruction' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Slicing & Development\n\nGoal/Task: Begin slicing the approved designs and coding the website components following the approved plan.\n\nQuick Links you might need:\n\n- Devserver name \n- Project Documentation\n- Project Plan \n-  Figma File \n- Content Checklist\n- IFR Checklist \n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 12,
                'name' => 'Initial Full Review',
                'instruction' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Initial Full Review\n\nGoal/Task: Conduct a quality assurance review to ensure the site output matches deliverables and standards.\n\nQuick Links you might need:\n\n- Devsite Access\n- Project Documentation\n- Project Plan \n-  Figma File \n- Content Checklist\n- IFR Checklist \n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 13,
                'name' => 'Initial Full Review Fixes',
                'instruction' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Initial Full Review Fixes\n\nGoal/Task: Implement fixes identified during the initial QA review based on documented tickets.\n\nQuick Links you might need:\n\n- Devsite Access\n- Project Documentation\n- Project Plan \n-  Figma File \n- Content Checklist\n- IFR Checklist \n- Workgroup \n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 14,
                'name' => 'Initial Full Review Fixes Verification',
                'instruction' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Initial Full Review Fixes Verification\n\nGoal/Task: Verify the fixes completed during the initial review and confirm readiness for next steps.\n\nQuick Links you might need:\n\n- Devsite Access\n- Project Documentation\n- Project Plan \n-  Figma File \n- Content Checklist\n- IFR Checklist \n- Workgroup \n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 15,
                'name' => 'Review/Approval for Uploading & ask Hosting Credentials',
                'instruction' => 'Good Morning, PM  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Review/Approval for Uploading & ask Hosting Credentials\n\nGoal/Task: Finalize the site for deployment and request hosting credentials from the client.\n\nQuick Links you might need:\n\n\n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 16,
                'name' => 'Devsite Client Comments',
                'instruction' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Devsite Client Comments\n\nGoal/Task: Address final client comments before preparing the site for live upload.\n\nQuick Links you might need:\n\n- Figma File \n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 17,
                'name' => 'User/Video Manual',
                'instruction' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ User/Video Manual\n\nGoal/Task: Create and deliver a video manual or guide to assist the client with future website management.\n\nQuick Links you might need:\n\n- Devsite Access\n- Video Manual Instructions \n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 18,
                'name' => 'Uploading/Launching',
                'instruction' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Uploading/Launching\n\nGoal/Task: Upload the final website to the live server and work on FFR checklist \n\nQuick Links you might need:\n\n- Devsite Access\n- Hosting and Domain Credentials\n- Client Email \n- FFR Checklist \n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 19,
                'name' => 'Final Full Review',
                'instruction' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Final Full Review\n\nGoal/Task: Conduct a full review of the live site to ensure quality, accuracy, and functionality.\n\nQuick Links you might need:\n\n- Livesite Access\n- Hosting and Domain \n- Client Email \n- Project Documentation\n- Project Plan \n-  Figma File \n- Content Checklist\n- FFR Checklist \n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 20,
                'name' => 'Final Full Review Fixes',
                'instruction' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Final Full Review Fixes\n\nGoal/Task: Implement any final fixes identified after the live review to meet client expectations.\n\nQuick Links you might need:\n\n- Livesite Access\n- Hosting and Domain \n- Client Email \n- Project Documentation\n- Project Plan \n-  Figma File \n- Content Checklist\n- FFR Checklist \n- Workgroup \n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 21,
                'name' => 'Final Full Review Fixes Verification',
                'instruction' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Final Full Review Fixes Verification\n\nGoal/Task: Verify that all final fixes have been completed and the site is fully ready for client approval.\n\nQuick Links you might need:\n\n- Livesite Access\n- Hosting and Domain \n- Client Email \n- Project Documentation\n- Project Plan \n-  Figma File \n- Content Checklist\n- FFR Checklist \n- Workgroup \n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 22,
                'name' => 'Review/Approval for Project Closure',
                'instruction' => 'Good Morning, PM ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Review/Approval for Project Closure\n\nGoal/Task: Obtain client approval for official project closure.\n\nQuick Links you might need:\n\n\n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 23,
                'name' => 'Livesite Client Comments',
                'instruction' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Livesite Client Comments\n\nGoal/Task: Address  final feedback or adjustments requested by the client after live launch.\n\nQuick Links you might need:\n\n- Livesite Access\n- Hosting and Domain \n- Client Email \n- Project Documentation\n- Project Plan \n-  Figma File \n- Content Checklist\n- FFR Checklist \n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 24,
                'name' => 'Project Archiving',
                'instruction' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Project Archiving\n\nGoal/Task: Archive all project documentation, backups, and resources securely.\n\nQuick Links you might need:\n\n\n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 25,
                'name' => 'Project Closure',
                'instruction' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Project Closure\n\nGoal/Task: Finalize closure by communicating with the client and confirming completion of the project.\n\nQuick Links you might need:\n\n\n\n See here: \n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('taskcards')->insert($taskcards);
    }
}
