<?php

namespace App\Domains\Ops\Controllers\IGA;

use App\Http\Controllers\BaseController;
use Inertia\Inertia;
use Inertia\Response;

class GlobalViewController extends BaseController
{
    public function globalView(): Response
    {
        return Inertia::render('Ops/IGA/GlobalView');
    }
}