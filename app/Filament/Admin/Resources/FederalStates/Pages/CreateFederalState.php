<?php

namespace App\Filament\Admin\Resources\FederalStates\Pages;

use App\Filament\Admin\Resources\FederalStates\FederalStateResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateFederalState extends CreateRecord
{
    protected static string $resource = FederalStateResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;
}
