<?php

namespace App\Http\Middleware;

use Closure;
use MonelyzeDB;
use Auth;

class CheckMonthlyInput
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_id = Auth::id();
        $year = date('Y', time());
        $month = date('m', time());

        $is_empty = MonelyzeDB::isEmptyMonthlyInput($user_id, $year, $month);

        if(!array_shift($is_empty)->emp) {
            return redirect('/monthlyInput'); // 月初入力ページにリダイレクト
        }

        return $next($request);
    }
}
