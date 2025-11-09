<?php

namespace Honey\Render;

use Honey\Widgets\WidgetRegistry;
use Illuminate\View\View;

class RenderResource
{
    private CompositionHeader $composition_header;

    /**
     * @var array<string,WidgetRegistry> $widgets
     */
    public static array $widgets = [];

    /**
     * @var array<string,WidgetRegistry>
     */
    public static array $primary_content_widgets = [];

    public function __construct()
    {
        $this->composition_header = new CompositionHeader();
    }

    /**
     * @param array<mixed> $items
     */
    public function header(array $items = []): static
    {
        $this->composition_header->items($items);

        return $this;
    }

    /**
     * @param array<WidgetRegistry> $widgets
     */
    public function widgets(array $widgets = []): static
    {
        foreach ($widgets as $widget) {
            self::$primary_content_widgets[ $widget->identifier ] = $widget;
        }

        return $this;
    }

    public function view(): View
    {
        return view('honey-layout::base', [
            'widgets' => self::$primary_content_widgets,
            'header' => $this->composition_header,
        ]);
    }
}