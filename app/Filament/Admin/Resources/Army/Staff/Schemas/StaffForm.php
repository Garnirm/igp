<?php

namespace App\Filament\Admin\Resources\Army\Staff\Schemas;

use App\Models\Army\TreeUnit;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;
use Illuminate\Database\Eloquent\Builder;

class StaffForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations générales')
                    ->schema([
                        TextInput::make('firstname')->label('Prénom')->columns(1)->required(),
                        TextInput::make('lastname')->label('Nom')->columns(1)->required(),

                        Select::make('rank_id')->label('Grade')
                            ->searchable()
                            ->columns(1)
                            ->preload()
                            ->required()
                            ->relationship(
                                name: 'rank',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn (Builder $query) => $query->orderBy('minimum_pay', 'asc'),
                            ),

                        Select::make('role_id')->label('Rôle')
                            ->searchable()
                            ->columns(1)
                            ->preload()
                            ->relationship(
                                name: 'role',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn (Builder $query) => $query->orderBy('name', 'asc'),
                            ),

                        Select::make('tree_unit_id')->label('Echelon')
                            ->searchable()
                            ->columnSpanFull()
                            ->required()
                            ->getOptionLabelUsing(function (string $value): ?string {
                                $unit = TreeUnit::find($value);

                                return $unit?->generateFullPath();
                            })
                            ->getSearchResultsUsing(function (string $search): array {
                                return TreeUnit::query()
                                    ->where('name', 'regex', "/{$search}/i") 
                                    ->limit(500)
                                    ->get()
                                    ->mapWithKeys(function (TreeUnit $unit): array {
                                        return [ $unit->getKey() => $unit->generateFullPath() ];
                                    })
                                    ->toArray();
                            }),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Historique des affectations')
                    ->schema([
                        TableRepeater::make('assignments')
                            ->relationship()
                            ->schema([
                                DatePicker::make('start_date')->label('Date de début'),
                                DatePicker::make('end_date')->label('Date de fin'),

                                Select::make('rank_id')->label('Grade')
                                    ->searchable()
                                    ->columns(1)
                                    ->preload()
                                    ->required()
                                    ->relationship(
                                        name: 'rank',
                                        titleAttribute: 'name',
                                        modifyQueryUsing: fn (Builder $query) => $query->orderBy('minimum_pay', 'asc'),
                                    ),

                                Select::make('role_id')->label('Rôle')
                                    ->searchable()
                                    ->columns(1)
                                    ->preload()
                                    ->relationship(
                                        name: 'role',
                                        titleAttribute: 'name',
                                        modifyQueryUsing: fn (Builder $query) => $query->orderBy('name', 'asc'),
                                    ),

                                Select::make('tree_unit_id')->label('Echelon')
                                    ->searchable()
                                    ->columnSpanFull()
                                    ->required()
                                    ->getOptionLabelUsing(function (string $value): ?string {
                                        $unit = TreeUnit::find($value);

                                        return $unit?->generateFullPath();
                                    })
                                    ->getSearchResultsUsing(function (string $search): array {
                                        return TreeUnit::query()
                                            ->where('name', 'regex', "/{$search}/i") 
                                            ->limit(500)
                                            ->get()
                                            ->mapWithKeys(function (TreeUnit $unit): array {
                                                return [ $unit->getKey() => $unit->generateFullPath() ];
                                            })
                                            ->toArray();
                                    }),

                                Toggle::make('active')->label('Affectation actuelle'),
                            ])
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
