<?php

namespace Honey\Render;

class HeaderTitle
{
    private string $label = '';

    public string $view_path = 'honey-layout::page.header.title';

    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function viewData(): array
    {
        return [
            'label' => $this->label,
        ];
    }

    public static function make(): static
    {
        return app(static::class);
    }
}