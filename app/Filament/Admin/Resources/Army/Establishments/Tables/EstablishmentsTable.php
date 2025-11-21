<?php

namespace App\Filament\Admin\Resources\Army\Establishments\Tables;

use App\Models\Army\Establishment;
use App\Models\City;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EstablishmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(Establishment::query()->orderBy('name', 'ASC'))
            ->columns([
                TextColumn::make('name')->label('Etablissement')->searchable(),
                TextColumn::make('city.name')->label('Ville')->searchable(),
            ])
            ->filters([
                SelectFilter::make('city')
                    ->label('Villes')
                    ->multiple()
                    ->attribute('city_id')
                    ->searchable()
                    ->options(
                        City::query()->select('id', 'name')->orderBy('name', 'ASC')->get()->pluck('name', 'id')->toArray(),
                    ),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
