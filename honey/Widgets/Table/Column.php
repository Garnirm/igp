<?php

namespace Honey\Widgets\Table;

abstract class Column
{
    public string $field = '';
    public string $label = '';

    public function field(string $field): static
    {
        $this->field = $field;

        return $this;
    }

    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public static function make(): static
    {
        return app(static::class);
    }
}