<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            [
                'phase_id' => 1,
                'message' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ New Project Activated \n\n Created this space for project discussion\n\n For future discussions kindly use discussion task card:\n\nExcited to work with you all in this project ',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 2,
                'message' => '🔔 Project Updates🔔\n\n✅ Sent Welcome Message to Client - date \n✅ Sent Introduction Message to Client \n✅ Sent Project Plan - Gannt Chart \n✅ Sent Content Checklist to Client\n✅ Sent Design Questionnare',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 3,
                'message' => 'Good Morning, Designer,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Template Design Creation\n\nGoal/task: Develop two high-quality template options based on the client’s needs — a homepage and an internal page — ensuring brand alignment and user focus.\n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 4,
                'message' => 'Good Morning, sir Jayclyde ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Template Review and approval from UI Lead\n\nGoal/task: Conduct an internal review of the templates to ensure they meet quality standards before client presentation.\n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 5,
                'message' => '🔔 Project Updates🔔\n\n✅ Sent Template Design for Approval \n',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 6,
                'message' => 'Good Morning, Designer ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Client Design comments\n\nGoal/task: Apply client feedback to refine the template designs in preparation for full page mockups.\n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 7,
                'message' => 'Good Morning, Designer ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Internal Pages Mockup Creation\n\nGoal/task: Create complete mockups for all internal site pages aligned with the approved template.\n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 8,
                'message' => '🔔 Project Updates🔔\n\n✅ Creating Project Plan -  Deliverables \n✅ Creating Project Presentation ',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 9,
                'message' => 'Good Morning, Sir Dan  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Project Plan & Final Design Review/Approval\n\nGoal/task: Would like to ask approval for the final designs and  project plan before moving forward\n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 10,
                'message' => 'Hi Team!
\n
\nare we excited to kick off another project??
\nYes, yes we are!
\n
\nJust got back with client approval to start with development, so let\'s officially kick off this website🚀🚀🚀
\n
\nInviting you all to 🥳 Project Kick-off | Krista van Lith Werving en Selectie Recruitment Agency Website Development  tomorrow Tuesday, January 13 · 10:00 – 11:00am
\n
\nPM Lead - Sir  Leo
\nDesign / Engineering Lead -  Sir Jayclyde
\nQA Lead Hannah - Maam Hannah
\nDeveloper
\nQA -
\nDesigner -
\n
\nMeeting Document Reference:
\nPresentation Link -
\nProject Plan-
\nFigma Link-
\n
\nGmeet Link:
',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 11,
                'message' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Slicing & Development\n\nGoal/task: Begin slicing the approved designs and coding the website components following the approved plan.\n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 12,
                'message' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Initial Full Review\n\nGoal/task: Conduct a quality assurance review to ensure the site output matches deliverables and standards.\n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 13,
                'message' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Initial Full Review Fixes\n\nGoal/task: Implement fixes identified during the initial QA review based on documented tickets.\n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 14,
                'message' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Initial Full Review Fixes Verification\n\nGoal/task: Verify the fixes completed during the initial review and confirm readiness for next steps.\n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 15,
                'message' => '🔔 Project Updates🔔\n\n✅ Sent Approval for Uploading \n',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 16,
                'message' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Devsite Client Comments\n\nGoal/task: Address final client comments before preparing the site for live upload.\n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 17,
                'message' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ User/Video Manual\n\nGoal/task: Create and deliver a video manual or guide to assist the client with future website management.\n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 18,
                'message' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Uploading/Launching\n\nGoal/task: Upload the final website to the live server and work on FFR checklist \n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 19,
                'message' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Final Full Review\n\nGoal/task: Conduct a full review of the live site to ensure quality, accuracy, and functionality.\n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 20,
                'message' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Final Full Review Fixes\n\nGoal/task: Implement any final fixes identified after the live review to meet client expectations.\n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 21,
                'message' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Final Full Review Fixes Verification\n\nGoal/task: Verify that all final fixes have been completed and the site is fully ready for client approval.\n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 22,
                'message' => '🔔 Project Updates🔔\n\n✅ Sent Review/Approval for Project Closure\n',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 23,
                'message' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Livesite Client Comments\n\nGoal/task: Address  final feedback or adjustments requested by the client after live launch.\n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 24,
                'message' => 'Good Morning, Team,  ⭐⭐⭐\nI hope you are doing well.\n\n\n✅ Project Archiving\n\nGoal/task: Archive all project documentation, backups, and resources securely.\n\nSee task card for details:\n\nRAS:\nDeadline:\n\nLet me know if you have questions or concerns. Thank you and have an amazing work day!',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'phase_id' => 25,
                'message' => 'Hi Team,\n\nJust a quick update — the [Project Name] project is now officially closed! ✅\n\nThank you to everyone — Designers, Developers, QA, and Officers — for your hard work, dedication, and teamwork.\nYour efforts made this project a success, and it’s truly appreciated.\n\nGreat work, everyone! 👏\n\nBest regards,\nLoren',
                'sentTo' => 'Team Space',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('messages')->insert($messages);
    }
}
