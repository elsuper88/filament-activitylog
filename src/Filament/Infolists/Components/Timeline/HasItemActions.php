<?php

namespace RalphJSmit\Filament\Activitylog\Filament\Infolists\Components\Timeline;

use Filament\Actions;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Models\Activity as ActivityModel;

trait HasItemActions
{
    /**
     * @var array<string, array<string, <array<array-key,Actions\Action>>>>
     */
    protected array $itemActions = [];

    /**
     * @param  array<array-key, Actions\Action>  $actions
     */
    public function itemActions(string $event, array $actions, string | array $subjectScopes = []): static
    {
        $subjectScopes = Arr::wrap($subjectScopes);

        if (! $subjectScopes) {
            $subjectScopes = ['default'];
        }

        foreach ($actions as $action) {
            $action->schemaComponent($this);
        }

        $this->registerActions($actions);

        foreach ($subjectScopes as $subjectScope) {
            $this->itemActions[$subjectScope][$event] = [
                ...$this->itemActions[$subjectScope][$event] ?? [],
                ...$actions,
            ];
        }

        return $this;
    }

    /**
     * @return array<array-key, Actions\Action>
     */
    public function getItemActions(Activity | ActivityModel $activity): array
    {
        $subjectType = $activity->subject_type ? (Relation::getMorphedModel($activity->subject_type) ?? $activity->subject_type) : null;

        /** @var array<array-key, Actions\Action> $actions */
        $actions = $subjectType && Arr::has($this->itemActions, "{$subjectType}.{$activity->event}")
            ? $this->itemActions[$subjectType][$activity->event]
            : (
                $subjectType && Arr::has($this->itemActions, "{$subjectType}.*")
                        ? $this->itemActions[$subjectType]['*']
                        : $this->itemActions['default'][$activity->event] ?? $this->itemActions['default']['*'] ?? []
            );

        return array_map(
            callback: function (Actions\Action $action) use ($activity) {
                $clone = clone $action;

                $clone->arguments(['activity_id' => $activity->getKey()]);

                return $clone;
            },
            array: $actions
        );
    }
}
