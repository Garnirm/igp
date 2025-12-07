<?php

use App\Domains\Ops\Controllers\DashboardController;
use App\Domains\Ops\Controllers\IGA\GlobalViewController;
use App\Domains\Ops\Controllers\TerritoryController;
use App\Http\Middleware\CheckUser;
use Illuminate\Support\Facades\Route;

Route::group([ 'prefix' => 'ops', 'middleware' => [ 'web', CheckUser::class ] ], function () {
    Route::get('', [ DashboardController::class, 'dashboard' ]);

    Route::prefix('iga')->group(function () {
        Route::get('', [ GlobalViewController::class, 'globalView' ]);
    });

    Route::prefix('territory')->group(function () {
        Route::get('', [ TerritoryController::class, 'home' ]);

        Route::get('city/{city}', [ TerritoryController::class, 'city' ]);
        Route::get('state/{state}', [ TerritoryController::class, 'federalState' ]);
    });
});