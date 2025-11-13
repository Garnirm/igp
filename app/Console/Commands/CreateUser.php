<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    protected $signature = 'create:user';

    public function handle(): int
    {
        $user = new User();
        $user->email = 'admin@igp.dra';
        $user->password = Hash::make('test', ['memory' => 1024, 'time' => 2, 'threads' => 2]);
        $user->save();

        return Command::SUCCESS;
    }
}
