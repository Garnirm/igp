<?php

namespace Honey\Render;

class BreadcrumbItem
{
    public function __construct(
        public string $url,
        public string $label,
    )
    {
    }

    public static function make(string $url, string $label): static
    {
        return app(static::class, [
            'url' => $url,
            'label' => $label,
        ]);
    }
}