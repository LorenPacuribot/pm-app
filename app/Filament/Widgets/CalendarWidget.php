<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Filament\Resources\EventResource;
use Saade\FilamentFullCalendar\Data\EventData;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Saade\FilamentFullCalendar\Actions\EditAction;
use Saade\FilamentFullCalendar\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Model;

class CalendarWidget extends FullCalendarWidget
{
    public Model | string | null $model = Event::class;
    protected static ?int $sort = 2;


    /**
     * Fetch calendar events between start and end range.
     */
    public function fetchEvents(array $fetchInfo): array
    {
        return Event::query()
            ->where('starts_at', '>=', $fetchInfo['start'])
            ->where('ends_at', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn (Event $event) => EventData::make()
                    ->id($event->id) // ensure you're using `id`, not `uuid`, unless routed accordingly
                    ->title($event->name)
                    ->start($event->starts_at)
                    ->end($event->ends_at)
                    ->url(
                        url: EventResource::getUrl('view', ['record' => $event->getKey()]),
                        shouldOpenUrlInNewTab: true
                    )
            )
            ->toArray();
    }

    /**
     * Calendar form schema for creating/editing events.
     */
    public function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required(),

            Forms\Components\Textarea::make('description'),

            Forms\Components\DateTimePicker::make('starts_at')
                ->required(),

            Forms\Components\DateTimePicker::make('ends_at'),

            Forms\Components\Select::make('status')
                ->options([
                    'planned' => 'Planned',
                    'ongoing' => 'Ongoing',
                    'completed' => 'Completed',
                ])
                ->required(),

            Forms\Components\ColorPicker::make('color'),

            Forms\Components\Select::make('repeat')
                ->options([
                    'none' => 'Do not repeat',
                    'daily' => 'Daily',
                    'weekly' => 'Weekly',
                    'monthly' => 'Monthly',
                ])
        ];
    }

    /**
     * Enable editing and deletion from modal actions.
     */
    protected function modalActions(): array
    {
        return [
            EditAction::make()
                ->mountUsing(function (Event $record, Form $form, array $arguments) {
                    $form->fill([
                        'name' => $record->name,
                        'description' => $record->description,
                        'starts_at' => $arguments['event']['start'] ?? $record->starts_at,
                        'ends_at' => $arguments['event']['end'] ?? $record->ends_at,
                        'status' => $record->status,
                        'color' => $record->color,
                        'repeat' => $record->repeat,
                    ]);
                }),
            DeleteAction::make(),
        ];
    }
}
