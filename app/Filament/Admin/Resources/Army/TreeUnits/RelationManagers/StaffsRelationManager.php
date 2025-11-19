<?php

namespace App\Filament\Admin\Resources\Army\TreeUnits\RelationManagers;

use App\Filament\Admin\Resources\Army\Staff\StaffResource;
use App\Models\Army\Staff;
use Filament\Actions\DetachAction;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StaffsRelationManager extends RelationManager
{
    protected static string $relationship = 'staffs';
    protected static ?string $title = 'Effectifs';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('lastname')
            ->paginated(false)
            ->columns([
                TextColumn::make('firstname')->label('Prénom'),
                TextColumn::make('lastname')->label('Nom'),
                TextColumn::make('rank.name')->label('Grade'),
                TextColumn::make('role.name')->label('Rôle'),
            ])
            ->recordActions([
                ViewAction::make()->url(fn (Staff $record): string => StaffResource::getUrl('edit', [ 'record' => $record->id ])),
                DetachAction::make(),
            ]);
    }
}