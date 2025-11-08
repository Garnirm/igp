<?php

namespace Honey\Widgets;

use Honey\Widgets\Table\Column;

class TableRegistry extends WidgetRegistry
{
    /**
     * @var array<mixed,mixed>
     */
    public array $static_data = [];

    /**
     * @var array<Column>
     */
    public array $columns = [];

    public string $widget_namespace = Table::class;

    public function widgetNamespace(string $widget_namespace): static
    {
        $this->widget_namespace = $widget_namespace;

        return $this;
    }

    /**
     * @param array<Column> $columns
     */
    public function columns(array $columns = []): static
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * @param array<mixed,mixed> $data
     */
    public function staticData(array $data = []): static
    {
        $this->static_data = $data;

        return $this;
    }
}