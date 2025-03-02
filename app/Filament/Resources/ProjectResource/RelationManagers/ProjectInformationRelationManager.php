<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ProjectInformationRelationManager extends RelationManager
{
    protected static string $relationship = 'projectInformation';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Project Information')
                    ->schema([
                        Section::make('Project Details')
                            ->schema([
                                TextInput::make('client')
                                    ->label('Client')
                                    ->required(),

                                TextInput::make('contact_person')
                                    ->label('Contact Person')
                                    ->required(),

                                Select::make('task_type_id')
                                    ->relationship('taskType', 'name') // Ensure correct model relation
                                    ->label('Project Type')
                                    ->required(),

                                Select::make('platform')
                                    ->options([
                                        'WordPress' => 'WordPress',
                                        'Laravel' => 'Laravel',
                                    ])
                                    ->label('Platform')
                                    ->required(),
                            ])
                            ->columns(2), // Ensures side-by-side layout

                        Section::make('Executive Summary')
                            ->schema([
                                Textarea::make('purpose')
                                    ->label('Project Purpose')
                                    ->required(),

                                Textarea::make('project_scope')
                                    ->label('Project Scope')
                                    ->required(),

                                Textarea::make('target_audience')
                                    ->label('Target Audience')
                                    ->required(),
                                    ])
                            ->columns(3),

                            Section::make('Dates')
                            ->schema([
                                DatePicker::make('project_startdate')
                                    ->label('Start Date')
                                    ->required(),
                                DatePicker::make('project_deadline')
                                    ->label('Deadline')
                                    ->required(),

                            ])
                            ->columns(2),

                        Section::make('Technical Details')
                            ->schema([
                                TextInput::make('developing_language')
                                    ->label('Programming Language')
                                    ->required(),

                                TextInput::make('server_requirement')
                                    ->label('Server Requirements'),

                                TextInput::make('browser')
                                    ->label('Supported Browsers'),

                                TextInput::make('resolution')
                                    ->label('Screen Resolution'),

                                TextInput::make('mobile_devices')
                                    ->label('Mobile Devices Supported'),
                                TextInput::make('pages_to_test')
                                    ->label('Pages to test'),

                                TextInput::make('pages_not_to_test')
                                    ->label('Pages not to test'),
                            ])
                            ->columns(3),

                        Section::make('Design & Development')
                            ->schema([
                                TextInput::make('mockup_links')
                                    ->label('Mockup Links'),

                                TextInput::make('wireframe')
                                    ->label('Wireframe'),

                                TextInput::make('erd')
                                    ->label('ERD'),

                                TextInput::make('use_case_diagram')
                                    ->label('Use Case Diagram'),

                                TextInput::make('flowchart')
                                    ->label('Flowchart'),

                                TextInput::make('final_template_design')
                                    ->label('Final Template Design'),

                                TextInput::make('prototype_invision_mockup')
                                    ->label('Prototype/InVision Mockup'),

                                TextInput::make('content_checklist')
                                    ->label('Content Checklist'),

                                TextInput::make('sitemap')
                                    ->label('Sitemap'),


                            ])
                            ->columns(3),

                            Section::make()
                            ->schema([
                            TextInput::make('project_drive_link')
                                    ->label('Project Drive Link'),
                            ]),
                        Section::make('Project Team')
                            ->schema([
                                TextInput::make('assigned_pm')
                                    ->label('Assigned PM'),

                                TextInput::make('designer')
                                    ->label('Designer'),

                                TextInput::make('developer')
                                    ->label('Developer'),

                                TextInput::make('qa')
                                    ->label('QA Engineer'),
                            ])
                            ->columns(4),

                        Section::make('Project Links')
                            ->schema([
                                TextInput::make('test_site_link')
                                    ->label('Test Site Link'),

                                TextInput::make('access')
                                    ->label('Access Credentials'),

                                TextInput::make('livesite_link')
                                    ->label('Live Site Link'),
                            ])
                            ->columns(3),

                        Section::make('Hosting & Domain')
                            ->schema([
                                TextInput::make('wp')
                                    ->label('WordPress Credentials'),

                                TextInput::make('ftp_cpanel')
                                    ->label('FTP/CPanel'),

                                TextInput::make('db')
                                    ->label('Database Access'),

                                TextInput::make('domain_registry')
                                    ->label('Domain Registry Info'),
                            ])
                            ->columns(4),
                    ]),
            ]);
    }


    public function table(Table $table): Table
    {
        return $table
        ->recordTitleAttribute('ProjectInformation')
        ->columns([
            // TextColumn::make('project.name')
            //     ->label('Project')
            //     ->sortable()
            //     ->searchable(),

            TextColumn::make('client')
                ->label('Client')
                ->sortable()
                ->searchable(),

            TextColumn::make('contact_person')
                ->label('Contact Person')
                ->sortable()
                ->searchable(),

            TextColumn::make('taskType.name') // Ensure correct model relation
                ->label('Project Type')
                ->sortable()
                ->searchable(),

            TextColumn::make('platform')
                ->label('Platform')
                ->sortable()
                ->searchable(),
            TextColumn::make('project_startdate')
                ->label('Start Date')
                ->dateTime('F d, Y') // Example: "March 01, 2025"
                ->sortable(),
            TextColumn::make('project_deadline')
                ->label('Deadline')
                ->dateTime('F d, Y') // Example: "March 01, 2025"
                ->sortable(),

            // TextColumn::make('developing_language')
            //     ->label('Programming Language')
            //     ->sortable()
            //     ->searchable(),

            // TextColumn::make('server_requirement')
            //     ->label('Server Requirements')
            //     ->limit(50) // Limits text display to 50 characters
            //     ->sortable()
            //     ->searchable(),

            // TextColumn::make('test_site_link')
            //     ->label('Test Site')
            //     ->limit(50)
            //     ->sortable()
            //     ->searchable(),

            // TextColumn::make('livesite_link')
            //     ->label('Live Site')
            //     ->limit(50)
            //     ->sortable()
            //     ->searchable(),
        ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]));
    }
}
