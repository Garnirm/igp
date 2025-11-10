<?php

namespace Honey\Widgets;

class ActionModaleRegistry extends WidgetRegistry
{
    public string $label = '';
    public string $widget_namespace = 'honey-action-modale';
    public ?string $model = null;

    /**
     * @var array<mixed> $widgets
     */
    public array $widgets = [];

    public function widgets(array $widgets): static
    {
        $this->widgets = $widgets;

        return $this;
    }

    public function model(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function widgetNamespace(string $widget_namespace): static
    {
        $this->widget_namespace = $widget_namespace;

        return $this;
    }
}