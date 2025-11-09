<?php

namespace Honey\Widgets;

use Honey\Render\RenderResource;

abstract class WidgetRegistry
{
    public string $identifier = '';

    public function identifier(string $identifier): static
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function register(): static
    {
        RenderResource::$widgets[ $this->identifier ] = $this;

        return $this;
    }

    public static function make(): static
    {
        return app(static::class)->identifier(uniqid())->register();
    }
}