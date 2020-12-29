<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Player;
use App\Subscriber;
use App\SubscriberLog;

class SubscriberController extends Controller
{
	public function postUnsubscribe()
    {
        Session::forget('insufficient');
        $player_id = Session::get('player_id');
        $player = Player::find($player_id);
        $msisdn = $player->msisdn;
        $subscriber = Subscriber::where('player_id', $player_id)->first();
        $data = unsubscribe_process($msisdn, $subscriber->tranid);
        \Log::info($data);
        $xml = $data['res'];
        $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $result = json_decode($json,TRUE);
        // for testing
        //$result['error_code'] = 0;    
        if ($result['error_code'] == '0') {
            Session::forget('msisdn');
            Session::forget('player_id');
            Session::forget('error_code');
            Session::forget('operationId');
            Session::forget('onetimePopup');
            Subscriber::where('player_id', $player_id)
                ->update([
                    'is_subscribed' => 0
                ]);
            $subscriber_log = new SubscriberLog;
            $subscriber_log->player_id = $player_id;
            $subscriber_log->event = 'UNSUBSCRIBED';
            $subscriber_log->channel_id = 0;
            $subscriber_log->save();
            return redirect('unsubscribe_success');
        }
        return redirect('/welcome');
    }

    public function unsubscribe()
    {
        $msisdn = Session::get('msisdn');
        return view('frontend.unsubscribe', compact('msisdn'));
    }

    public function myaccount()
    {
        $msisdn = Session::get('msisdn');
        return view('frontend.myaccount', compact('msisdn'));
    }

    public function logout()
    {
        Session::forget('msisdn');
        Session::forget('player_id');
        Session::forget('error_code');
        Session::forget('operationId');
        Session::forget('onetimePopup');
        return redirect(route('frontend.msisdn'));
    }
}
