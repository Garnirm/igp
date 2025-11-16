<?php

namespace App\Filament\Admin\Resources\Army\TreeUnits\Schemas;

use App\Models\Army\Materiel;
use App\Models\Army\Role;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;
use Illuminate\Support\Collection;

class TreeUnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Général')
                    ->schema([
                        TextInput::make('name')->label('Nom'),

                        Select::make('establishment_id')->label('Etablissement')
                            ->searchable()
                            ->preload()
                            ->optionsLimit(1000000)
                            ->relationship(name: 'establishment', titleAttribute: 'name'),
 
                        TagsInput::make('tags')->label('Tags'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                TableRepeater::make('effectifs')->label('Indicateurs effectifs')
                    ->reorderable(false)
                    ->collapsible()
                    ->schema([
                        Select::make('role')->label('Role')
                            ->searchable()
                            ->preload()
                            ->optionsLimit(1000000)
                            ->native(false)
                            ->options(Role::query()->select('id', 'name')->get()->pluck('name', 'id')),

                        Select::make('category')->label('Catégorie')
                            ->preload()
                            ->native(false)
                            ->options([
                                'militaires' => 'Militaire',
                                'civils' => 'Civil de la défense',
                                'cops' => 'Effectif de police',
                            ]),

                        TextInput::make('amount')->label('Nombre d\'effectifs attendu')->numeric(),
                    ])
                    ->columnSpanFull(),

                TableRepeater::make('materiels')->label('Indicateurs matériels')
                    ->reorderable(false)
                    ->collapsible()
                    ->schema([
                        Select::make('materiel')->label('Materiel')
                            ->searchable()
                            ->preload()
                            ->optionsLimit(1000000)
                            ->native(false)
                            ->options(
                                Materiel::all()
                                    ->groupBy('category_name')
                                    ->mapWithKeys(function (Collection $data, string $category): array {
                                        return [
                                            $category => $data->pluck('name', 'id'),
                                        ];
                                    }),
                            ),

                        TextInput::make('amount')->label('Quantité attendue')->numeric(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
