<?php

namespace App\Providers\Honey;

use App\Honey\Admin\Resources\FederalStateResource;
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
                ->id(id: 'admin')
                ->path(path: 'admin')
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