<?php

namespace Honey\Widgets;

use Honey\Render\RenderResource;
use Illuminate\View\View;

class ActionModale extends Widget
{
    private string $label;
    private ?string $model = null;

    /**
     * @var array<mixed> $widgets
     */
    private array $widgets = [];

    public bool $opened_modale = false;

    public function mount(string $identifier): void
    {
        /** @var ActionModaleRegistry $base_instance */
        $base_instance = RenderResource::$widgets[ $identifier ];

        $this->label = $base_instance->label;
        $this->model = $base_instance->model;
        $this->widgets = $base_instance->widgets;
    }

    public function openModale(): void
    {
        $this->opened_modale = true;
    }

    public function render(): View
    {
        return view('honey-widgets::action-modale', [
            'label' => $this->label,
        ]);
    }
}