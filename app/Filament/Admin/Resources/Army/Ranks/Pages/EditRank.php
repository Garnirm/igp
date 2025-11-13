<?php

namespace App\Filament\Admin\Resources\Army\Ranks\Pages;

use App\Filament\Admin\Resources\Army\Ranks\RankResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRank extends EditRecord
{
    protected static string $resource = RankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
