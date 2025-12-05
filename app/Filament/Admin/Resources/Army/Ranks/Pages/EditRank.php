<?php

namespace App\Filament\Admin\Resources\Army\Ranks\Pages;

use App\Filament\Admin\Resources\Army\Ranks\RankResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;

class EditRank extends EditRecord
{
    protected static string $resource = RankResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
