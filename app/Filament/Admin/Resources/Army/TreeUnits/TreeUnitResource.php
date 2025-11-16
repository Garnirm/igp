<?php

namespace App\Filament\Admin\Resources\Army\TreeUnits;

use App\Filament\Admin\Resources\Army\TreeUnits\RelationManagers\ChildrenRelationManager;
use App\Filament\Admin\Resources\Army\TreeUnits\Pages\CreateTreeUnit;
use App\Filament\Admin\Resources\Army\TreeUnits\Pages\EditTreeUnit;
use App\Filament\Admin\Resources\Army\TreeUnits\Pages\ListTreeUnits;
use App\Filament\Admin\Resources\Army\TreeUnits\Schemas\TreeUnitForm;
use App\Filament\Admin\Resources\Army\TreeUnits\Tables\TreeUnitsTable;
use App\Models\Army\TreeUnit;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TreeUnitResource extends Resource
{
    protected static ?string $model = TreeUnit::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Echelons';
    protected static ?string $modelLabel = 'Echelon';
    protected static ?string $pluralModelLabel = 'Echelons';
    protected static bool $hasTitleCaseModelLabel = false;
    protected static string | UnitEnum | null $navigationGroup = 'Armée';

    public static function form(Schema $schema): Schema
    {
        return TreeUnitForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TreeUnitsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ChildrenRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTreeUnits::route('/'),
            'create' => CreateTreeUnit::route('/create'),
            'edit' => EditTreeUnit::route('/{record}/edit'),
        ];
    }
}
