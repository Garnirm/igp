<?php
 
namespace App\Domains\Ops;

use Illuminate\Support\ServiceProvider;

class OpsProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    public function register()
    {
    }
}