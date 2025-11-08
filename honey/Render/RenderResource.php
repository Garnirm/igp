<?php

namespace Honey\Render;

use Honey\Render\BreadcrumbItem;
use Honey\Widgets\WidgetRegistry;
use Illuminate\View\View;

class RenderResource
{
    private string $title = '';

    /**
     * @var array<BreadcrumbItem>
     */
    private array $breadcrumb = [];

    /**
     * @var array<string,WidgetRegistry>
     */
    public static array $widgets = [];

    public function title(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param array<BreadcrumbItem> $breadcrumb
     */
    public function breadcrumb(array $breadcrumb = []): static
    {
        $this->breadcrumb = $breadcrumb;

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
            'title' => $this->title,
            'breadcrumb' => $this->breadcrumb,
        ]);
    }
}