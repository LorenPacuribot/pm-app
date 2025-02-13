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



 $phases = [
    [
        'id' => 1,
        'name' => 'Project Activation',
        'description' => 'This phase is when a project is assigned to a Project Manager, officially starting the project. What happens here is that the Sales team conducts the turnover discussion, where you gather information about the project to be well-versed in what’s going to happen. The best questions to ask are: What company is this? Why do they want to build the website? What are the site pages and architectures needed to achieve the project? This phase should also include the timeline and budget that the team needs to meet.',
        'milestone_id' => 1, // Correct milestone
    ],
    [
        'id' => 2,
        'name' => 'Site Architecture & Analysis',
        'description' => 'This phase focuses on studying the project and gathering information on who is your team members. Planning and preparation are crucial at this stage, including identifying who you will be working with, their roles, and the allocated time they have to complete the project within the budget.',
        'milestone_id' => 1,
    ],
    [
        'id' => 3,
        'name' => 'Template Design Creation',
        'description' => 'This is creating two template design that the client can choose from, company SOP is the homepage and one other internal page ',
        'milestone_id' => 2,
    ],
    [
        'id' => 4,
        'name' => 'Template Review and approval from UI Lead',
        'description' => 'This is an internal process where the UI lead will check the designs made by the designer and add comments ',
        'milestone_id' => 2,
    ],
    [
        'id' => 5,
        'name' => 'Template Design Review/Approval',
        'description' => 'This phase is presenting the template design to the client and asking their preferences with the design on how it could work effectively for them. ',
        'milestone_id' => 3,
    ],
    [
        'id' => 6,
        'name' => 'Client Design comments',
        'description' => 'Is the process where the designer will improve the designs according to client comments before proceeding to mockup creation ',
        'milestone_id' => 3,
    ],
    [
        'id' => 7,
        'name' => 'Internal Pages Mockup Creation',
        'description' => 'This phase is designing the final pages of the website ',
        'milestone_id' => 4,
    ],
    [
        'id' => 8,
        'name' => 'Project Plan and Project Discussion Documentation',
        'description' => 'This phase is documenting the deliverables and creating the presentation presented to the team and client, this phase is knowing what should be done?  how to achieve it?  by this phase the PM should know what should happen in order to respond to questions that would be asked by the team or client.',
        'milestone_id' => 5,
    ],
    [
        'id' => 9,
        'name' => 'Project Plan & Final Design Review/Approval',
        'description' => 'This phase is to ensure that the project that we are making coincides with what the client ideals to happen. Present all pages to client , including the deliverables, and what should happen next, what we need from them in order to sucessfully follow throught with the plan, ensure also to build  a relationship with the client. ',
        'milestone_id' => 6,
    ],
    [
        'id' => 10,
        'name' => 'Project Discussion',
        'description' => 'This phase is to talk about the context of the project as a whole .',
        'milestone_id' => 6,
    ],
    [
        'id' => 11,
        'name' => 'Slicing & Development',
        'description' => 'This phase is when the developer assigned, is to start with slicing and development of the pages assigned to them.',
        'milestone_id' => 7,
    ],
    [
        'id' => 12,
        'name' => 'Initial Full Review',
        'description' => 'This phase is when QA assigned would go throught the deliverables sheet and the IFR sheets in order to check  if the output of the developer coincides with company standards and the deliverables that needs to be done. QA will add tickets to the workgroup that the developer assigend should work on.',
        'milestone_id' => 8,
    ],
    [
        'id' => 13,
        'name' => 'Initial Full Review Fixes',
        'description' => 'This phase is when developer would fix the tickets in the work group ',
        'milestone_id' => 8,
    ],
    [
        'id' => 14,
        'name' => 'Initial Full Review Fixes Verification',
        'description' => 'This phase is when QA make sure that tickets fixed by the Dev are good otherwise it is returned limiting to two turn around only ',
        'milestone_id' => 8,
    ],
    [
        'id' => 15,
        'name' => 'Review/Approval for Uploading & ask Hosting Credentials',
        'description' => 'This phase is to ensure that everything is prepared for hosting live',
        'milestone_id' => 9,
    ],
    [
        'id' => 16,
        'name' => 'Devsite Client Comments',
        'description' => 'This phase is when the client evaluates if the site is all goad to be uploaded in the live site ',
        'milestone_id' => 9,
    ],
    [
        'id' => 17,
        'name' => 'User/ Video Manual',
        'description' => 'Creation of the the video manual for  the users to know what the page is about ',
        'milestone_id' => 9,
    ],
    [
        'id' => 18,
        'name' => 'Uploading/Launching',
        'description' => 'This phase is when the site is hosted live ',
        'milestone_id' => 10,
    ],
    [
        'id' => 19,
        'name' => 'Final Full Review',
        'description' => 'To check if there are something wrong with the site when it is hosted live ',
        'milestone_id' => 11,
    ],
    [
        'id' => 20,
        'name' => 'Final Full Review Fixes',
        'description' => 'Make sure all tickets raised by QA are fixed',
        'milestone_id' => 11,
    ],
    [
        'id' => 21,
        'name' => 'Final Full Review Fixes Verification',
        'description' => 'This phase is when QA make sure that tickets fixed by the Dev are good otherwise it is returned limiting to two turnd arounds only ',
        'milestone_id' => 11,
    ],
    [
        'id' => 22,
        'name' => 'Review/Approval for Project Closure',
        'description' => 'To ask the client if they are all good with the site and prepare to close',
        'milestone_id' => 12,
    ],
    [
        'id' => 23,
        'name' => 'Livesite client comments',
        'description' => 'Is the phase where the client comments on what to improve before officially closing the project ',
        'milestone_id' => 12,
    ],
    [
        'id' => 24,
        'name' => 'Project archiving',
        'description' => 'This Phase is saving the read me files in sync wiki and back-uping the project',
        'milestone_id' => 12,
    ],
    [
        'id' => 25,
        'name' => 'Project Closure',
        'description' => 'To officially close the project',
        'milestone_id' => 13,
    ],
];

 // Insert Phases only if their Milestone exists
 foreach ($phases as $phase) {
     if ($phase['milestone_id']) {
         Phase::create([
             'id' => $phase['id'],
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
