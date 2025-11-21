<?php

namespace App\Filament\Admin\Resources\Cities\Pages;

use App\Filament\Admin\Resources\Cities\CityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCities extends ListRecords
{
    protected static string $resource = CityResource::class;
    protected static ?string $breadcrumb = 'Liste';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Ajouter une ville'),
        ];
    }
}
