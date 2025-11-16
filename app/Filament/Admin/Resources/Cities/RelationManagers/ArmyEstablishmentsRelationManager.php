<?php

namespace App\Filament\Admin\Resources\Cities\RelationManagers;

use App\Filament\Admin\Resources\Army\Establishments\EstablishmentResource;
use App\Models\Army\Establishment;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArmyEstablishmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'army_establishments';
    protected static ?string $title = 'Emprises militaires et de sécurité';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')->label('Nom de l\'établissement')->searchable(),
            ])
            ->recordActions([
                ViewAction::make()->url(fn (Establishment $record): string => EstablishmentResource::getUrl('edit', [ 'record' => $record->id ])),
            ]);
    }
}