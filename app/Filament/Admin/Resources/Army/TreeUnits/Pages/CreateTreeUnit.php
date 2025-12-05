<?php

namespace App\Filament\Admin\Resources\Army\TreeUnits\Pages;

use App\Filament\Admin\Resources\Army\TreeUnits\TreeUnitResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateTreeUnit extends CreateRecord
{
    protected static string $resource = TreeUnitResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;
}
