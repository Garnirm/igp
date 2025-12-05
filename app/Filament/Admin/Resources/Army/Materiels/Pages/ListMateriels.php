<?php

namespace App\Filament\Admin\Resources\Army\Materiels\Pages;

use App\Filament\Admin\Resources\Army\Materiels\MaterielResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;

class ListMateriels extends ListRecords
{
    protected static string $resource = MaterielResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
