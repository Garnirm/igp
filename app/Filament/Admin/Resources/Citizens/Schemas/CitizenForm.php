<?php

namespace App\Filament\Admin\Resources\Citizens\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CitizenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('firstname')->label('Prénom')->required(),
                TextInput::make('lastname')->label('Nom')->required(),

                Select::make('sexe')
                    ->required()
                    ->options([
                        'H' => 'Homme',
                        'F' => 'Femme',
                    ]),

                Select::make('city')
                    ->label('Ville de résidence')
                    ->required()
                    ->relationship(name: 'city', titleAttribute: 'name')
                    ->preload()
                    ->searchable()
                    ->optionsLimit(1000000),
            ]);
    }
}
