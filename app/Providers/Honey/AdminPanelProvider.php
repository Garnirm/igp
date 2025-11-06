<?php

namespace App\Providers\Honey;

use App\Honey\Resources\FederalStateResource;
use Honey\Page\Dashboard;
use Honey\Panel\Panel;
use Honey\Panel\PanelProvider;

class AdminPanelProvider extends PanelProvider
{
    /**
     * @return array<Panel>
     */
    protected function load(): array
    {
        return [
            Panel::make()
                ->id(id: 'panel')
                ->path(path: 'panel')
                ->topBar(true)
                ->addResources([
                    FederalStateResource::class,
                ])
                ->addPages([
                    Dashboard::class,
                ]),
        ];
    }
}