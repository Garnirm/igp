<?php

namespace App\Filament\Admin\Resources\Army\Materiels\Pages;

use App\Filament\Admin\Resources\Army\Materiels\MaterielResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMateriel extends EditRecord
{
    protected static string $resource = MaterielResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
