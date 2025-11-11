<?php

namespace Honey\Form;

class Form
{
    /**
     * @var array<mixed> $items
     */
    private array $items = [];

    public string $view_path = 'honey-layout::form.container';

    public function toArray(): array
    {
        return [
            'items' => $this->items,
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