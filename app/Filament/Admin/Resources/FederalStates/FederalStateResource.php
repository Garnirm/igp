<?php

namespace App\Filament\Admin\Resources\FederalStates;

use App\Filament\Admin\Resources\FederalStates\Pages\CreateFederalState;
use App\Filament\Admin\Resources\FederalStates\Pages\EditFederalState;
use App\Filament\Admin\Resources\FederalStates\Pages\ListFederalStates;
use App\Filament\Admin\Resources\FederalStates\Schemas\FederalStateForm;
use App\Filament\Admin\Resources\FederalStates\Tables\FederalStatesTable;
use App\Models\FederalState;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FederalStateResource extends Resource
{
    protected static ?string $model = FederalState::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Etats fédéraux';
    protected static ?string $modelLabel = 'Etat fédéral';
    protected static ?string $pluralModelLabel = 'Etats fédéraux';
    protected static bool $hasTitleCaseModelLabel = false;

    public static function form(Schema $schema): Schema
    {
        return FederalStateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FederalStatesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFederalStates::route('/'),
            'create' => CreateFederalState::route('/create'),
            'edit' => EditFederalState::route('/{record}/edit'),
        ];
    }
}
