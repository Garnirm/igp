<?php

namespace App\Enums;

enum CitizenSexe: string
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