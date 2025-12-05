<?php

namespace App\Filament\Admin\Resources\Army\Establishments\Pages;

use App\Filament\Admin\Resources\Army\Establishments\EstablishmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;

class ListEstablishments extends ListRecords
{
    protected static string $resource = EstablishmentResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
