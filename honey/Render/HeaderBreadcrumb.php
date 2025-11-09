<?php

namespace Honey\Render;

class HeaderBreadcrumb
{
    /**
     * @var array<BreadcrumbItem> $items
     */
    private array $items = [];

    public string $view_path = 'honey-layout::page.header.breadcrumb';

    /**
     * @param array<BreadcrumbItem> $items
     */
    public function items(array $items = []): static
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return array<string,mixed>
     */
    public function viewData(): array
    {
        return [
            'items' => $this->items,
        ];
    }

    public static function make(): static
    {
        return app(static::class);
    }
}