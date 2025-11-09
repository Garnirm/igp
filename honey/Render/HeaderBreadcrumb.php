<?php

namespace Honey\Render;

class HeaderBreadcrumb
{
    /**
     * @var array<BreadcrumbItem> $items
     */
    private array $items = [];

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