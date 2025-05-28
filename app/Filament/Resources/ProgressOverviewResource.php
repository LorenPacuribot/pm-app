<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Task;
use Filament\Tables;
use App\Models\Phase;
use App\Models\Project;
use App\Models\Progress;
use Filament\Forms\Form;
use App\Models\Milestone;
use Filament\Tables\Table;
use App\Models\ProgressOverview;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProgressOverviewResource\Pages;
use App\Filament\Resources\ProgressOverviewResource\RelationManagers;

class ProgressOverviewResource extends Resource
{
protected static ?string $model = Progress::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';
    protected static ?string $navigationLabel = 'Progress Overview';
    protected static ?string $slug = 'progress-overview';
    protected static ?string $recordTitleAttribute = 'id';
     protected static ?string $modelLabel = 'Task Details';
    protected static ?string $navigationGroup = 'PROJECT';

    protected static ?int $navigationSort = 3;

   public static function form(Form $form): Form
{
    return $form->schema([
        Section::make('Task Reference')
            ->columns(2)
            ->schema([
                Select::make('project_id')
                    ->label('Project')
                    ->options(fn () => Project::pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->disabled(),

                Select::make('milestone_id')
                    ->label('Milestone')
                    ->options(fn () => Milestone::pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->disabled(),

                Select::make('phase_id')
                    ->label('Phase')
                    ->options(fn () => Phase::pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->disabled(),

                    Select::make('assigned_people_id')
                    ->label('Assigned Person')
                    ->relationship('assignedPeople', 'name')
                    ->searchable(),

                Select::make('task_id')
                    ->label('Task')
                    ->options(fn () => Task::pluck('name', 'id'))
                    ->searchable()
                    ->required() ->columnSpanFull()
                    ->disabled(),


            ]),

        Section::make('Progress Details')
            ->columns(2)
            ->schema([


                Toggle::make('status')->label('Task Completed'),

                DatePicker::make('actual_end_date')
                    ->label('Actual End Date'),

                TimePicker::make('time_start')->label('Time Start'),
                TimePicker::make('time_end')->label('Time End'),

                TextInput::make('budget_from_sales')
                    ->label('Estimated Time (Budget)')
                    ->numeric()
                    ->suffix('hrs'),

                TextInput::make('time_consumed_by_team')
                    ->label('Actual Time')
                    ->numeric()
                    ->suffix('hrs'),

                Textarea::make('notes')
                    ->label('Notes')
                    ->columnSpanFull(),
            ]),

        Section::make('Gantt Chart Schedule')
            ->columns(2)
            ->schema([
                DatePicker::make('gantt_start_date')
                    ->label('Gantt Start Date')
                    ->default(fn ($record) => optional($record->ganttChart())->start_date)
                    ->reactive(),

                DatePicker::make('gantt_end_date')
                    ->label('Gantt End Date')
                    ->default(fn ($record) => optional($record->ganttChart())->end_date)
                    ->reactive(),

                TextInput::make('gantt_days')
                    ->label('Gantt Days')
                    ->numeric()
                    ->default(fn ($record) => optional($record->ganttChart())->days),

                TextInput::make('gantt_delay')
                    ->label('Gantt Delay')
                    ->numeric()
                    ->default(fn ($record) => optional($record->ganttChart())->delay),
            ]),
    ]);
}

    public static function table(Table $table): Table
    {
        return $table
           ->query(
                Progress::query()->with(['project', 'milestone', 'phase', 'task', 'assignedPeople'])
            )
            ->columns([
                TextColumn::make('project.name')->label('Project')  ->toggleable(isToggledHiddenByDefault: true) ->searchable() ->sortable(),
                TextColumn::make('milestone.name')->label('Milestone')  ->toggleable(isToggledHiddenByDefault: true)->searchable() ->sortable(),
                TextColumn::make('phase.name')->label('Phase')  ->toggleable(isToggledHiddenByDefault: true)->searchable() ->sortable(),
                TextColumn::make('task.name')->label('Task Name')->searchable() ->sortable(),

                TextColumn::make('start_date')->label('Start Date')
                    ->getStateUsing(fn($record) => optional($record->ganttChart())->start_date)  ->toggleable(isToggledHiddenByDefault: true)->searchable() ->sortable(),
                TextColumn::make('end_date')->label('End Date')
                    ->getStateUsing(fn($record) => optional($record->ganttChart())->end_date) ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('days')->label('Days')
                    ->getStateUsing(fn($record) => optional($record->ganttChart())->days) ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('delay')->label('Delays')
                    ->getStateUsing(fn($record) => optional($record->ganttChart())->delay) ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('actual_end_date')->label('Actual End Date') ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('estimated_hours')->label('Hours Estimate')  ->toggleable(isToggledHiddenByDefault: true)
                    ->getStateUsing(fn($record) => optional($record->ganttChart())->days * 8),
                TextColumn::make('time_consumed_by_team')->label('Actual Hours') ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('assignedPeople.name')->label('Assigned Person')->searchable() ->sortable() ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('time_start')->label('Time Start') ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('time_end')->label('Time End') ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('status')->label('Status')->formatStateUsing(
                    fn($state) => $state ? '✔️ Done' : '⏳ Pending'
                ) ->searchable() ->sortable(),
                TextColumn::make('notes')->label('Notes')->wrap()->searchable() ->sortable()  ->toggleable(isToggledHiddenByDefault: true),
            ])
->filters([
    SelectFilter::make('project_id')
        ->label('Project')
        ->relationship('project', 'name')
        ->searchable(),

    SelectFilter::make('milestone_id')
        ->label('Milestone')
        ->relationship('milestone', 'name')
        ->searchable(),

    SelectFilter::make('phase_id')
        ->label('Phase')
        ->relationship('phase', 'name')
        ->searchable(),

    SelectFilter::make('assigned_people_id')
        ->label('Assigned Person')
        ->relationship('assignedPeople', 'name')
        ->searchable(),
    Tables\Filters\SelectFilter::make('status')
        ->label('Status')
        ->options([
            1 => '✔️ Done',
            0 => '⏳ Pending',
        ]),

    Tables\Filters\Filter::make('start_date')
        ->form([
            \Filament\Forms\Components\DatePicker::make('start_from')->label('Start Date From'),
            \Filament\Forms\Components\DatePicker::make('start_until')->label('Start Date To'),
        ])
        ->query(function (Builder $query, array $data) {
            return $query->whereHas('milestone', function ($q) use ($data) {
                if ($data['start_from']) {
                    $q->whereHas('ganttChart', function ($gq) use ($data) {
                        $gq->where('start_date', '>=', $data['start_from']);
                    });
                }
                if ($data['start_until']) {
                    $q->whereHas('ganttChart', function ($gq) use ($data) {
                        $gq->where('start_date', '<=', $data['start_until']);
                    });
                }
            });
        }),

    Tables\Filters\Filter::make('end_date')
        ->form([
            \Filament\Forms\Components\DatePicker::make('end_from')->label('End Date From'),
            \Filament\Forms\Components\DatePicker::make('end_until')->label('End Date To'),
        ])
        ->query(function (Builder $query, array $data) {
            return $query->whereHas('milestone', function ($q) use ($data) {
                if ($data['end_from']) {
                    $q->whereHas('ganttChart', function ($gq) use ($data) {
                        $gq->where('end_date', '>=', $data['end_from']);
                    });
                }
                if ($data['end_until']) {
                    $q->whereHas('ganttChart', function ($gq) use ($data) {
                        $gq->where('end_date', '<=', $data['end_until']);
                    });
                }
            });
        }),
    ])



            ->actions([
                Tables\Actions\ViewAction::make(),
              // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProgressOverviews::route('/'),
         //   'create' => Pages\CreateProgressOverview::route('/create'),
            'view' => Pages\ViewProgressOverview::route('/{record}'),
            'edit' => Pages\EditProgressOverview::route('/{record}/edit'),
        ];
    }
}
