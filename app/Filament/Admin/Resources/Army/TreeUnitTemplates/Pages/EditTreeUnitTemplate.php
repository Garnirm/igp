<?php

namespace App\Filament\Admin\Resources\Army\TreeUnitTemplates\Pages;

use App\Filament\Admin\Resources\Army\TreeUnitTemplates\TreeUnitTemplateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTreeUnitTemplate extends EditRecord
{
    protected static string $resource = TreeUnitTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
