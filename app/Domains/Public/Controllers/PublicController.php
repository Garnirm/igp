<?php

namespace App\Domains\Public\Controllers;

use App\Http\Controllers\BaseController;
use Inertia\Inertia;
use Inertia\Response;

class PublicController extends BaseController
{
    public function home(): Response
    {
        return Inertia::render('Public/Home');
    }

    public function services(): Response
    {
        return Inertia::render('Public/Services');
    }
}