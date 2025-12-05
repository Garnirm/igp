<?php

namespace App\Filament\Admin\Resources\Army\Ranks\Pages;

use App\Filament\Admin\Resources\Army\Ranks\RankResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateRank extends CreateRecord
{
    protected static string $resource = RankResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;
}
