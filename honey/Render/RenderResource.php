<?php

namespace Honey\Render;

use Honey\Widgets\WidgetRegistry;
use Illuminate\View\View;

class RenderResource
{
    private CompositionHeader $composition_header;

    /**
     * @var array<string,WidgetRegistry>
     */
    public static array $widgets = [];

    public function __construct()
    {
        $this->composition_header = new CompositionHeader();
    }

    public function header(): static
    {
        return $this;
    }

    public function title(string $title): static
    {
        $this->composition_header->title = $title;

        return $this;
    }

    /**
     * @param array<WidgetRegistry> $widgets
     */
    public function widgets(array $widgets = []): static
    {
        foreach ($widgets as $widget) {
            $identifier = $widget->identifier ?? uniqid();

            self::$widgets[ $identifier ] = $widget;
        }

        return $this;
    }

    public function view(): View
    {
        return view('honey-layout::base', [
            'widgets' => self::$widgets,
            'title' => $this->composition_header->title,
            'breadcrumb' => [],// $this->breadcrumb,
        ]);
    }
}