<x-dynamic-component
    :component="$getEntryWrapperView()"
    :entry="$entry"
>
    <div {{ $getExtraAttributeBag() }}>
        <x-filament-activitylog::timeline
            :timeline-data="$getTimelineData()"
        />
    </div>
</x-dynamic-component>