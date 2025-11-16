<?php

namespace App\Filament\Admin\Resources\Army\Establishments\RelationManagers;

use App\Filament\Admin\Resources\Army\TreeUnits\TreeUnitResource;
use App\Models\Army\TreeUnit;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TreeUnitsRelationManager extends RelationManager
{
    protected static string $relationship = 'tree_units';
    protected static ?string $title = 'Échelons liés';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')->label('Nom de l\'échelon')->searchable(),
            ])
            ->recordActions([
                ViewAction::make()->url(fn (TreeUnit $record): string => TreeUnitResource::getUrl('edit', [ 'record' => $record->id ])),
            ]);
    }
}