<?php

namespace App\Domains\Public\Controllers;

use App\Domains\Public\Data\LoginOpsPostData;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends BaseController
{
    public function ops(): Response
    {
        return Inertia::render('Public/Login/Ops');
    }

    public function opsPost(LoginOpsPostData $data): RedirectResponse
    {
        $admin = User::query()->where('email', 'admin@pnu.dra')->first();

        if ($admin instanceof User) {
            Auth::loginUsingId($admin->id);

            return redirect('/ops');
        }

        $admin = new User();
        $admin->email = 'admin@pnu.dra';
        $admin->password = Hash::make('test');
        $admin->lastname = 'Admin';
        $admin->firstname = 'PNU';
        $admin->save();

        Auth::loginUsingId($admin->id);

        return redirect('/ops');

        /*try {
            if (Auth::attempt($data->toArray())) {
                return redirect('/ops');
            }

            return redirect('/login/ops');
        } catch (\Throwable $e) {
            Log::error($e);

            Auth::logout();

            return redirect('/login/ops');
        }*/
    }
}