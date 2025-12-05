<?php

namespace App\Filament\Admin\Resources\Citizens\Pages;

use App\Filament\Admin\Resources\Citizens\CitizenResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateCitizen extends CreateRecord
{
    protected static string $resource = CitizenResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;
}
