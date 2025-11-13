<?php

namespace App\Filament\Admin\Resources\FederalStates\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FederalStateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Nom de l\'état'),

                Select::make('capital_city_id')->label('Capitale')
                    ->relationship(name: 'capital', titleAttribute: 'name')
                    ->preload()
                    ->searchable()
                    ->optionsLimit(100000),
            ]);
    }
}
