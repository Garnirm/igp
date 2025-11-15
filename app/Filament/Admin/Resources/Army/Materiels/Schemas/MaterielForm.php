<?php

namespace App\Filament\Admin\Resources\Army\Materiels\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MaterielForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Nom'),

                Select::make('category_name')
                    ->label('Catégorie')
                    ->required()
                    ->options([
                        'Avion' => 'Avion',
                        'Hélicoptère' => 'Hélicoptère',
                        'Drone' => 'Drone',
                        'Véhicule' => 'Véhicule',
                        'Munition et consommable' => 'Munition et consommable',
                        'Arme' => 'Arme',
                        'Navire et embarcation' => 'Navire et embarcation',
                        'Equipement individuel' => 'Equipement individuel',
                        'Equipement d\'appareil' => 'Equipement d\'appareil',
                        'Police' => 'Police',
                        'Satellite' => 'Satellite',
                        'Utilitaire' => 'Utilitaire',
                        'Médical' => 'Médical',
                    ]),
            ]);
    }
}
