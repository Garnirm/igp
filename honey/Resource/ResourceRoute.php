<?php

namespace Honey\Resource;

class ResourceRoute
{
    public function __construct(
        public string $path,
        public string $name,
        public string $page
    )
    {
    }

    public static function make(string $path, string $name, string $page): static
    {
        return app(static::class, [
            'path' => $path,
            'name' => $name,
            'page' => $page,
        ]);
    }
}