<?php

namespace App\Filament\Admin\Resources\Cities\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Nom de la ville'),

                Select::make('federal_state_id')->label('Etat')
                    ->relationship(name: 'federal_state', titleAttribute: 'name')
                    ->preload()
                    ->searchable(),
            ]);
    }
}
