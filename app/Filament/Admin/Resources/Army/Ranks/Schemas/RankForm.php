<?php

namespace App\Filament\Admin\Resources\Army\Ranks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RankForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Grade'),
                TextInput::make('order')->label('Ordre'),
                TextInput::make('minimum_pay')->label('Solde minimum')->integer(),
            ]);
    }
}
