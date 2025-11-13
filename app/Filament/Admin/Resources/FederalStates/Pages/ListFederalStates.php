<?php

namespace App\Filament\Admin\Resources\FederalStates\Pages;

use App\Filament\Admin\Resources\FederalStates\FederalStateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFederalStates extends ListRecords
{
    protected static string $resource = FederalStateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
