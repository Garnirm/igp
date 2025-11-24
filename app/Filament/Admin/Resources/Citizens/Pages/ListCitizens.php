<?php

namespace App\Filament\Admin\Resources\Citizens\Pages;

use App\Filament\Admin\Resources\Citizens\CitizenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCitizens extends ListRecords
{
    protected static string $resource = CitizenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
