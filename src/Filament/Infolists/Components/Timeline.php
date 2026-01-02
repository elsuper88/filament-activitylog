<?php

namespace RalphJSmit\Filament\Activitylog\Filament\Infolists\Components;

use Filament\Infolists\Components;
use RalphJSmit\Filament\Activitylog\Data\TimelineData;
use RalphJSmit\Filament\Activitylog\Filament\Infolists\Components\Timeline\ActivityTimelineItem;
use Spatie\Activitylog\Contracts\Activity;

class Timeline extends Components\Entry
{
    use Timeline\CanBeCollapsed;
    use Timeline\CanBeCompacted;
    use Timeline\CanBeSearchable;
    use Timeline\HasActivities;
    use Timeline\HasActivityBatches;
    use Timeline\HasAttributeCasts;
    use Timeline\HasAttributeLabels;
    use Timeline\HasAttributeValues;
    use Timeline\HasCauser;
    use Timeline\HasEmptyState;
    use Timeline\HasEventDescriptions;
    use Timeline\HasItemActions;
    use Timeline\HasItemBadge;
    use Timeline\HasItemBadgeColor;
    use Timeline\HasItemDateTimeFormat;
    use Timeline\HasItemDateTimeTimezone;
    use Timeline\HasItemIcon;
    use Timeline\HasItemIconColor;
    use Timeline\HasMaxHeight;
    use Timeline\HasModelLabel;

    protected string $view = 'filament-activitylog::infolists.components.timeline';

    public static function getDefaultName(): ?string
    {
        return 'activities';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->hidden(function (string $context) {
            return $context === 'create';
        });
    }

    public function getTimelineData(): TimelineData
    {
        $model = $this->getModel();

        if (! is_string($modelLabel = $this->modelLabels[$model] ?? null)) {
            $modelLabel = $model ? \Filament\Support\get_model_label($model) : null;
        }

        return new TimelineData(
            activityTimelineItems: $this->getActivities()->load(['subject', 'causer'])->map(function (Activity $activity): ActivityTimelineItem {
                return new ActivityTimelineItem($activity, $this);
            }),
            evaluationCallback: $this->evaluate(...),
            emptyStateHeading: $this->emptyStateHeading,
            emptyStateDescription: $this->emptyStateDescription,
            emptyStateIcon: $this->emptyStateIcon,
            isCompact: $this->isCompact,
            isSearchable: $this->isSearchable,
            maxHeight: $this->maxHeight,
            modelLabel: $modelLabel,
        );
    }
}
