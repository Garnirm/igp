<?php

namespace App\Services\Army;

use App\Models\Army\Role;

class ExportRoles
{
    public static function run(): array
    {
        return Role::query()->select('name', 'description')->get()
            ->map(function (Role $role) {
                return [
                    'name' => $role->name,
                    'description' => $role->description,
                ];
            })
            ->toArray();
    }
}