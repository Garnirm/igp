<?php

namespace Honey;

use Illuminate\Support\ServiceProvider;

class HoneyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/resources/views/layout', 'honey-layout');
        $this->loadViewsFrom(__DIR__.'/resources/views/widgets', 'honey-widgets');
    }
}
