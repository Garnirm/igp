<?php

namespace Honey\Widgets;

use Honey\Render\RenderResource;
use Illuminate\View\View;

class Action extends Widget
{
    private WidgetRegistry $instance_registry;

    public function mount(string $identifier): void
    {
        /** @var WidgetRegistry $base_instance */
        //$base_instance = RenderResource::$widgets[ $identifier ];

        //$this->instance_registry = $base_instance;
    }

    public function render(): View
    {
        //$rows = $this->instance_registry->static_data;

        return view('honey-widgets::table'/*, [
            'rows' => $rows,
            'columns' => $this->instance_registry->columns,
        ]*/);
    }
}