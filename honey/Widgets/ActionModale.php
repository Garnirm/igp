<?php

namespace Honey\Widgets;

use Honey\Render\RenderResource;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class ActionModale extends Widget
{
    public bool $opened_modale = false;
    public string $label;
    public ?string $model = null;

    /**
     * @var array<mixed> $widgets
     */
    public array $widgets = [];

    public function mount(string $identifier): void
    {
        /** @var ActionModaleRegistry $base_instance */
        $base_instance = RenderResource::$widgets[ $identifier ];

        $this->label = $base_instance->label;
        $this->model = $base_instance->model;
        $this->widgets = (new Collection($base_instance->widgets))->map(fn ($widget) => $widget->toArray())->toArray();
    }

    public function closeModale(): void
    {
        $this->opened_modale = false;
    }

    public function openModale(): void
    {
        $this->opened_modale = true;
    }

    public function render(): View
    {
        return view('honey-widgets::action-modale');
    }
}