<?php

namespace App\Honey\Admin\Resources\FederalStateResource\Routes;

use App\Honey\Admin\Resources\FederalStateResource;
use Honey\Render\BreadcrumbItem;
use Honey\Render\RenderResource;
use Honey\Resource\ResourcePage;

class FederalStateIndex extends ResourcePage
{
    public string $resource = FederalStateResource::class;

    public function handle(RenderResource $render): RenderResource
    {
        return $render
            ->title('Liste des états fédéraux')
            ->breadcrumb([
                BreadcrumbItem::make(url: '/admin/federal-state', label: 'Etats fédéraux'),
            ])
            ->widgets([]);
    }
}