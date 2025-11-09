<?php

namespace Honey\Panel;

use Illuminate\Support\ServiceProvider;

abstract class PanelProvider extends ServiceProvider
{
    abstract protected function load(): Panel;

    public function boot(): void
    {
        $this->load()->registerResourcesRoutes()->registerPagesRoute();
    }

    public function register(): void
    {
    }
}