<?php

namespace App\Filament\Admin\Resources\Army\Materiels\Pages;

use App\Filament\Admin\Resources\Army\Materiels\MaterielResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateMateriel extends CreateRecord
{
    protected static string $resource = MaterielResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;
}
