<?php

namespace App\Filament\Admin\Resources\Cities\RelationManagers;

use App\Filament\Admin\Resources\Army\Establishments\EstablishmentResource;
use App\Models\Army\Establishment;
use Filament\Actions\CreateAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use MongoDB\Laravel\Eloquent\Builder;

class ArmyEstablishmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'army_establishments';
    protected static ?string $title = 'Emprises militaires et de sécurité';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->orderBy('name', 'ASC'))
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')->label('Nom de l\'établissement')->searchable(),
            ])
            ->headerActions([
                CreateAction::make()->label('Créer un nouvel établissement')
                    ->createAnother(false)
                    ->modalHeading('Créer un nouvel établissement')
                    ->modalCancelActionLabel('Annuler')
                    ->modalSubmitActionLabel('Créer'),
            ])
            ->recordActions([
                ViewAction::make()->url(fn (Establishment $record): string => EstablishmentResource::getUrl('edit', [ 'record' => $record->id ]))->label('Accès'),
            ]);
    }
}