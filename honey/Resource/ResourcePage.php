<?php

namespace Honey\Resource;

use Honey\Panel\PanelRoutesRegistry;
use Honey\Render\RenderResource;
use Illuminate\View\View;

abstract class ResourcePage
{
    abstract public function handle(RenderResource $render): RenderResource;

    public function execute(): View
    {
        $panel = PanelRoutesRegistry::getPanel(request()->getPathInfo());

        $render = new RenderResource(panel: $panel);

        return $this
            ->handle(render: $render)
            ->view();
    }
}