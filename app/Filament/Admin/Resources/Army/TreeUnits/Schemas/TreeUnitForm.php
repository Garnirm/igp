<?php

namespace App\Filament\Admin\Resources\Army\TreeUnits\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TreeUnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Nom'),

                Select::make('establishment_id')->label('Etablissement')
                    ->searchable()
                    ->preload()
                    ->optionsLimit(1000000)
                    ->relationship(name: 'establishment', titleAttribute: 'name'),
            ]);
    }
}
