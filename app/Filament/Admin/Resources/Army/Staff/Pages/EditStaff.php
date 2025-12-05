<?php

namespace App\Filament\Admin\Resources\Army\Staff\Pages;

use App\Filament\Admin\Resources\Army\Staff\StaffResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;

class EditStaff extends EditRecord
{
    protected static string $resource = StaffResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
