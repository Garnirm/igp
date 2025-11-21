<?php

namespace App\Filament\Admin\Resources\Cities\Pages;

use App\Filament\Admin\Resources\Cities\CityResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateCity extends CreateRecord
{
    protected static string $resource = CityResource::class;
    protected static ?string $breadcrumb = 'Création';

    public function getTitle(): string | Htmlable
    {
        return 'Création d\'une ville';
    }

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()->label('Créer')->icon('heroicon-m-check');
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()->label('Créer et continuer');
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()->label('Annuler');
    }
}
