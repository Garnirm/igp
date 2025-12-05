<?php

namespace App\Filament\Admin\Resources\Army\TreeUnitTemplates\Pages;

use App\Filament\Admin\Resources\Army\TreeUnitTemplates\TreeUnitTemplateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;

class ListTreeUnitTemplates extends ListRecords
{
    protected static string $resource = TreeUnitTemplateResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
