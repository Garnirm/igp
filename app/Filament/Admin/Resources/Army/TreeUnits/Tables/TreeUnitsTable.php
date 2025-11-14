<?php

namespace App\Filament\Admin\Resources\Army\TreeUnits\Tables;

use App\Models\Army\TreeUnit;
use App\Services\Army\ExportTreeUnits;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TreeUnitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(TreeUnit::query()->whereNull('parent_id'))
            ->columns([
                TextColumn::make('name')->label('Nom de l\'échelon'),
                TextColumn::make('establishment.name')->label('Etablissement'),
            ])
            ->paginated(false)
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ])
            ->headerActions([
                Action::make('Exporter')
                    ->action(function () {
                        return response()->streamDownload(function () {
                            echo json_encode(ExportTreeUnits::run(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                        }, 'tree.json');
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
