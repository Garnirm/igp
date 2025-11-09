<?php

namespace Honey\Render;

class CompositionHeader
{
    /**
     * @var array<mixed> $items
     */
    public array $items = [];

    /**
     * @param array<mixed> $items
     */
    public function items(array $items = []): static
    {
        $this->items = $items;

        return $this;
    }
}