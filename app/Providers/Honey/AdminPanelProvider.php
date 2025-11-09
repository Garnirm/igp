<?php

namespace App\Providers\Honey;

use App\Honey\Admin\Resources\FederalStateResource;
use Honey\Page\Dashboard;
use Honey\Panel\Panel;
use Honey\Panel\PanelProvider;

class AdminPanelProvider extends PanelProvider
{
    protected function load(): Panel
    {
        return Panel::make()
            ->id(id: 'admin')
            ->path(path: 'admin')
            ->topBar(false)
            ->resources([
                FederalStateResource::class,
            ])
            ->pages([
                Dashboard::class,
            ]);
    }
}