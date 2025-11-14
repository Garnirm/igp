<?php

namespace App\Filament\Admin\Resources\Army\TreeUnits\Pages;

use App\Filament\Admin\Resources\Army\TreeUnits\TreeUnitResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTreeUnits extends ListRecords
{
    protected static string $resource = TreeUnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
