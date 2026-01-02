<?php

namespace RalphJSmit\Filament\Activitylog\Filament\Actions;

use Closure;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Filament\Activitylog\Filament\Infolists\Components\Timeline;

class TimelineAction extends Action
{
    protected ?Closure $modifyTimelineCallback = null;

    public static function getDefaultName(): ?string
    {
        return 'activities';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->icon('heroicon-o-bars-arrow-down')
            ->slideOver()
            ->modalWidth(Width::ExtraLarge)
            ->modalSubmitAction(fn (Action $action) => $action->hidden())
            ->label(__('filament-activitylog::translations.actions.timeline-action.label'))
            ->modalCancelActionLabel(__('filament-activitylog::translations.actions.timeline-action.modal_cancel_action_label'))
            ->mountUsing(function (Model $record, Schema $schema) {
                $schema->record($record);
            })
            ->schema(fn (Schema $schema) => [
                Timeline::make()
                    ->when($this->hasModifyTimelineCallback(), function (Timeline $timeline) use ($schema) {
                        return $schema->evaluate(
                            $this->getModifyTimelineCallback(),
                            namedInjections: [
                                'timeline' => $timeline,
                            ],
                            typedInjections: [
                                $timeline::class => $timeline,
                            ]
                        );
                    }),
            ]);
    }

    public function modifyTimelineUsing(Closure $callback): static
    {
        $this->modifyTimelineCallback = $callback;

        return $this;
    }

    public function hasModifyTimelineCallback(): bool
    {
        return $this->modifyTimelineCallback !== null;
    }

    public function getModifyTimelineCallback(): ?Closure
    {
        return $this->modifyTimelineCallback;
    }
}
