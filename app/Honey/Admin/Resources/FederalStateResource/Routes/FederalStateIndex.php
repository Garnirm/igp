<?php

namespace App\Honey\Admin\Resources\FederalStateResource\Routes;

use App\Honey\Admin\Resources\FederalStateResource;
use App\Models\FederalState;
use Honey\Form\Form;
use Honey\Render\BreadcrumbItem;
use Honey\Render\HeaderBlock;
use Honey\Render\HeaderBreadcrumb;
use Honey\Render\HeaderTitle;
use Honey\Render\RenderResource;
use Honey\Resource\ResourcePage;
use Honey\Widgets\ActionModaleRegistry;
use Honey\Widgets\Table\TextColumn;
use Honey\Widgets\TableRegistry;

class FederalStateIndex extends ResourcePage
{
    public string $resource = FederalStateResource::class;

    public function handle(RenderResource $render): RenderResource
    {
        return $render
            ->header([
                HeaderBreadcrumb::make()->items([
                    BreadcrumbItem::make(url: '/admin/federal-state', label: 'Etats fédéraux'),
                ]),

                HeaderBlock::make()->items([
                    HeaderTitle::make()->label('Liste des états fédéraux'),

                    ActionModaleRegistry::make()->label('Créer un état')
                        ->model(FederalState::class)
                        ->widgets([
                            Form::make()->items([]),
                        ]),
                ])->columns(2),
            ])
            ->widgets([
                TableRegistry::make()
                    ->columns([
                        TextColumn::make()->field('name')->label('Nom'),
                    ])
                    ->staticData([
                        [ 'name' => 'Etat de Canvane' ],
                        [ 'name' => 'Etat de Faligadrie' ],
                    ]),
            ]);
    }
}