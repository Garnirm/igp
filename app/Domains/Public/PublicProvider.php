<?php
 
namespace App\Domains\Public;

use Illuminate\Support\ServiceProvider;

class PublicProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    public function register()
    {
    }
}