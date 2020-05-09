<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;

class CheckOrderOnProduct
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
        Order::where('amount',0)->where('status',0)->delete();
        return $next($request);
    }
}
