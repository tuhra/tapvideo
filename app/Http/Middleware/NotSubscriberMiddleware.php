<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Subscriber;

class NotSubscriberMiddleware
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

        $data = $request->all();
        if (array_key_exists('clickid', $data)) {
            mobipium_cpc_creation($data);
            Session::put('clickid', $data['clickid']);
        }

        return $next($request);

        // $player_id = Session::get('player_id');
        // $subscriber = Subscriber::where('player_id', $player_id)->first();
        // $error_code = Session::get('error_code');
        // $operationId = Session::get('operationId');
        // if(!empty($subscriber)) {
        //     if ($subscriber->is_subscribed == 1 && $error_code != null) {
        //         return redirect(route('frontend.welcome'));
        //     } elseif ($subscriber->is_subscribed == 1 && $operationId != null) {
        //         return redirect(route('frontend.welcome'));
        //     }
        // }
        // return $next($request);
    }
}
