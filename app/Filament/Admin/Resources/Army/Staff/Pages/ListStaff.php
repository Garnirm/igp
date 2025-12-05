<?php

namespace App\Filament\Admin\Resources\Army\Staff\Pages;

use App\Filament\Admin\Resources\Army\Staff\StaffResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;

class ListStaff extends ListRecords
{
    protected static string $resource = StaffResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
