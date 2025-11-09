<?php

namespace Honey\Panel;

use Honey\Panel\Traits\RegisterRoutes;

class Panel
{
    use RegisterRoutes;

    private string $id;
    private string $path = '';

    public bool $has_topbar = true;

    /**
     * @var array<class-string> $pages
     */
    private array $pages = [];

    /**
     * @var array<class-string> $resources
     */
    private array $resources = [];

    public static function make(): static
    {
        return app(static::class)->id(uniqid());
    }

    public function id(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function path(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function topBar(bool $enabled = true): static
    {
        $this->has_topbar = $enabled;

        return $this;
    }

    /**
     * @param array<class-string> $pages
     */
    public function pages(array $pages): static
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * @param array<class-string> $resources
     */
    public function resources(array $resources): static
    {
        $this->resources = array_merge($this->resources, $resources);

        return $this;
    }
}