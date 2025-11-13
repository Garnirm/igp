<?php

namespace App\Filament\Admin\Resources\Army\Establishments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EstablishmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Nom de l\'établissement'),

                Select::make('city_id')
                    ->label('Ville')
                    ->relationship(name: 'city', titleAttribute: 'name')
                    ->preload()
                    ->optionsLimit(1000000)
                    ->searchable(),
            ]);
    }
}
