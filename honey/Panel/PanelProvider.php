<?php

namespace Honey\Panel;

use Illuminate\Support\ServiceProvider;

abstract class PanelProvider extends ServiceProvider
{
    /**
     * @return array<Panel>
     */
    abstract protected function load(): array;

    public function boot(): void
    {
        $panels = $this->load();

        foreach ($panels as $panel) {
            $panel->registerResourcesRoutes()->registerPagesRoute();
        }
    }

    public function register(): void
    {
    }
}