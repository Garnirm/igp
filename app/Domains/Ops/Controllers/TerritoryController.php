<?php

namespace App\Domains\Ops\Controllers;

use App\Http\Controllers\BaseController;
use Inertia\Inertia;
use Inertia\Response;

class TerritoryController extends BaseController
{
    public function home(): Response
    {
        return Inertia::render('Ops/Territory/Home');
    }

    public function federalState(): Response
    {
        return Inertia::render('Ops/Territory/FederalState');
    }

    public function city(): Response
    {
        return Inertia::render('Ops/Territory/City');
    }
}