<?php

namespace Honey\Widgets;

class ActionRegistry extends WidgetRegistry
{
    private string $label = '';
    private string $view = 'honey-widgets::action';

    public string $widget_namespace = Table::class;

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