<?php

namespace App\Filament\Admin\Resources\Army\TreeUnits\Pages;

use App\Filament\Admin\Resources\Army\TreeUnits\TreeUnitResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTreeUnit extends EditRecord
{
    protected static string $resource = TreeUnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
