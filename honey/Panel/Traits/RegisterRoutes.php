<?php

namespace Honey\Panel\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

trait RegisterRoutes
{
    public function registerResourcesRoutes(): static
    {
        foreach ($this->resources as $resource) {
            if (property_exists($resource, 'path')) {
                $path_resource = $resource::$path;
            } else {
                /** @var string $class_name */
                $class_name = Arr::last(explode('\\', $resource));

                $short_class_name = Str::replace('Resource', '', $class_name);
                $path_resource = Str::kebab($short_class_name);
            }

            $routes = $resource::routes();

            foreach ($routes as $route) {
                $full_route = Str::rtrim('/'.$this->path.'/'.$path_resource.$route->path, '/');

                Route::get($full_route, [ $route->page, 'execute' ])
                    ->middleware('web')
                    ->name('honey.'.(!empty($this->id) ? $this->id.'.' : '').'resources.'.$resource::$id.'.'.$route->name);
            }
        }

        return $this;
    }

    public function registerPagesRoute(): static
    {
        foreach ($this->pages as $page) {
            if (property_exists($page, 'id')) {
                $page_id = $page::$id;
            } else {
                $page_id = Str::lcfirst(Arr::last(explode('\\', $page)));
            }

            $page_path = Str::start($page::$url, '/');

            $full_route = Str::rtrim('/'.$this->path.$page_path, '/');

            Route::get($full_route, [ $page, 'handle' ])
                ->middleware('web')
                ->name('honey.'.(!empty($this->id) ? $this->id.'.' : '').'pages.'.$page_id);
        }

        return $this;
    }
}