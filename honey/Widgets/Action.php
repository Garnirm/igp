<?php

namespace Honey\Widgets;

use Honey\Render\RenderResource;
use Illuminate\View\View;

class Action extends Widget
{
    private ActionRegistry $instance_registry;

    public function mount(string $identifier): void
    {
        /** @var ActionRegistry $base_instance */
        $base_instance = RenderResource::$widgets[ $identifier ];

        $this->instance_registry = $base_instance;
    }

    public function render(): View
    {
        return view('honey-widgets::action', [
            'label' => $this->instance_registry->label,
        ]);
    }
}