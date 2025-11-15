<?php

namespace App\Filament\Admin\Resources\Army\Roles\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Intitulé'),

                Textarea::make('description')->label('Description')->rows(5)->columnSpanFull(),
            ]);
    }
}
