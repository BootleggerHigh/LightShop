<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Support\Facades\Auth;

class PersonOrders
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
        if($request->route()->hasParameters('basket') &&
            (!empty($request->route()->Parameters('basket'))))
        {
           $order = Order::find($request->route()->parameter('basket'));
           if(is_null($order->where('email',Auth::user()->email)->first())) {
               return redirect()->back();
           }
        }
        return $next($request);
    }
}
