<?php

namespace App\Filament\Admin\Resources\Army\TreeUnitTemplates\Pages;

use App\Filament\Admin\Resources\Army\TreeUnitTemplates\TreeUnitTemplateResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateTreeUnitTemplate extends CreateRecord
{
    protected static string $resource = TreeUnitTemplateResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;
}
