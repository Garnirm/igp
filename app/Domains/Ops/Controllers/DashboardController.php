<?php

namespace App\Domains\Ops\Controllers;

use App\Http\Controllers\BaseController;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends BaseController
{
    public function dashboard(): Response
    {
        return Inertia::render('Ops/Dashboard');
    }
}