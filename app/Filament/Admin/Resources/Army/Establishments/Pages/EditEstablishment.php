<?php

namespace App\Filament\Admin\Resources\Army\Establishments\Pages;

use App\Filament\Admin\Resources\Army\Establishments\EstablishmentResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEstablishment extends EditRecord
{
    protected static string $resource = EstablishmentResource::class;

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
