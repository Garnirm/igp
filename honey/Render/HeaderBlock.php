<?php

namespace Honey\Render;

class HeaderBlock
{
    /**
     * @var array<mixed> $items
     */
    private array $items = [];

    private int $columns = 1;

    public string $view_path = 'honey-layout::page.header.block';

    public function columns(int $columns): static
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * @param array<mixed> $items
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