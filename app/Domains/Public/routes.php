<?php

use App\Domains\Public\Controllers\LoginController;
use App\Domains\Public\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('', [ PublicController::class, 'home' ]);
Route::get('services', [ PublicController::class, 'services' ]);

Route::prefix('login')->middleware('web')->group(function () {
    Route::get('ops', [ LoginController::class, 'ops' ]);
    Route::post('ops', [ LoginController::class, 'opsPost' ]);
});