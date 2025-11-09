<?php

namespace Honey\Panel;

use Illuminate\Routing\Route;
use Illuminate\Support\Str;

class PanelRoutesRegistry
{
    /**
     * @param array<string,Panel> $routes
     */
    private static array $routes = [];

    public static function addRoute(Route $route, Panel $panel): void
    {
        self::$routes[ Str::start($route->uri, '/') ] = $panel;
    }

    public static function getPanel(string $path): Panel
    {
        return self::$routes[$path];
    }
}