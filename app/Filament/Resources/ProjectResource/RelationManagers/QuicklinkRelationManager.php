<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class QuicklinkRelationManager extends RelationManager
{
    protected static string $relationship = 'quicklink';

    protected static bool $isLazy = false;

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Quick Links')
            ->schema([

                            TextInput::make('drive'),
                            TextInput::make('project_plan'),
                            TextInput::make('figma'),
                            TextInput::make('devsite'),
                            TextInput::make('livesite'),
                            TextInput::make('domain_credentials'),
                            TextInput::make('hosting_credentials'),
                            TextInput::make('ifr_sheet'),
                            TextInput::make('ffr_sheet'),
                            TextInput::make('project_work_group'),
                            TextInput::make('project_management'),
                            TextInput::make('architecture_analysis'),
                            TextInput::make('template_design_creation'),
                            TextInput::make('internal_td_review'),
                            TextInput::make('template_designs_approval'),
                            TextInput::make('clients_design_comments'),
                            TextInput::make('internal_pages_creation'),
                            TextInput::make('final_project_documentation'),
                            TextInput::make('project_plan_approval'),
                            TextInput::make('slicing_development'),
                            TextInput::make('initial_full_review'),
                            TextInput::make('initial_full_review_fixes'),
                            TextInput::make('initial_full_review_verification'),
                            TextInput::make('review_approval_uploading'),
                            TextInput::make('devsite_clients_comments'),
                            TextInput::make('user_video_manual'),
                            TextInput::make('project_uploading_launching'),
                            TextInput::make('final_full_review'),
                            TextInput::make('final_full_review_fixes'),
                            TextInput::make('final_full_review_verification'),
                            TextInput::make('approval_project_closure'),
                            TextInput::make('livesite_clients_comments'),
                            TextInput::make('project_closure'),
            ])
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('quicklink')
            ->heading('Quick Link 🔗')
            ->columns([
              //  TextColumn::make('project.name')->sortable()->searchable()->copyable(),
                TextColumn::make('drive')->copyable(),
                TextColumn::make('figma')->copyable(),
                TextColumn::make('devsite')->copyable(),
                TextColumn::make('livesite')->copyable(),
                TextColumn::make('project_plan')->copyable(),
                TextColumn::make('project_management')->copyable(),
                TextColumn::make('slicing_development')->copyable(),
                TextColumn::make('final_project_documentation')->copyable(),
                TextColumn::make('project_uploading_launching')->copyable(),
                TextColumn::make('approval_project_closure')->copyable(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),

                // Tables\Actions\Action::make('exportQuicklinks')
                // ->label('Export Quick Links')
                // ->icon('heroicon-o-document-arrow-down')
                // ->color('success')
                // ->action(function () {
                //     return response()->streamDownload(function () {
                //         $handle = fopen('php://output', 'w');

                //         fputcsv($handle, [
                //             'Drive',
                //             'Project Plan' ,
                //             'Figma',
                //             'Devsite',
                //             'Livesite',
                //             'Domain Credentials',
                //             'Hosting Credentials',
                //             'IFR Sheet',
                //             'FFR Sheet' ,
                //             'Project Work Group',
                //             'Project Management',
                //             'Architecture Analysis',
                //             'Template Design Creation',
                //             'Internal TD Review',
                //             'Template Designs Approval',
                //             'Clients Design Comments' ,
                //             'Internal Pages Creation' ,
                //             'Final Project Documentation' ,
                //             'Project Plan Approval',
                //             'Slicing Development' ,
                //             'Initial Full Review',
                //             'Initial Full Review Fixes' ,
                //             'Initial Full Review Verification' ,
                //             'Review Approval Uploading',
                //             'Devsite Clients Comments' ,
                //             'User Video Manual' ,
                //             'Project Uploading Launching',
                //             'Final Full Review' ,
                //             'Final Full Review Fixes' ,
                //             'Final Full Review Verification' ,
                //             'Approval Project Closure' ,
                //             'Livesite Clients Comments' ,
                //             'Project Closure' ,
                //         ]);

                //         foreach ($this->ownerRecord->quickLink as $doc) {
                //             fputcsv($handle, [
                //                 $doc->drive,
                //                 $doc->project_plan,
                //                 $doc->figma,
                //                 $doc->devsite,
                //                 $doc->livesite,
                //                 $doc->domain_credentials,
                //                 $doc->hosting_credentials,
                //                 $doc->ifr_sheet,
                //                 $doc->ffr_sheet,
                //                 $doc->project_work_group,
                //                 $doc->project_management,
                //                 $doc->architecture_analysis,
                //                 $doc->template_design_creation,
                //                 $doc->internal_td_review,
                //                 $doc->template_designs_approval,
                //                 $doc->clients_design_comments,
                //                 $doc->internal_pages_creation,
                //                 $doc->final_project_documentation,
                //                 $doc->project_plan_approval,
                //                 $doc->slicing_development,
                //                 $doc->initial_full_review,
                //                 $doc->initial_full_review_fixes,
                //                 $doc->initial_full_review_verification,
                //                 $doc->review_approval_uploading,
                //                 $doc->devsite_clients_comments,
                //                 $doc->user_video_manual,
                //                 $doc->project_uploading_launching,
                //                 $doc->final_full_review,
                //                 $doc->final_full_review_fixes,
                //                 $doc->final_full_review_verification,
                //                 $doc->approval_project_closure,
                //                 $doc->livesite_clients_comments,
                //                 $doc->project_closure,
                //             ]);

                //         }

                //         fclose($handle);
                //     }, 'quick-link.csv');
                // })
                // ->requiresConfirmation()
                // ->modalHeading('Export Quick Link')
                // ->modalSubheading('Export the current project quick links into a sheet.'),

                Tables\Actions\Action::make('exportQuicklinks')
                ->label('Export Quick Links')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action(function () {
                    $record = $this->ownerRecord; // current project record
                    $doc = $record->quicklink;    // linked QuickLink

                    $date = optional($record->updated_at)->format('Y-m-d') ?? now()->format('Y-m-d');

                    return response()->streamDownload(function () use ($doc) {
                        $handle = fopen('php://output', 'w');

                        // CSV Header
                        fputcsv($handle, ['Title', 'Link / Reference']);

                        if ($doc) {
                            $fields = [
                                'Drive' => $doc->drive,
                                'Project Plan' => $doc->project_plan,
                                'Figma' => $doc->figma,
                                'Devsite' => $doc->devsite,
                                'Livesite' => $doc->livesite,
                                'Domain Credentials' => $doc->domain_credentials,
                                'Hosting Credentials' => $doc->hosting_credentials,
                                'IFR Sheet' => $doc->ifr_sheet,
                                'FFR Sheet' => $doc->ffr_sheet,
                                'Project Work Group' => $doc->project_work_group,
                                'Project Management' => $doc->project_management,
                                'Architecture Analysis' => $doc->architecture_analysis,
                                'Template Design Creation' => $doc->template_design_creation,
                                'Internal TD Review' => $doc->internal_td_review,
                                'Template Designs Approval' => $doc->template_designs_approval,
                                'Clients Design Comments' => $doc->clients_design_comments,
                                'Internal Pages Creation' => $doc->internal_pages_creation,
                                'Final Project Documentation' => $doc->final_project_documentation,
                                'Project Plan Approval' => $doc->project_plan_approval,
                                'Slicing Development' => $doc->slicing_development,
                                'Initial Full Review' => $doc->initial_full_review,
                                'Initial Full Review Fixes' => $doc->initial_full_review_fixes,
                                'Initial Full Review Verification' => $doc->initial_full_review_verification,
                                'Review Approval Uploading' => $doc->review_approval_uploading,
                                'Devsite Clients Comments' => $doc->devsite_clients_comments,
                                'User Video Manual' => $doc->user_video_manual,
                                'Project Uploading Launching' => $doc->project_uploading_launching,
                                'Final Full Review' => $doc->final_full_review,
                                'Final Full Review Fixes' => $doc->final_full_review_fixes,
                                'Final Full Review Verification' => $doc->final_full_review_verification,
                                'Approval Project Closure' => $doc->approval_project_closure,
                                'Livesite Clients Comments' => $doc->livesite_clients_comments,
                                'Project Closure' => $doc->project_closure,
                            ];

                            foreach ($fields as $title => $value) {
                                $display = $value ?: 'Not Provided';
                                fputcsv($handle, [$title, $display]);
                            }

                        }

                        fclose($handle);
                    }, "quick-links.csv");
                })
                ->requiresConfirmation()
                ->modalHeading('Export Quick Links')
                ->modalSubheading('Download the quick links for this project into a clean sheet.')




            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
