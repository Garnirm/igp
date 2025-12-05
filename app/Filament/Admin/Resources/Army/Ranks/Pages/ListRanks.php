<?php

namespace App\Filament\Admin\Resources\Army\Ranks\Pages;

use App\Filament\Admin\Resources\Army\Ranks\RankResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;

class ListRanks extends ListRecords
{
    protected static string $resource = RankResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
