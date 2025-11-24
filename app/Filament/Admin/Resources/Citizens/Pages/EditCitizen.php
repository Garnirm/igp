<?php

namespace App\Filament\Admin\Resources\Citizens\Pages;

use App\Filament\Admin\Resources\Citizens\CitizenResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCitizen extends EditRecord
{
    protected static string $resource = CitizenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
