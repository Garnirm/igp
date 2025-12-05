<?php

namespace App\Filament\Admin\Resources\Army\TreeUnitTemplates\Schemas;

use App\Livewire\ArmyTreeUnitTemplateBuilder;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Livewire;
use Filament\Schemas\Schema;

class TreeUnitTemplateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Nom du template')->required(),

                Livewire::make(ArmyTreeUnitTemplateBuilder::class)->key('structure-tree')->hidden(fn ($record) => is_null($record))->columnSpanFull(),
            ]);
    }
}
