<?php

namespace App\Filament\Admin\Resources\Army\Materiels;

use App\Filament\Admin\Resources\Army\Materiels\Pages\CreateMateriel;
use App\Filament\Admin\Resources\Army\Materiels\Pages\EditMateriel;
use App\Filament\Admin\Resources\Army\Materiels\Pages\ListMateriels;
use App\Filament\Admin\Resources\Army\Materiels\Schemas\MaterielForm;
use App\Filament\Admin\Resources\Army\Materiels\Tables\MaterielsTable;
use App\Models\Army\Materiel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MaterielResource extends Resource
{
    protected static ?string $model = Materiel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Matériels';
    protected static ?string $modelLabel = 'Matériel';
    protected static ?string $pluralModelLabel = 'Matériels';
    protected static bool $hasTitleCaseModelLabel = false;
    protected static string | UnitEnum | null $navigationGroup = 'Armée';

    public static function form(Schema $schema): Schema
    {
        return MaterielForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MaterielsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMateriels::route('/'),
            'create' => CreateMateriel::route('/create'),
            'edit' => EditMateriel::route('/{record}/edit'),
        ];
    }
}
