<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class MessageController extends Controller
{
    public function blacklist()
    {
    	return view('frontend.messages.blacklist');
    }

    public function unsubscribe_success()
    {
    	/*print_r(Session::get('msisdn'));
        echo "<br/>";
        print_r(Session::get('player_id'));
        echo "<br/>";
        print_r(Session::get('error_code'));
        echo "<br/>";
        print_r(Session::get('operationId'));*/
    	return view('frontend.messages.unsubscribe');
    }

    public function insufficient_balance()
    {
        return view('frontend.messages.insufficient_balance');
    }
}
