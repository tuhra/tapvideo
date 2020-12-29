<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\MyanmarPhoneNumberController as MyanmarPhoneNumberController;
use App\Http\Middleware\NotSubscriberMiddleware;
use Session;
use App\Player;
use App\Subscriber;
use DB;
use App\Http\Helpers\MptHelper;

class HomeController extends MyanmarPhoneNumberController
{
    public function index(Request $request) 
    {
        $data = $request->all();

        if (array_key_exists('channel', $data)) {
            Session::put('channel', $data['channel']);
            channel();
        }
        $aes = new MptHelper;
        $url = $aes->mptHe();
        return view('frontend.he', compact('url'));
    }

    public function singleHE(Request $request)
    {
        $sshe = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        \Log::info($sshe);
        $data = $request->all();
        if ($data['Reason'] == 'WIFI') {
            return redirect('msisdn');
        } else {
            if($data['MSISDN'] == null) {
                return redirect('msisdn');
            } else {
                \Log::info('encrypted => ' . $data['MSISDN']);
                $msisdn = exec('cd /var/www/decrypt && java JavaDecryptCaller '.$data["MSISDN"]);
                \Log::info('decrypt => ' . $msisdn);
                if (NULL == $msisdn) {
                    return redirect('/msisdn');
                }
                $player = Player::where('msisdn', $msisdn)->first();
                if (empty($player)) {
                    $player = new Player;
                    $player->msisdn = $msisdn;
                    $player->save();
                }
                Session::put('msisdn', $msisdn);
                Session::put('player_id', $player->id);
                $subscriber = Subscriber::where('player_id', $player->id)->first();
                if (empty($subscriber)) {
                    return redirect('landing');
                } else {
                    if ($subscriber->is_subscribed == 1) {
                        Session::put('error_code', '0');
                        return redirect(route('frontend.welcome'));
                    } else {
                        return redirect('landing');
                    }
                }
            }
        }
    }

    public function msisdn() 
    {
        /*print_r(Session::get('msisdn'));
        echo "<br/>";
        print_r(Session::get('player_id'));
        echo "<br/>";
        print_r(Session::get('error_code'));
        echo "<br/>";
        print_r(Session::get('operationId'));*/
        return view('frontend.msisdn');
    }

    public function postMsisdn(Request $request) 
    {
        if ($request->phone == null) {
            session()->flash('error', 'ကျေးဇူးပြု၍ MPT ဖုန်းနံပါတ်ရိုက်ထည့်ပါ။');
            return redirect(route('frontend.msisdn'));
        } else {
            $msisdn = '95';
            $msisdn = $msisdn.$request->phone;
            if ($this->is_telecom('mpt', $msisdn) == true) {
                $player = Player::where('msisdn', $msisdn)->first();
                if (empty($player)) {
                    $player = new Player();
                    $player->msisdn = $msisdn;
                    $player->save();
                }
                Session::put('msisdn', $msisdn);
                Session::put('player_id', $player->id);
                $tranid = getUUID();
                Session::put('tranid', $tranid);
                $subscriber = Subscriber::where('player_id', $player->id)->first();
                if (empty($subscriber)) {
                    return redirect(route('frontend.landing'));
                } else {
                    if ($subscriber->is_subscribed == 1) {
                        $data = otp($msisdn, $tranid);
                        \Log::info($data);
                        $xml = $data['res'];
                        $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
                        $json = json_encode($xml);
                        $result = json_decode($json,TRUE);
                        return redirect(route('frontend.otp'));
                    } else {
                        return redirect(route('frontend.landing'));
                    }
                }
            } else {
                session()->flash('error', 'ကျေးဇူးပြု၍ MPT ဖုန်းနံပါတ်ရိုက်ထည့်ပါ။');
                return redirect(route('frontend.msisdn'));
            }
        }
    }

    public function landing()
    {
        /*print_r(Session::get('msisdn'));
        echo "<br/>";
        print_r(Session::get('player_id'));
        echo "<br/>";
        print_r(Session::get('error_code'));*/
    	return view('frontend.landing');
    }

    public function subscribe()
    {
        $msisdn = Session::get('msisdn');
        $tranid = getUUID();
        if (Session::get('channel')) {
            createTmpChannel($tranid, Session::get('channel'));  
        }
        $url = 'http://macnt.mpt.com.mm/API/CGRequest?CpId=TAP&MSISDN='.$msisdn.'&productID=10500&pName=Taptube&pPrice=99&pVal=1&CpPwd=tap@123&CpName=TAP&reqMode=WAP&reqType=SUBSCRIPTION&ismID=17&transID='. getUUID() .'&sRenewalPrice=99&sRenewalValidity=1&request_locale=my&serviceType=T_TAP_WAP_SUB_D&planId=T_TAP_WAP_SUB_D_99';
        \Log::info($url);
        return(redirect($url));
    }

    public function otp() 
    {
       /* print_r(Session::get('msisdn'));
        echo "<br/>";
        print_r(Session::get('player_id'));*/
    	return view('frontend.otp');
    }

    public function otpResent()
    {
        $data = otpRegeneration();
        \Log::info($data);
        $xml = $data['res'];
        $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $result = json_decode($json,TRUE);
        $response = [];
        $response['success'] = true;
        return redirect(route('frontend.otp'));
    }

    public function otpValidation(Request $request)
    {
        $data = $request->all();
        $otp = $data['otp'];
        $msisdn = Session::get('msisdn');
        $data = otpValidation($msisdn, $otp);
        $xml = $data['res'];
        $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $result = json_decode($json,TRUE);

        // for testing
        // $result['error_code'] = 0;
        
        if($result['error_code'] === '504') {
            session()->flash('error', 'ရိုက်သွင်းထားသောနံပါတ် မှားယွင်းနေပါသည်');
            return redirect()->back();
        }
        if($result['error_code'] == '503') {
            session()->flash('error', 'သတ်မှတ် ထားသော အချိန် ကျော်သွားပါသည်');
            return redirect(route('frontend.otp'));
        }
        if ($result['error_code'] == '0') {
            Session::put('error_code', '0');
            return redirect(route('frontend.welcome'));
        } else {
            session()->flash('error', 'System error');
            return redirect('otp');
        }
    }

    public function faq() 
    {
    	return view('frontend.faq');
    }

    public function tandc() 
    {
        return view('frontend.tnc');
    }

    public function help() 
    {
        return view('frontend.help');
    }

    public function about() 
    {
        return view('frontend.about');
    }

    public function termandcondition() 
    {
        return view('frontend.termandcondition');
    }
}
