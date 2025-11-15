<?php

namespace App\Console\Commands;

use App\Models\Army\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RegisterArmyRoles extends Command
{
    protected $signature = 'register:army_roles';

    public function handle(): int
    {
        $roles = json_decode(File::get(public_path('index_roles.json')), true);

        Role::query()->forceDelete();

        foreach ($roles as $role) {
            $role_model = new Role();
            $role_model->name = $role['name'];
            $role_model->description = $role['description'];
            $role_model->save();
        }

        return Command::SUCCESS;
    }
}
