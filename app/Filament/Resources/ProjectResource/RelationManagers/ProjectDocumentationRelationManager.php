<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Set;
use App\Models\WebsiteStructure;
use Filament\Resources\RelationManagers\RelationManager;
use App\Exports\ProjectDocumentationTemplateExport;
use Maatwebsite\Excel\Facades\Excel;

class ProjectDocumentationRelationManager extends RelationManager
{
    protected static string $relationship = 'projectDocumentation';
    protected static bool $isLazy = false;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Project Sections')
                    ->schema([
                        Forms\Components\TextInput::make('page')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('section_number')
                            ->numeric()
                            ->label('Section Number')
                            ->nullable(),

                        Forms\Components\TextInput::make('section_name')
                            ->label('Section Name')
                            ->maxLength(255)
                            ->nullable(),

                        Forms\Components\Select::make('section_type')
                            ->label('Section Type')
                            ->options(
                                WebsiteStructure::pluck('section_type', 'section_type')
                            )
                            ->searchable()
                            ->reactive()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('section_type')
                                    ->label('Section Type Name')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\Textarea::make('elements')
                                    ->label('Elements')
                                    ->rows(5)
                                    ->required(),

                                Forms\Components\Textarea::make('placeholder')
                                    ->label('Placeholder')
                                    ->rows(5)
                                    ->nullable(),

                                Forms\Components\Textarea::make('functionality')
                                    ->label('Functionality')
                                    ->rows(5)
                                    ->required(),
                            ])
                            ->createOptionUsing(function (array $data) {
                                $websiteStructure = WebsiteStructure::create([
                                    'section_type' => $data['section_type'],
                                    'element' => $data['elements'],        // Use 'elements' not 'element'
                                    'placeholder' => $data['placeholder'] ?? null,
                                    'functionality' => $data['functionality'],
                                    'deliverable' => $data['deliverable'],
                                    'video_manual' => $data['video_manual'],
                                ]);

                                return $websiteStructure->section_type; // Return value that matches Select options
                            })
                            ->afterStateUpdated(function (Set $set, $state) {
                                $blueprint = WebsiteStructure::where('section_type', $state)->first();

                                if ($blueprint) {
                                    $set('elements', $blueprint->element);
                                    $set('placeholder', $blueprint->placeholder);
                                    $set('functionality', $blueprint->functionality);
                                    $set('deliverable', $blueprint->deliverable);
                                    $set('video_manual', $blueprint->video_manual);
                                } else {
                                    $set('elements', '');
                                    $set('placeholder', '');
                                    $set('functionality', '');
                                    $set('deliverable', '');
                                    $set('video_manual', '');
                                }
                            })
                            ->required(),

                        Forms\Components\Textarea::make('elements')
                            ->label('Elements')
                            ->rows(5)
                            ->nullable(),

                        Forms\Components\Textarea::make('placeholder')
                            ->label('Placeholder')
                            ->rows(5)
                            ->nullable(),

                        Forms\Components\Textarea::make('functionality')
                            ->label('Functionality')
                            ->rows(5)
                            ->nullable(),
                            Forms\Components\Textarea::make('placeholder')
                            ->label('Placeholder')
                            ->rows(5)
                            ->nullable(),
                        Forms\Components\Textarea::make('deliverable')
                            ->label('Deliverable')
                            ->rows(5)
                            ->nullable(),

                        Forms\Components\TextInput::make('video_manual')
                            ->label('Video Manual')
                            ->maxLength(255)
                            ->nullable(),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('page')
            ->columns([
                Tables\Columns\TextColumn::make('page')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('section_number')
                    ->label('Section No.')
                    ->sortable(),

                Tables\Columns\TextColumn::make('section_name')
                    ->label('Section Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('section_type')
                    ->label('Section Type')
                    ->sortable()
                    ->searchable(),

                    Tables\Columns\TextColumn::make('elements')
                    ->label('Elements')
                    ->html()
                    ->formatStateUsing(function ($state) {
                        return nl2br(e($state));
                    })
                    ->limit(300)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('functionality')
                    ->label('Functionality')
                    ->wrap()
                    ->limit(30),

                    Tables\Columns\TextColumn::make('placeholder')
                    ->label('Placeholder')
                    ->wrap()
                    ->limit(30),

                Tables\Columns\TextColumn::make('deliverable')
                    ->label('Deliverable')
                    ->wrap()
                    ->limit(30),

                Tables\Columns\TextColumn::make('video_manual')
                    ->label('Video Manual')
                    ->wrap()
                    ->limit(30),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\Action::make('exportChecklist')
                ->label('Export Documentation')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action(function () {
                    $exporter = new ProjectDocumentationTemplateExport($this->ownerRecord);
                    return $exporter->download();
                })
                ->requiresConfirmation()
                ->modalHeading('Export Documentation')
                ->modalSubheading('Export the current project documentation using the Excel template.')








                // Tables\Actions\Action::make('exportChecklist')
                //     ->label('Export Documentation')
                //     ->icon('heroicon-o-document-arrow-down')
                //     ->color('success')
                //     ->action(function () {
                //         return response()->streamDownload(function () {
                //             $handle = fopen('php://output', 'w');

                //             fputcsv($handle, [
                //                 'Page', 'Section Number', 'Section Name', 'Section Type',
                //                 'Elements', 'Placeholder', 'Functionality', 'Deliverable'
                //             ]);

                //             foreach ($this->ownerRecord->projectDocumentation as $doc) {
                //                 fputcsv($handle, [
                //                     $doc->page,
                //                     $doc->section_number,
                //                     $doc->section_name,
                //                     $doc->section_type,
                //                     $doc->elements,
                //                     $doc->placeholder,
                //                     $doc->functionality,
                //                     $doc->deliverable,
                //                 ]);
                //             }

                //             fclose($handle);
                //         }, 'content-checklist.csv');
                //     })
                //     ->requiresConfirmation()
                //     ->modalHeading('Export Documentation')
                //     ->modalSubheading('Export the current project documentation into a sheet.'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
