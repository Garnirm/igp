<?php

namespace App\Filament\Admin\Resources\Army\Materiels\Pages;

use App\Filament\Admin\Resources\Army\Materiels\MaterielResource;
use Filament\Actions\Action;
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

    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()->label('Mettre à jour')->icon('heroicon-m-check');
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()->label('Annuler');
    }
}
