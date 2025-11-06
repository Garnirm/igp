<?php

namespace Honey\Resource;

use Honey\Render\RenderResource;
use Illuminate\View\View;

abstract class ResourcePage
{
    abstract public function handle(RenderResource $render): RenderResource;

    public function execute(): View
    {
        $render = new RenderResource();

        return $this
            ->handle(render: $render)
            ->view();
    }
}