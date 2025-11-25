<?php

namespace App\Filament\Admin\Resources\Army\TreeUnitTemplates;

use App\Filament\Admin\Resources\Army\TreeUnitTemplates\Pages\CreateTreeUnitTemplate;
use App\Filament\Admin\Resources\Army\TreeUnitTemplates\Pages\EditTreeUnitTemplate;
use App\Filament\Admin\Resources\Army\TreeUnitTemplates\Pages\ListTreeUnitTemplates;
use App\Filament\Admin\Resources\Army\TreeUnitTemplates\Schemas\TreeUnitTemplateForm;
use App\Filament\Admin\Resources\Army\TreeUnitTemplates\Tables\TreeUnitTemplatesTable;
use App\Models\Army\TreeUnitTemplate;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TreeUnitTemplateResource extends Resource
{
    protected static ?string $model = TreeUnitTemplate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Templates d\'échelons';
    protected static ?string $modelLabel = 'Template d\'échelons';
    protected static ?string $pluralModelLabel = 'Templates d\'échelons';
    protected static bool $hasTitleCaseModelLabel = false;
    protected static string | UnitEnum | null $navigationGroup = 'Armée';

    public static function form(Schema $schema): Schema
    {
        return TreeUnitTemplateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TreeUnitTemplatesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTreeUnitTemplates::route('/'),
            'create' => CreateTreeUnitTemplate::route('/create'),
            'edit' => EditTreeUnitTemplate::route('/{record}/edit'),
        ];
    }
}
