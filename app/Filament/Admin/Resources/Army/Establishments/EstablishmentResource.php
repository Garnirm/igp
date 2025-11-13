<?php

namespace App\Filament\Admin\Resources\Army\Establishments;

use App\Filament\Admin\Resources\Army\Establishments\Pages\CreateEstablishment;
use App\Filament\Admin\Resources\Army\Establishments\Pages\EditEstablishment;
use App\Filament\Admin\Resources\Army\Establishments\Pages\ListEstablishments;
use App\Filament\Admin\Resources\Army\Establishments\Schemas\EstablishmentForm;
use App\Filament\Admin\Resources\Army\Establishments\Tables\EstablishmentsTable;
use App\Models\Army\Establishment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EstablishmentResource extends Resource
{
    protected static ?string $model = Establishment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Etablissements';
    protected static ?string $modelLabel = 'Etablissement';
    protected static ?string $pluralModelLabel = 'Etablissements';
    protected static bool $hasTitleCaseModelLabel = false;
    protected static string | UnitEnum | null $navigationGroup = 'Armée';

    public static function form(Schema $schema): Schema
    {
        return EstablishmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EstablishmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEstablishments::route('/'),
            'create' => CreateEstablishment::route('/create'),
            'edit' => EditEstablishment::route('/{record}/edit'),
        ];
    }
}
