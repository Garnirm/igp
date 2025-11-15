<?php

namespace App\Filament\Admin\Resources\Army\Roles\Tables;

use App\Services\Army\ExportRoles;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RolesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Intitulé')->sortable()->searchable(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->headerActions([
                Action::make('Exporter')
                    ->action(function () {
                        return response()->streamDownload(function () {
                            echo json_encode(ExportRoles::run(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                        }, 'roles.json');
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
