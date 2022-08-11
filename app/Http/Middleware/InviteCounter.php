<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InviteController;

class InviteCounter
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
        // $invites = 0;
        // if (isset(Auth::user()->created_at)) {
        //   $now = time(); // or your date as well
        //   $your_date = strtotime(Auth::user()->created_at->format('Y-m-d'));
        //   $datediff = $now - $your_date;
        //   $invites = round($datediff / (60 * 60 * 24 * 30));
        // }
        // view()->share('inviteCounter', $invites);
        // return $next($request);
        view()->share('inviteCounter', InviteController::availableInvites());
        return $next($request);
    }
}
