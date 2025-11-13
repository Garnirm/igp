<?php

namespace App\Filament\Admin\Resources\Army\Ranks;

use App\Filament\Admin\Resources\Army\Ranks\Pages\CreateRank;
use App\Filament\Admin\Resources\Army\Ranks\Pages\EditRank;
use App\Filament\Admin\Resources\Army\Ranks\Pages\ListRanks;
use App\Filament\Admin\Resources\Army\Ranks\Schemas\RankForm;
use App\Filament\Admin\Resources\Army\Ranks\Tables\RanksTable;
use App\Models\Army\Rank;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RankResource extends Resource
{
    protected static ?string $model = Rank::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Grades';
    protected static ?string $modelLabel = 'Grade';
    protected static ?string $pluralModelLabel = 'Grades';
    protected static bool $hasTitleCaseModelLabel = false;
    protected static string | UnitEnum | null $navigationGroup = 'Armée';

    public static function form(Schema $schema): Schema
    {
        return RankForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RanksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRanks::route('/'),
            'create' => CreateRank::route('/create'),
            'edit' => EditRank::route('/{record}/edit'),
        ];
    }
}
