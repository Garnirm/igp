<?php

namespace App\Filament\Admin\Resources\Citizens;

use App\Filament\Admin\Resources\Citizens\Pages\CreateCitizen;
use App\Filament\Admin\Resources\Citizens\Pages\EditCitizen;
use App\Filament\Admin\Resources\Citizens\Pages\ListCitizens;
use App\Filament\Admin\Resources\Citizens\Pages\ViewCitizen;
use App\Filament\Admin\Resources\Citizens\Schemas\CitizenForm;
use App\Filament\Admin\Resources\Citizens\Tables\CitizensTable;
use App\Models\Citizen;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CitizenResource extends Resource
{
    protected static ?string $model = Citizen::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Citoyens';
    protected static ?string $modelLabel = 'Citoyen';
    protected static ?string $pluralModelLabel = 'Citoyens';
    protected static bool $hasTitleCaseModelLabel = false;

    public static function form(Schema $schema): Schema
    {
        return CitizenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CitizensTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCitizens::route('/'),
            'create' => CreateCitizen::route('/create'),
            'view' => ViewCitizen::route('/{record}'),
            'edit' => EditCitizen::route('/{record}/edit'),
        ];
    }
}
