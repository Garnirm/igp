<?php

namespace App\Domains\Public\Controllers;

use App\Domains\Public\Requests\Login\OpsPostRequest;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends BaseController
{
    public function ops(): Response
    {
        return Inertia::render('Public/Login/Ops');
    }

    public function opsPost(OpsPostRequest $request): RedirectResponse
    {
        $params = $request->validated();

        try {
            if (Auth::attempt($params)) {
                return redirect('/ops');
            }

            return redirect('/login/ops');
        } catch (\Throwable $e) {
            Log::error($e);

            Auth::logout();

            return redirect('/login/ops');
        }
    }
}