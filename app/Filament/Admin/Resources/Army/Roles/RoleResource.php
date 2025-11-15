<?php

namespace App\Filament\Admin\Resources\Army\Roles;

use App\Filament\Admin\Resources\Army\Roles\Pages\CreateRole;
use App\Filament\Admin\Resources\Army\Roles\Pages\EditRole;
use App\Filament\Admin\Resources\Army\Roles\Pages\ListRoles;
use App\Filament\Admin\Resources\Army\Roles\Schemas\RoleForm;
use App\Filament\Admin\Resources\Army\Roles\Tables\RolesTable;
use App\Models\Army\Role;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Roles';
    protected static ?string $modelLabel = 'Role';
    protected static ?string $pluralModelLabel = 'Roles';
    protected static bool $hasTitleCaseModelLabel = false;
    protected static string | UnitEnum | null $navigationGroup = 'Armée';

    public static function form(Schema $schema): Schema
    {
        return RoleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RolesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'edit' => EditRole::route('/{record}/edit'),
        ];
    }
}
