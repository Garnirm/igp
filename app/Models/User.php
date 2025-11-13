<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use MongoDB\Laravel\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser, HasName
{
    protected $table = 'user';

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getFilamentName(): string
    {
        return 'admin';
    }
}
