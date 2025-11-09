<?php

namespace Honey\Render;

class HeaderBlock
{
    /**
     * @var array<BreadcrumbItem> $items
     */
    private array $items = [];

    private int $columns = 1;

    public function columns(int $columns): static
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * @param array<BreadcrumbItem> $items
     */
    public function items(array $items = []): static
    {
        $this->items = $items;

        return $this;
    }

    public static function make(): static
    {
        return app(static::class);
    }
}