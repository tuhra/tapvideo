<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Subscriber;

class SubscriberMiddleware
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
        /*dd(Session::get('operationId'));*/
        $player_id = Session::get('player_id');
        $subscriber = Subscriber::where('player_id', $player_id)->first();
        $error_code = Session::get('error_code');
        $operationId = Session::get('operationId');
        if(!empty($subscriber)) {
            if ($subscriber->is_subscribed == 0) {
                return redirect(route('frontend.msisdn'));
            } else {
                if ($error_code == null && $operationId == null) {
                    return redirect(route('frontend.msisdn'));
                }
            }
        } else {
            return redirect(route('frontend.msisdn'));
        }
        return $next($request);
    }
}
