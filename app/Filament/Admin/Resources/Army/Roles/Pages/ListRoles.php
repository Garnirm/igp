<?php

namespace App\Filament\Admin\Resources\Army\Roles\Pages;

use App\Filament\Admin\Resources\Army\Roles\RoleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
