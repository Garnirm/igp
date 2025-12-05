<?php

namespace App\Filament\Admin\Resources\Citizens\Pages;

use App\Filament\Admin\Resources\Citizens\CitizenResource;
use App\Models\Citizen;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Illuminate\Contracts\Support\Htmlable;

class ViewCitizen extends ViewRecord
{
    protected static string $resource = CitizenResource::class;
    protected Width | string | null $maxContentWidth = Width::Full;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label('Editer le citoyen'),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        /** @var Citizen $citizen */
        $citizen = $this->getRecord();

        return $citizen->firstname.' '.$citizen->lastname;
    }

    public function getBreadcrumbs(): array
    {
        /** @var Citizen $citizen */
        $citizen = $this->getRecord();

        $parents = parent::getBreadcrumbs();
        $parents[0] = $citizen->firstname.' '.$citizen->lastname;

        return $parents;
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make([
                        TextEntry::make('fullname_first')->label(''),
                    ])->grow(false),
                ])->from('lg'),
            ]);
    }
}
