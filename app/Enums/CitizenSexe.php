<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CitizenSexe: string implements HasLabel
{
    case H = 'H';
    case F = 'F';
    
    public function getLabel(): string
    {
        return match ($this) {
            self::H => 'Homme',
            self::F => 'Femme',
        };
    }
}