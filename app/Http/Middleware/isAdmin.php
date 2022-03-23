<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $role = Session::get('role');

        $user_anggota = app('firebase.firestore')->database()->collection('users');
        $user = $user_anggota->document($role)->snapshot()->data();

        if($user['role'] == '1' || $user['role'] == '3' ) {
            return $next($request);
        } else {
            return redirect()->route('login')->with('error', 'ada kesalahan');
        }
    }
}
