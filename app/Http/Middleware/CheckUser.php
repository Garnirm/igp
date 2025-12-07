<?php

namespace App\Http\Middleware;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    public function handle(Request $request, \Closure $next): Response|RedirectResponse|JsonResponse
    {
        if (!Auth::check()) {
            if ($request->ajax()) {
                return response()->json([ 'success' => false, 'errors' => [ 'Not authenticated.' ] ], 403);
            }

            return redirect('/');
        }

        return $next($request);
    }
}
