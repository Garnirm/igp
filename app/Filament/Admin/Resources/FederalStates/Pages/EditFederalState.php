<?php

namespace App\Filament\Admin\Resources\FederalStates\Pages;

use App\Filament\Admin\Resources\FederalStates\FederalStateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;

class EditFederalState extends EditRecord
{
    protected static string $resource = FederalStateResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
