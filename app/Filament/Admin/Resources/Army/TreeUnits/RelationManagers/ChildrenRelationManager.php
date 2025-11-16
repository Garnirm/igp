<?php

namespace App\Filament\Admin\Resources\Army\TreeUnits\RelationManagers;

use App\Filament\Admin\Resources\Army\TreeUnits\TreeUnitResource;
use App\Models\Army\TreeUnit;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ChildrenRelationManager extends RelationManager
{
    protected static string $relationship = 'children';
    protected static ?string $title = 'Échelons enfants';

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nom de l\'échelon')->required(),

                Select::make('establishment_id')
                    ->label('Établissement')
                    ->relationship(name: 'establishment', titleAttribute: 'name')
                    ->searchable()
                    ->preload()
                    ->optionsLimit(1000000),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->paginated(false)
            ->columns([
                TextColumn::make('name')->label('Nom de l\'échelon'),
                TextColumn::make('establishment.name')->label('Établissement'),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                ViewAction::make()->url(fn (TreeUnit $record): string => TreeUnitResource::getUrl('edit', [ 'record' => $record->id ])),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}