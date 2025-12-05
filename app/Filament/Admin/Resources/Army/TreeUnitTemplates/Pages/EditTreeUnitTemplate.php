<?php

namespace App\Filament\Admin\Resources\Army\TreeUnitTemplates\Pages;

use App\Filament\Admin\Resources\Army\TreeUnitTemplates\TreeUnitTemplateResource;
use App\Models\Army\TreeUnitTemplate;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class EditTreeUnitTemplate extends EditRecord
{
    protected static string $resource = TreeUnitTemplateResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;

    /**
     * @return list<DeleteAction|Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),

            Action::make('Importer un template')
                ->schema([
                    FileUpload::make('json')
                        ->label('Fichier JSON')
                        ->required()
                        ->acceptedFileTypes([ 'application/json' ])
                        ->disk('local'),
                ])
                ->action(function (array $data, TreeUnitTemplate $record, Component $livewire): void {
                    $content = Storage::disk('local')->get($data['json']);

                    Storage::disk('local')->delete($data['json']);

                    $template = json_decode($content, true);

                    if (json_last_error() !== JSON_ERROR_NONE) {
                        Notification::make()->title('JSON Invalide')->danger()->send();

                        return;
                    }

                    $record->items = $template;
                    $record->save();

                    $record->refresh();

                    $livewire->form->fill($record->toArray());

                    $livewire->dispatch('refresh-tree-units', recordId: $record->id);

                    Notification::make()->title('Template importé')->success()->send();
                }),
        ];
    }
}
