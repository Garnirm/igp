<?php

namespace Honey;

use Honey\Widgets\ActionModale;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class HoneyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/resources/views/form', 'honey-form');
        $this->loadViewsFrom(__DIR__.'/resources/views/layout', 'honey-layout');
        $this->loadViewsFrom(__DIR__.'/resources/views/widgets', 'honey-widgets');

        Livewire::component('honey-action-modale', ActionModale::class);
    }
}
