<?php

namespace App\Filament\Admin\Resources\Army\Roles\Pages;

use App\Filament\Admin\Resources\Army\Roles\RoleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
