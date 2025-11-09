<?php

namespace Honey\Render;

class HeaderTitle
{
    private string $label = '';
    private string $view = 'honey-layout::page.header-title';

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