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
            Forms\Components\Section::make('Project Information')
            ->schema([
            Forms\Components\Section::make('Project Details')
            ->schema([
            // Select::make('project_id')
            //     ->relationship('project', 'name')
            //     ->required(),
            TextInput::make('client')
            ->required(),
            TextInput::make('contact_person')
            ->required(),
           // TextInput::make('project_type'),
            Select::make('project_type')
            ->options([
                'NSC Premium Theme' => 'NSC Premium Theme',
                'NSC Custom' => 'NSC Custom',
                'Premium Theme' => 'Premium Theme',
                'Custom' => 'Custom',
                'Maintenance' => 'Maintenance',
            ])
            ->required(),
            // TextInput::make('platform')
            // ->required(),
            Select::make('platform')
            ->options([
                'Wordpress' => 'Wordpress',
                'Laravel' => 'Laravel',
            ])
            ]),
            Forms\Components\Section::make('Executive Summary ')
            ->schema([
            Textarea::make('purpose')
            ->required(),
            TextInput::make('target_audience')
            ->required(),
            DatePicker::make('project_deadline')
            ->required(),
            Textarea::make('project_scope')
            ->required(),
            TextInput::make('developing_language')
            ->required(),
            TextInput::make('server_requirement'),

        ]),
        Forms\Components\Section::make('Executive Summary ')
        ->schema([
            TextInput::make('browser'),
            TextInput::make('resolution'),
            TextInput::make('mobile_devices'),
            Textarea::make('pages_to_test'),
            Textarea::make('pages_not_to_test'),

        ])->columns(3),
        Forms\Components\Section::make('Executive Summary ')
            ->schema([
            TextInput::make('mockup_links'),
            TextInput::make('wireframe'),
            TextInput::make('erd'),
            TextInput::make('use_case_diagram'),
            TextInput::make('flowchart'),
            TextInput::make('final_template_design'),
            TextInput::make('prototype_invision_mockup'),
            TextInput::make('content_checklist'),
            TextInput::make('sitemap'),
            TextInput::make('project_drive_link'),
            ]),
        Forms\Components\Section::make('Executive Summary ')
            ->schema([
            TextInput::make('assigned_pm'),
            TextInput::make('designer'),
            TextInput::make('developer'),
            TextInput::make('qa'),
            ])->columns(4),
            Section::make()
            ->schema([
            TextInput::make('test_site_link'),
            TextInput::make('access'),
            TextInput::make('livesite_link'),
            ])->columns(3),
            Section::make()
            ->schema([
            TextInput::make('wp'),
            TextInput::make('ftp_cpanel'),
            TextInput::make('db'),
            TextInput::make('domain_registry'),
            ])->columns(4),

        ]),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ProjectInformation')
            ->columns([
                TextColumn::make('project.name')->label('Project'),
                TextColumn::make('client')->sortable()->searchable(),
                TextColumn::make('contact_person')->sortable()->searchable(),
                TextColumn::make('project_type')->sortable()->searchable(),
                TextColumn::make('platform')->sortable()->searchable(),
                TextColumn::make('project_deadline')->date(),
                // TextColumn::make('overview')->limit(50),
                // TextColumn::make('projectType'),
                // TextColumn::make('platform'),
                // TextColumn::make('methodology'),
                // TextColumn::make('problem')->limit(50),
                // TextColumn::make('solution')->limit(50),
                // TextColumn::make('impact')->limit(50),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
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
