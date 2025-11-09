<?php

namespace Honey\Widgets;

class ActionRegistry extends WidgetRegistry
{
    public string $label = '';
    public string $widget_namespace = Action::class;

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