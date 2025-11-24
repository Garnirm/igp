<?php

namespace App\Filament\Admin\Resources\Citizens\Pages;

use App\Filament\Admin\Resources\Citizens\CitizenResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCitizen extends CreateRecord
{
    protected static string $resource = CitizenResource::class;
}
