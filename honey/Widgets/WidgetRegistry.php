<?php

namespace Honey\Widgets;

abstract class WidgetRegistry
{
    public string $identifier = '';

    public function identifier(string $identifier): static
    {
        $this->identifier = $identifier;

        return $this;
    }

    public static function make(): static
    {
        return app(static::class);
    }
}