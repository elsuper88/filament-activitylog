<?php

namespace RalphJSmit\Filament\Activitylog\Filament\Infolists\Components\Timeline;

use Closure;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Models\Activity as ActivityModel;

trait HasActivityBatches
{
    protected bool | Closure $areBatchActivitiesVisible = true;

    protected bool | Closure $isBatchInline = false;

    protected ?Closure $getBatchActivitiesCallback = null;

    protected ?Closure $modifyBatchActivitiesQueryCallback = null;

    public function batches(bool | Closure $visible = true): static
    {
        $this->areBatchActivitiesVisible = $visible;

        return $this;
    }

    public function inlineBatches(bool | Closure $inline = true): static
    {
        $this->isBatchInline = $inline;

        return $this;
    }

    public function getBatchActivitiesUsing(?Closure $callback): static
    {
        $this->getBatchActivitiesCallback = $callback;

        return $this;
    }

    public function modifyBatchActivitiesQueryUsing(?Closure $callback): static
    {
        $this->modifyBatchActivitiesQueryCallback = $callback;

        return $this;
    }

    public function areBatchActivitiesVisible(): bool
    {
        return $this->evaluate($this->areBatchActivitiesVisible);
    }

    public function isBatchInline(): bool
    {
        return $this->evaluate($this->isBatchInline);
    }

    /**
     * @return EloquentCollection<array-key, Activity>
     */
    public function getBatchActivities(Activity $activity, string $batchUuid): EloquentCollection
    {
        if (! $this->areBatchActivitiesVisible()) {
            return new EloquentCollection();
        }

        $callback = $this->getBatchActivitiesCallback ?? function (string $batchUuid, Activity $activity) {
            $activityModelClass = config()->get('activitylog.activity_model', ActivityModel::class);

            $query = $activityModelClass::forBatch($batchUuid)
                ->with(['subject', 'causer'])
                ->whereHas('subject')
                ->where('id', '!=', $activity->id);

            if ($this->modifyBatchActivitiesQueryCallback) {
                $query = $this->evaluate(
                    value: $this->modifyBatchActivitiesQueryCallback,
                    namedInjections: [
                        'query' => $query,
                        'batchUuid' => $batchUuid,
                        'activity' => $activity,
                    ],
                    typedInjections: [
                        $query::class => $query,
                        Activity::class => $activity,
                        $activity::class => $activity,
                    ]
                );
            }

            return $query->get();
        };

        /** @var EloquentCollection<array-key, Activity> $batchActivities */
        $batchActivities = $this->evaluate(
            value: $callback,
            namedInjections: [
                'batchUuid' => $batchUuid,
                'activity' => $activity,
            ],
            typedInjections: [
                Activity::class => $activity,
                $activity::class => $activity,
            ],
        );

        if ($batchActivities->contains($activity)) {
            $batchActivities = $batchActivities->reject(function (Activity $batchActivity) use ($activity) {
                return $batchActivity->is($activity);
            });
        }

        return $batchActivities->prepend($activity)->sortByDesc('id')->load(['subject', 'causer'])->values();
    }
}
