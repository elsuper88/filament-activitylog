<?php

namespace RalphJSmit\Filament\Activitylog;

use Filament\Contracts\Plugin;
use Filament\Facades\Filament;
use Filament\Panel;

class FilamentActivitylog implements Plugin
{
    public static function make(): static
    {
        $plugin = app(static::class);

        $plugin->setUp();

        return $plugin;
    }

    public static function get(?Panel $panel = null): static
    {
        $panel ??= Filament::getCurrentOrDefaultPanel();

        return $panel->getPlugin(app(static::class)->getId());
    }

    public static function isRegistered(?Panel $panel = null): bool
    {
        $panel ??= Filament::getCurrentOrDefaultPanel();

        return $panel->hasPlugin(app(static::class)->getId());
    }

    public function getId(): string
    {
        return 'ralphjsmit/laravel-filament-activitylog';
    }

    public function register(Panel $panel): void
    {
        //
    }

    public function boot(Panel $panel): void
    {
        //
    }

    protected function setUp(): void
    {
        //
    }
}
