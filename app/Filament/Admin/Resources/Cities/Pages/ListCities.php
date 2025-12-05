<?php

namespace App\Filament\Admin\Resources\Cities\Pages;

use App\Filament\Admin\Resources\Cities\CityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;

class ListCities extends ListRecords
{
    protected static string $resource = CityResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;
    protected static ?string $breadcrumb = 'Liste';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Ajouter une ville'),
        ];
    }
}
