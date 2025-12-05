<?php

namespace App\Filament\Admin\Resources\Army\Staff\Pages;

use App\Filament\Admin\Resources\Army\Staff\StaffResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateStaff extends CreateRecord
{
    protected static string $resource = StaffResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;
}
