<?php

namespace App\Filament\Admin\Resources\Army\Establishments\Pages;

use App\Filament\Admin\Resources\Army\Establishments\EstablishmentResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateEstablishment extends CreateRecord
{
    protected static string $resource = EstablishmentResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;
}
