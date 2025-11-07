<?php

namespace Honey\Render;

use Honey\Render\BreadcrumbItem;
use Illuminate\View\View;

class RenderResource
{
    private string $title = '';

    /**
     * @var array<BreadcrumbItem>
     */
    private array $breadcrumb = [];

    /**
     * @var array
     */
    private array $widgets = [];

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

    public function widgets(array $widgets = []): static
    {
        $this->widgets = $widgets;

        return $this;
    }

    public function view(): View
    {
        return view('honey-layout::base', [
            'widgets' => $this->widgets,
            'title' => $this->title,
            'breadcrumb' => $this->breadcrumb,
        ]);
    }
}