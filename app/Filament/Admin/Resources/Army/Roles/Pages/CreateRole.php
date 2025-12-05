<?php

namespace App\Filament\Admin\Resources\Army\Roles\Pages;

use App\Filament\Admin\Resources\Army\Roles\RoleResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;
}
