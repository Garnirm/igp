<?php

namespace App\Filament\Admin\Resources\Army\Staff;

use App\Filament\Admin\Resources\Army\Staff\Pages\CreateStaff;
use App\Filament\Admin\Resources\Army\Staff\Pages\EditStaff;
use App\Filament\Admin\Resources\Army\Staff\Pages\ListStaff;
use App\Filament\Admin\Resources\Army\Staff\Schemas\StaffForm;
use App\Filament\Admin\Resources\Army\Staff\Tables\StaffTable;
use App\Models\Army\Staff;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class StaffResource extends Resource
{
    protected static ?string $model = Staff::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Effectifs';
    protected static ?string $modelLabel = 'Effectif';
    protected static ?string $pluralModelLabel = 'Effectifs';
    protected static bool $hasTitleCaseModelLabel = false;
    protected static string | UnitEnum | null $navigationGroup = 'Armée';

    protected static ?string $recordTitleAttribute = 'fullname_first';

    public static function form(Schema $schema): Schema
    {
        return StaffForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StaffTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStaff::route('/'),
            'create' => CreateStaff::route('/create'),
            'edit' => EditStaff::route('/{record}/edit'),
        ];
    }
}
