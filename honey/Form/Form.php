<?php

namespace Honey\Form;

use Illuminate\Support\Collection;

class Form
{
    /**
     * @var array<mixed> $items
     */
    private array $items = [];

    public string $view_path = 'honey-form::container';

    public function toArray(): array
    {
        return [
            'items' => (new Collection($this->items))->map(fn ($item) => $item->toArray()),
            'view_path' => $this->view_path,
        ];
    }

    public function items(array $items): static
    {
        $this->items = $items;

        return $this;
    }

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