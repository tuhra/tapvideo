<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\MyanmarPhoneNumberController as MyanmarPhoneNumberController;
use App\Player;
use App\Subscriber;
use App\Http\Helpers\MptHelper;
use Vimeo\Laravel\Facades\Vimeo;
use App\Favourite;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Model\Download;

class AppController extends MyanmarPhoneNumberController
{
    public function checkMsisdn(Request $request)
    {
    	$content = json_decode($request->getContent(), true);
        $tranid = getUUID();
        if(array_key_exists('encryptedMsisdn', $content)) {
            $encryptedMsisdn = $content['encryptedMsisdn'];
            if ($encryptedMsisdn != null) { 
                \Log::info($encryptedMsisdn);
                $decryptedMsisdn = urldecode($encryptedMsisdn);
                \Log::info($decryptedMsisdn);
                $msisdn = exec('cd /var/www/decrypt && java JavaDecryptCaller '.$decryptedMsisdn);
                \Log::info('decrypt => ' . $msisdn);
                $player = Player::where('msisdn', $msisdn)->first();
                if (empty($player)) {
                    $player = new Player();
                    $player->msisdn = $msisdn;
                    $player->save();
                }       
                $subscriber = Subscriber::where('player_id', $player->id)->first();
                if (empty($subscriber)) {
                    return response()->json(['status' => TRUE, 'screen' => 'landing', 'is_new' => TRUE, 'phone_number' => $msisdn]);
                } else {
                    if ($subscriber->is_subscribed == 1) {
                        return response()->json(['status' => TRUE, 'screen' => 'welcome', 'is_new' => FALSE, 'is_subscribed' => TRUE, 'phone_number' => $msisdn]);
                    } else {
                        return response()->json(['status' => TRUE, 'screen' => 'landing', 'is_new' => FALSE, 'is_subscribed' => FALSE, 'phone_number' => $msisdn]);
                    }
                }
            } else {
                return response()->json(['status' => FALSE, 'screen' => 'msisdn', 'message' => 'ကျေးဇူးပြု၍ MPT ဖုန်းနံပါတ်ရိုက်ထည့်ပါ။'], 401);
            }
        } else {
            $msisdn = $content['msisdn'];
            \Log::info($msisdn);
            if ($msisdn != null) {
                if ($this->is_telecom('mpt', $msisdn) == true) {
                    $player = Player::where('msisdn', $msisdn)->first();
                    if (empty($player)) {
                        $player = new Player();
                        $player->msisdn = $msisdn;
                        $player->save();
                    }        
                    $subscriber = Subscriber::where('player_id', $player->id)->first();
                    if (empty($subscriber)) {
                        return response()->json(['status' => TRUE, 'screen' => 'landing', 'is_new' => TRUE]);
                    } else {
                        if ($subscriber->is_subscribed == 1) {
                            // To Request get OTP API
                            return response()->json(['status' => TRUE, 'screen' => 'call getOTP api', 'is_new' => FALSE, 'is_subscribed' => TRUE]);
                        } else {
                            return response()->json(['status' => TRUE, 'screen' => 'landing', 'is_new' => FALSE, 'is_subscribed' => FALSE]);
                        }
                    }
                } else {
                    return response()->json(['status' => FALSE, 'screen' => 'msisdn', 'message' => 'please enter MPT phone number'], 401);
                }
            } else {
                return response()->json(['status' => FALSE, 'screen' => 'msisdn', 'message' => 'Phone number is empty'], 401);
            }
        }
    }

    public function subscribe(Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $msisdn = $content['msisdn'];
        $tranid = getUUID();
        if ($msisdn != null) {
            $data = sendOtp($msisdn, $tranid);
            $xml = $data['res'];
            $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xml);
            $result = json_decode($json,TRUE);
            $response = ['status' => FALSE, 'screen' => 'landing'];
            if ($result['error_code'] == 0) {
                $response = [
                    'status' => TRUE,
                    'transId' => $result['transId'],
                    'screen' => 'otp'
                ];
            }
            return response()->json($response);
        } else {
            return response()->json(['status' => FALSE, 'screen' => 'landing', 'message' => 'Phone number is empty'], 401);
        }
    }

    public function otpResent(Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $msisdn = $content['msisdn'];
        $tranid = $content['transId'];
        if ($msisdn != null && $tranid != null) {
            $data = resentOtp($msisdn, $tranid);
            \Log::info($data);
            $xml = $data['res'];
            $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xml);
            $result = json_decode($json,TRUE);
            $response = ['status' => FALSE, 'screen' => 'otp'];
            if ($result['error_code'] == 0) {
                $response = [
                    'status' => TRUE,
                    'transId' => $result['transId'],
                    'screen' => 'otp'
                ];
            }
            return response()->json($response);
        } elseif($msisdn == null || empty($msisdn)) {
            return response()->json(['status' => FALSE, 'screen' => 'otp', 'message' => 'Phone number is empty'], 401);
        } else {
            return response()->json(['status' => FALSE, 'screen' => 'otp', 'message' => 'Tranid is empty'], 401);
        }
    }

    public function otpValidation(Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $msisdn = $content['msisdn'];
        $tranid = $content['transId'];
        $otp = $content['otp'];
        if ($msisdn != null && $tranid != null && $otp != null) {
            $data = validationOtp($msisdn, $tranid, $otp);
            $xml = $data['res'];
            $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xml);
            $result = json_decode($json,TRUE);
            $response = ['status' => FALSE, 'screen' => 'otp', 'message' => 'system error'];
            switch ($result['error_code']) {
                case '504':
                    $response = [
                        'status' => FALSE,
                        'screen' => 'otp',
                        'message' => 'ရိုက်သွင်းထားသောနံပါတ် မှားယွင်းနေပါသည်'
                    ];
                    break;
                case '503':
                    $response = [
                        'status' => FALSE,
                        'screen' => 'otp',
                        'message' => 'သတ်မှတ် ထားသော အချိန် ကျော်သွားပါသည်'
                    ];
                    break;
                case '0':
                    $response = [
                        'status' => TRUE,
                        'screen' => 'welcome',
                        'message' => 'Success'
                    ];
                    break;
            }
            sleep(3);
            $player = Player::where('msisdn', $msisdn)->first();
            $subscriber = Subscriber::where('player_id', $player->id)->first();
            if($subscriber['is_not_enough'] == 1) {
                $response['is_not_enough'] = TRUE;
                return response()->json($response);
            } else {
                $response['is_not_enough'] = FALSE;
                return response()->json($response);
            }
        } elseif($msisdn == null || empty($msisdn)) {
            return response()->json(['status' => FALSE, 'screen' => 'otp', 'message' => 'Phone number is empty'], 401);
        } elseif($tranid == null || empty($tranid)) {
            return response()->json(['status' => FALSE, 'screen' => 'otp', 'message' => 'Tranid is empty'], 401);
        } else {
            return response()->json(['status' => FALSE, 'screen' => 'otp', 'message' => 'OTP is empty'], 401);
        }
    }

    public function checkInsufficient(Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $msisdn = $content['msisdn'];
        if ($msisdn != null) {
            $player = Player::where('msisdn', $msisdn)->first();
            $subscriber = Subscriber::where('player_id', $player->id)->first();
            if($subscriber['is_not_enough'] == 1) {
                $response['status'] = TRUE;
                $response['message'] = 'Balance is not enough.';
                $response['is_not_enough'] = TRUE;
                return response()->json($response);
            } else {
                $response['status'] = FALSE;
                $response['message'] = 'Balance is enough.';
                $response['is_not_enough'] = FALSE;
                return response()->json($response);
            }
        } else {
            return response()->json(['status' => FALSE, 'message' => 'Phone number is empty'], 401);
        }
    }

    public function xmlToJson(Request $request)
    {
        $xml = $request->getContent();
        $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        //dd($json);
        //return $json;
        $result = json_decode($json, TRUE);
        return response()->json(['error_code' => $result['error_code'], 'errorDec' =>  $result['errorDesc'], 'cgId' => $result['cgId'], 'transId' => $result['transId' ]]);  
    }

    public function categories()
    {
        $vdos = Vimeo::request('/users/68253613/videos', ['per_page' => 100], 'GET');
        return response()->json(['result' => $vdos]);
    }

    public function postFavourite(Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $msisdn = $content['msisdn'];
        $video_id = $content['video_id'];
        $video_uri = $content['video_uri'];
        $video_name = $content['video_name'];
        $video_description = $content['video_description'];
        $video_category = $content['video_category'];
        $video_pictures = $content['video_pictures'];    
        if ($msisdn != null && $video_id != null && $video_uri != null && $video_name != null && $video_pictures != null) {
            $player = Player::where('msisdn', $msisdn)->first();
            $subscriber = Subscriber::where('player_id', $player->id)->first();
            $existing_video = Favourite::where([
                                ['subscriber_id', '=', $subscriber->id],
                                ['video_id', '=', $video_id],
                            ])->first();

            if($existing_video == NULL) {
                $favourite_video = new Favourite();
                $favourite_video->subscriber_id = $subscriber->id;
                $favourite_video->video_id = $video_id;
                $favourite_video->video_uri = $video_uri;
                $favourite_video->video_name = $video_name;
                $favourite_video->video_description = $video_description;
                $favourite_video->video_category = $video_category;
                $favourite_video->video_pictures = $video_pictures;
                $favourite_video->save();
                return response()->json(['status' => TRUE, 'message'=> 'Video has been added successfully.']);   
            } else {
                return response()->json(['status' => FALSE, 'message'=> 'This video already has been added.']);
            }
        } elseif($video_id == null || empty($video_id)) {
            return response()->json(['status' => FALSE, 'message' => 'Video id is empty'], 401);
        } elseif($video_uri == null || empty($video_uri)) {
            return response()->json(['status' => FALSE, 'message' => 'Video uri is empty'], 401);
        } elseif($video_name == null || empty($video_name)) {
            return response()->json(['status' => FALSE, 'message' => 'Video name is empty'], 401);
        } elseif($video_pictures == null || empty($video_pictures)) {
            return response()->json(['status' => FALSE, 'message' => 'Video pictures is empty'], 401);
        } else {
            return response()->json(['status' => FALSE, 'message' => 'Phone number is empty'], 401);
        }
    }

    public function favourite($msisdn)
    {
        $player = Player::where('msisdn', $msisdn)->first();
        if (!empty($player)) {
            $subscriber = Subscriber::where('player_id', $player->id)->first();
            if(!empty($subscriber)) {
                $favourite_vdos = Favourite::where('subscriber_id', $subscriber->id)->get();
                $arrayName = [];
                foreach ($favourite_vdos as $key => $favourite_vdo) {
                    $fav_vdos[] =  array('video_id' => $favourite_vdo->video_id,
                                        'video_uri' => $favourite_vdo->video_uri,
                                        'video_name' => $favourite_vdo->video_name,
                                        'video_description' => $favourite_vdo->video_description,
                                        'video_category' => $favourite_vdo->video_category,
                                        'video_pictures' => $favourite_vdo->video_pictures,
                                    );
                }
                if(count($favourite_vdos) != 0) {
                   return response()->json(['status' => TRUE, 'result' => $fav_vdos, 'message' => 'Success']); 
                } else {
                    return response()->json(['status' => FALSE, 'result' => [], 'message' => 'Your favourite video is empty.']);
                }
            } else {
                return response()->json(['status' => FALSE, 'message' => 'Msisdn is not subscribed.']); 
            }
        }  else {
            return response()->json(['status' => FALSE, 'message' => 'Msisdn is not subscribed.']); 
        }
    }

    public function deleteFavourite(Request $request, $id)
    {
        $content = json_decode($request->getContent(), true);
        $msisdn = $content['msisdn'];
        if ($msisdn != null) {
            $player = Player::where('msisdn', $msisdn)->first();
            $subscriber = Subscriber::where('player_id', $player->id)->first();
            $favourite = Favourite::where([
                                ['subscriber_id', '=', $subscriber->id],
                                ['video_id', '=', $id],
                            ])->first();
            $favourite->delete();
            return response()->json(['status' => TRUE, 'message' => 'Video delete successfully']);
        } else {
            return response()->json(['status' => FALSE, 'message' => 'Phone number is empty'], 401);
        }
    }

    public function checkFavourite(Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $msisdn = $content['msisdn'];
        $video_id = $content['video_id'];
        if ($msisdn != null && $video_id != null) {
            $player = Player::where('msisdn', $msisdn)->first();
            $subscriber = Subscriber::where('player_id', $player->id)->first();
            $favourite = Favourite::where([
                                ['subscriber_id', '=', $subscriber->id],
                                ['video_id', '=', $video_id],
                            ])->first();
            if(!empty($favourite)) {
                return response()->json(['status' => TRUE, 'message' => 'This is favourite video for current user.']);
            } else {
                return response()->json(['status' => FALSE, 'message' => 'This is not favourite video for current user.']);
            }
        } elseif($video_id == null || empty($video_id)) {
            return response()->json(['status' => FALSE, 'message' => 'Video id is empty'], 401);
        }  else {
            return response()->json(['status' => FALSE, 'message' => 'Phone number is empty'], 401);
        }
    }

    /*public function unsubscribe($msisdn, $tranid) {
        $url = 'http://matestcnt.mpt.com.mm/API/CGUnsubscribe';
        $params = 'MSISDN='.$msisdn.'&productID=10500&pName=Taptube&pPrice=99&pVal=1&CpId=TAP&CpPwd=tap@123&CpName=TAP&reqMode=PIN&reqType=SUBSCRIPTION&ismID=17&transID='. getUUID() .'&sRenewalPrice=99&sRenewalValidity=1&serviceType=T_TAP_WAP_SUB_D&planId=T_TAP_WAP_SUB_D_99&request_locale=my&opId=101';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url.'?'.$params ); //Url together with parameters
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 7); //Timeout after 7 seconds
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        return ['req' => $url .'?'.$params , 'res' => $result]; 
    }*/

    public function faq() 
    {
        $contentText = "<center><h2>မေးလေ့ရှိသောမေးခွန်းများ</h2></center>
                    <br><p><strong> Q.Tap Tube ဆိုတာဘာလဲ? </strong> <br>
                    A. တရုတ်နိုင်ငံမှ အမျိုးအစားစုံလင်သော ရုပ်ရှင် များကို တစ်နေရာတည်းတွင် စုစည်းကြည့်ရှုနိုင်သော portal and App တစ်ခုဖြစ်ပါတယ်။ 
                    <br><br><strong> Q. Tap Tube ကို ဘယ်လိုမျိုးမှတစ်ဆင့် ရယူနိုင်မှာလဲ?  </strong> <br>
                    A. Tap Tube ကို MPT SMS 8934   သို့ ON ဟု SMS ပေးပို့ပြီး  ရယူနိုင်မှာဖြစ်ပါသည်။ 
                    <br><br><strong> Q. အဖိုးခ က ဘယ်လိုကောက်ခံမှာလဲ?  </strong><br>
                    A. Tap Tube မှ ဗွီဒီယိုဖိုင်များကို ကြည့်ရှုရန် အတွက် နေ့စဉ် ဝန်ဆောင်ခ 99 ကျပ်သာ ကောက်ခံသွားမှာ ဖြစ်ပြီး ဝန်ဆောင်ခ ပေးချေရန် အတွက် MPT ဆင်းကဒ် ဖြင့်သာ အသုံးပြုနိုင်မည်ဖြစ်သည်။  
                    <br><br><strong> Q. တစ်ခြား Operatorများ ဖြင့် subscribe လုပ်နိုင်မှာလား?  </strong><br>
                    A. တစ်ခြားသော operator များဖြင့် subscribe ပြုလုပ်၍ မရနိုင်ပါ။ 
                    <br><br><strong> Q. Movies တွေကို ဘယ်လို ကြည့် ရှု နိုင် မှာလဲ? </strong><br>
                    A.ဝန်ဆောင်ခ ပေးချေပြီးလျှင် Tap Tubeတွင် ရှိသော ဗွီဒီယိုဖိုင်များအားလုံးကို စတင်ကြည့်ရှုနိုင်မှာဖြစ်ပြီး ဝန်ဆောင်ခပေးချေမှုပုံစံမှာ  တစ်ရက်သာ ကြည့်ရှုနိုင်မှာဖြစ်သည်။ ဗွီဒီယိုဖိုင်များကို up to date ဖြစ်အောင် ဝန်ဆောင်မှုပေးသွားမှာလည်း ဖြစ်ပါတယ်။
                    <br><br><strong> Q. ဝန်ဆောင်ပေးချေဖို့ရန် လက်ကျန်ငွေမလုံလောက်ပါက ဘယ်လိုဖြစ်နိုင်မလဲ? </strong><br>
                    A. ဝန်ဆောင်ပေးချေဖို့ရန် လက်ကျန်ငွေမလုံလောက်ပါက Tap Tube မှ ဗွီဒီယိုများကို ဆက်လက်ကြည့်ရှုနိုင်မည် မဟုတ်ပါ။
                    <br><br><strong> Q. တစ်ခြားသော  အော်ပရေတာ အင်တာနက်ဒေတာ များ အသုံးပြု၍ ဗွီဒီယိုဖိုင်ကို ကြည့်ရှုနိုင်မှာလား? </strong><br>
                    A. တစ်ခြားသော အော်ပရေတာ အင်တာနက်ဒေတာ များ အသုံးပြု၍ ဗွီဒီယိုဖိုင်ကို မကြည့်ရှုနိုင်ပါ။ 
                    <br><br><strong> Q. Wifi ဖြင့် ဗွီဒီယိုဖိုင်ကို ကြည့်ရှုနိုင်မှာလား? </strong><br>
                    A. Wifi ဖြင့်လည်း ဗွီဒီယိုဖိုင်များကို ကြည့်ရှုနိုင်မှာဖြစ်ပါတယ်။  
                    <br><br><strong> Q.ဗွီဒီယိုဖိုင်က ဘယ်လိုအမျိုးအစားတွေပါဝင်မှာလဲ? </strong><br>
                    A.  အက်ရှင်,ဒရာမာ, ဟာသ, အချစ်,သရဲကား, စစ်ကား ,အစရှိသော တရုတ် ရုပ်ရှင်အမျိုး အစားပေါင်း များစွာပါ  ၀င်ပါတယ်။ 
                    <br><br><strong> Q. ရုပ်ရှင်တွေ ရဲ့အရည်အသွေးက ဘယ်လိုမျိုးလဲ? </strong><br>
                    A. ရုပ်ရှင် များကို 1080p,720p,540p,360p ဖြင့် မိမိနှစ်သက်သော အရည်သွေး ကို ရွေးချယ် ကြည့်ရှု နိုင်ပါသည် 
                    <br><br><strong> Q. Tap Tube ၀န်ဆောင်မှု ကို ဘယ် လိုရပ်ဆိုင်း နိုင်မှာလဲ? </strong><br>
                    A. Tap Tube တွင် ပါဝင်သည့် profile အတွင်းမှ  “၀န်ဆောင်မှု ရပ်ဆိုင်းမည်” စာသားအားဖိနှိပ်ပြီး ဖျက်သိမ်းနိုင်မှာဖြစ်သလို  ‘8934’  သို့  OFF ဟု  SMS ပေးပို့ပြီးလည်း ဖျက်သိမ်းနိုင်ပါသည်။
                    <br><br><br><strong> Q. What is Tap Tube? </strong><br>
                    A. The Tap Tube is Chinese Movies Wap Portal and Mobile Application that can stream a wide variety of chinese movies in one place.
                    <br><br><strong> Q. How can I subscribe the service?</strong><br>
                    A. You can send with MPT SMS “ON” to 8934 to get Tap Tube.
                    <br><br><strong> Q. How can I pay for service fees? </strong><br>
                    A. (99) Kyats per day including commercial tax 5% only for MPT users.
                    <br><br><strong> Q. Can I subscribe the service with other operators’ SIM? </strong><br>
                    A. No, this application is only for MPT user.
                    <br><br><strong> Q. How to get the video?</strong><br>
                    A. After paying the service, you will be able to view all video files on the Tap Tube Website and pay only one day. Up to date, video files will be provided.
                    <br><br><strong> Q. If I do not have enough balance, can I still use the service?</strong><br>
                    A. No, the user cannot watch all videos if not having enough balance in your phone.
                    <br><br><strong> Q.Can I watch all tap tube videos by using other operators 'internet data?</strong><br>
                    A. Can’t watch by using the other operators' internet data or Wi-Fi.
                    <br><br><strong> Q. Can I watch all tap tube videos with Wi-Fi? </strong><br>
                    A. Yes, the user can watch all tap tube videos with Wi-Fi.
                    <br><br><strong> Q.  What kind of quality movies are available on Tap tube?</strong><br>
                    A.  All the movies from Tap Tube are available at 1080p, 720p, 540p,360p .You can choose your favorite quality and enjoy it.
                    <br><br><strong> Q. How can I cancel the service? </strong><br>
                    A. Go to My Profile page in the tap tube application and click the UNSUBSCRIBE and ‘OFF’ to send with SMS to 8934.
                </p>";
        return response()->json(['status' => TRUE, 'data' => $contentText]);
    }

    public function tandc() 
    {
        $contentText = "<h3>စည်းမျဉ်းသတ်မှတ်ချက်မျာ</h3>
                    <br><p>
                    'Tab Tube Chinese Movies' ဝန်ဆောင်မှု၏စည်းမျဉ်းစည်းကမ်းများ <br><br>
                    'Tap Tube' ဝန်ဆောင်မှု ၏ စည်းမျဉ်းစည်းကမ်းများ 'Tap Tube' ဝန်ဆောင်မှုကိုအသုံးမပြုမီ ဤစည်းမျဉ်းစည်းကမ်းများကို ဖတ်ရှုနားလည်သိရှိထားရန်လို အပ်ပါသည်။ ဤစည်းမျဉ်းစည်းများအရ <br><br>
                    'Tap Tube' ဝန်ဆောင်မှု ကို စီမံဆောင်ရွက်လျှက်ရှိပါသည်။ သင်သည် 'Tap Tube' ဝန်ဆောင်မှု သို့ ဝင်ရောက်အသုံးပြုနေသူဖြစ်ပါက ဤစည်းမျဉ်းစည်းကမ်းများကို သဘောတူလက်ခံပြီးဖြစ်ကြောင်း အတည်ပြုပါသည်။  ဤစည်းမျဉ်း စည်းကမ်းများ၏ အကြောင်းအရာတစ်ခုခုကို လက်ခံသဘောတူညီမှုမရှိပါက Tap Tube” ဝန်ဆောင်မှု ကို အသုံးပြုနိုင်မည် မဟုတ်ပါ။ <br><br>
                    <strong> User</strong> ကန့်သတ်ချက်<br><br>
                    ၁။ <strong> 'Tap Tube'</strong> ဝန်ဆောင်မှုအား<strong> MPT </strong>ဆင်းမ်ကတ်အသုံးပြုသူများအားလုံး အခပေးစနစ်ဖြစ် အသုံးပြုနိုင်  ပါသည်။<strong> MPT</strong> ဆင်းမ်ကတ်ပိုင်ရှင် သို့မဟုတ် ဆင်းမ်ကတ်အသုံးပြုရန် ပိုင်ရှင်၏ခွင့်ပြုချက် ရရှိထားသူများကို အခပေး သုံးစွဲသူအဖြစ် သတ်မှတ်သွားမည်ဖြစ်သည်။<br>
                    ၂။<strong>'Tap Tube'</strong> ဝန်ဆောင်မှုအား အသုံးပြုသူသည် အောက်ဖော်ပြပါ စည်းကမ်း သတ်မှတ်ချက်များကို သဘော တူညီမှုပြုလုပ်ရန်လိုအပ်ပါသည်။  စည်းမျဉ်းစည်းကမ်းများကို ပြင်ဆင်ခြင်း<br><br>
                    ၁။ စည်းမျဉ်းစည်းကမ်းများကို လိုအပ်သည့်အချိန်၌ ပြင်ဆင်ခြင်း   သို့မဟုတ် ဖြည့်စွက်ခြင်း စသည်တို့အားလုပ်ပိုင်ခွင့်ရှိပါသည်။ ထိုဆောင်ရွက်မှုများ အကောင်အထည်ပေါ်လာပါက စည်းမျဉ်းစည်းကမ်း အသစ်များကို စတင်အသုံးမပြုမီ ၁၅ ရက်ခန့် ကြိုတင်၍ အကြောင်းကြားနိုင်ရန်ကြိုးစားပါမည်။ <br>
                    ၂။ <strong>'Tap Tube'</strong> ဝန်ဆောင်မှုကို အခပေး အသုံးပြုနေသော သူများအတွက် အခါအားလျှော်စွာ ကျင်းပပြု လုပ်လေ့ ရှိသော
                     <strong>Promotion</strong> များနှင့် အခြားသော <strong>Campaign</strong> များအတွက် လိုအပ်သောစည်းမျဉ်းစည်းများကို လိုအပ်သလို ထုတ်ပြန် ကြေငြာသွားမည်ဖြစ်ပြီး အငြင်းပွားမှုကိစ္စ အကြောင်းအရာ  တစ်စုံတစ်ရာ ရှိခဲ့ပါက<strong> “Tap Tube”</strong> ဝန်ဆောင်မှု ဆုံးဖြတ်ချက် အတိုင်းသာ သဘောတူ နားလည်ပြီး လိုက်နာဆောင်ရွက်ရမည်ကို သိရှိပြီးဖြစ်ပါသည်။<br><br>
                    အဖိုးအခ ကောက်ခံခြင်း <br><br>

                    လက်ရှိအသုံးပြုလျက်ရှိသော<strong>'Tap Tube'</strong>ဝန်ဆောင်မှုသည် စာရင်းပေးသုံးစွဲ သောဝန်ဆောင်မှု ရယူထားရန် လိုအပ်ပါသည်။
                    <strong>“Tap Tube”</strong> ဝန်ဆောင်မှု အတွက် တစ်ရက်လျှင်<strong>99</strong>ကျပ် သာ ကျသင့်မည်ဖြစ်ပါသည်။ အဖိုးအခ ကောက်ခံသည့် အကြိမ်ရေမှာ စဉ်ဆက်မပြတ်  နေ့စဉ် ကောက်ခံမှုရှိ သည့် ၃၆၅ ရက် ပက်ကေ့ချ် ဖြစ်ပါသည်။ စာရင်းပေးသုံးစွဲမှုအမျိုးအစား ဝန်ဆောင်မှု၏ တရားဝင်မှု ကာလမှာ ၃၆၅ ရက်ဖြစ်ပါသည်။  လူကြီးမင်း၏လက်ကျန်ငွေမလုံလောက်လျှင်အဖိုးအခကောက်ခံမည်မဟုတ်ပါ။ မည်သည့်အကြောင်းကြောင့် ငွေကောက်ခံခြင်းမရှိပါက လူကြီးမင်းအနေဖြင့် ထိုနေ့အတွက်ဝန်ဆောင်မှုအသုံးပြုနိုင်မည်မဟုတ်ပါ။  လက်ကျန်ငွေလုံလောက်သည့်အချိန်မှသာ အဖိုးအခကောက်ခံခြင်းနှင့် ဝန်ဆောင်မှုအသုံးပြုခြင်းအား ဆက်လက် လုပ်ဆောင်ပါမည်။<strong>'Tap Tube'</strong> အားအသုံးပြုရန် အောင်မြင်စွာ စာရင်းပေးသွင်းပြီးပါက
                    <strong>SMS</strong> ပေးပို့သွားမည်ဖြစ်သည်။  နောက်ကြောင်းပြန်၍ ငွေကောက်ခံခြင်းပြုလုပ်မည်မဟုတ်ပါ။ မည်သည့်အကြောင်းကြောင့် ငွေကောက်ခံ ခြင်းမရှိလျှင် ထိုနေ့များအတွက် လူကြီးမင်းထံမှ အဖိုးအခကောက်ခံမည်မဟုတ်ပါ။  လူကြီးမင်းအနေဖြင့် စာရင်းပေးသုံးစွဲမှုကို အတည်ပြုပြီး လူကြီးမင်းကို ငွေကောက်ခံသည့် နေ့မှစ၍ လူကြီး မင်းကို တစ်ဆက်တည်း ရက်ပေါင်း (၉၀) အတွက် ငွေကောက်ခံထားခြင်း မရှိပါက စာရင်းပေးသုံးစွဲမှု အလိုလျောက်ရပ်စဲမည်ဖြစ်သည်။  အကယ်၍ ဝန်ဆောင်မှုကို အခမဲ့မဟုတ်သော စမ်းသပ်အသုံးပြုသည့် ကာလတစ်ခုအတွက် စာရင်းပေးသုံးစွဲ ရန် တောင်းဆိုမှုပြုလုပ်ပြီး လူကြီးမင်းထံတွင် လုံလောက်သော ငွေလက်ကျန်မရှိပါက ကျွန်ုပ်တို့အနေဖြင့် လူကြီးမင်းအား နောင်လာမည့် တစ်ဆက်တည်း နေ့ရက် သုံး(၃) ရက်အတွင်း ငွေကောက်ခံရန်  ကြိုးပမ်းသွား ပါမည်။ လူကြီးမင်းတွင် လုံလောက်သော ငွေလက်ကျန်မရှိဘဲ ထိုတစ်ဆက်တည်း (၃) ရက်အတွင်း ငွေ ကောက်ခံမရရှိပါက ဝန်ဆောင်မှု စာရင်းပေးသုံးစွဲရန် တောင်းဆိုမှု အလိုအလျောက် ရပ်စဲမည်ဖြစ်သည်။  လူကြီးမင်း၏ အကြောင်းအရာအား ရှာဖွေမှုပြုခြင်းနှင့် ဒေါင်းလော့လုပ်ခြင်းအတွက် ဒေတာအဖိုးအခ ကျသင့် ပါမည်။ ကောက်ခံမှုအားလုံးတွင် ကုန်သွယ်ခွန် ၅% ပါဝင်မည်ကို သတိပြုပါ။  ဝန်ဆောင်မှုအတွက် စာရင်းပေးသုံးစွဲခြင်းအပါအဝင် ၎င်းချည်းသာဟု ကန့်သတ်မထားဘဲ လူကြီးမင်း၏မိုဘိုင်း အင်တာနက်ကို မျှဝေသုံးစွဲသည့် တတိယပုဂ္ဂိုလ်တစ်ဦးဦး၏ ပြုမူဆောင်ရွက်ချက်အတွက် လူကြီးမင်းတွင် တာဝန်ရှိပါသည်။  အဆိုပါ စည်းကမ်းချက်များ သည် လူကြီးမင်းအနေဖြင့် စာရင်းပေး သုံးစွဲမှုကိုရပ်တန့်ခြင်း သို့မဟုတ် အဆိုပါ စည်းကမ်းချက်များအရ ဝန်ဆောင်မှု အလိုအလျောက် ရပ်စဲခြင်း အချိန်ထိ တရားဝင် တည်ရှိမည်ဖြစ်သည်။<br><br>
                       သဘောတူညီချက်ကာလ<br><br>
                       ဤစည်းမျဉ်းစည်းကမ်းများသည်<strong> Tap Innovations Co.,Ltd</strong> ၏ <strong>Tap Tube </strong>နှင့် သုံးစွဲသူကြား သဘောတူညီချက် ဖြစ်ပြီး <strong>Tap Innovations Co.,Ltd</strong> မှ အချိန်မရွေး ပြုပြင်ပြောင်းလဲနိုင်သည်။ ဤသဘောတူညီချက်သည်<strong>“Tap Tube”</strong> စတင်အသုံးပြုသည့်နေ့မှစ၍ အကျုံးဝင်မည်ဖြစ်ပြီး မသုံးစွဲတော့သည်အထိတိုင် ဤစည်းကမ်းသတ်မှတ်ချက်များနှင့်အညီ လိုက်နာကျင့်သုံးရမည်ဖြစ်သည်။ ဝန်ဆောင်မှုရယူပြီးပါက တစ်ရက်လျှင် ဝန်ဆောင်ခအနေဖြင့် <strong>99</strong>ကျပ်နှုန်းဖြင့် ကောက်ခံသွွားမှာ ဖြစ်ပါတယ်။ နားလည်မှုလွဲခြင်း ကိစ္စရပ်များအား ရှောင်ရှားရန်အတွက် ဝန်ဆောင်မှုစတင်အသုံးပြုသည့်နေ့စွဲအား  စာရင်းပေးသွင်းသည့်နေ့စွဲအတိုင်းဖြစ်ကြောင်း ယူဆမည်ဖြစ်သည်။<br><br><br>
                    <strong>Terms and conditions of “Tap Tube” Service</strong><br><br>
                      You should have known and agree the following Terms and Conditions (the “Terms”) before using Tap Tube Portal Service. The Chinese portal is being operated according to these terms and conditions. By taking service and using the application, you signify that you have read, understood, and agree to be bound by these Terms and Conditions and any other applicable rules, policies and terms associated therewith (collectively, the “Terms”).If you cannot accept and agree the Terms, you would not be able to use the application. <br><br>
                      User Limitation<br><br>
                      All MPT SIM card users are able to use 'Tap Tube'service by accepting of charging daily service fees. MPT users who agree the Terms and use the application will be recognized as daily paid user.If you would like to use “Tap Tube” service, you should have to follow and accept the following terms and conditions.<br><br>
                      Amendment of Terms and Conditions<br><br>
                      1. We have the right for amendment and supplement of the Terms if it is necessary.If we would really need to carry out those actions, we would firstly inform all users 15 days in advance.<br><br>

                      2. There will be occasional special promotions and campaigns for users and the necessary Terms for those promotions and campaigns will be announced in time. You properly should have known that if there were any argument concerned with those promotions and campaigns,only the decision of the application would be confirmed.<br><br>
                      Charges<br><br>
                      Ongoing use of Service requires an active Subscription. Tap Tube service fees is 99 Ks/day. Charging frequency is daily charging with 365 days package. The validity period of a Subscription-type Service is 365 days.<br>
                      If you have insufficient balance, you will not be charged. If payment is not charged for any reason, you will not be able to use the Service on that day.<br>
                      Charging and use of Service will resume when you have sufficient balance.<br>
                      There is no retroactive charging of payment. You will not be charged for days when payment is not charged for any reason.<br>
                      The Subscription will be automatically terminated if payment is not charged for 90 consecutive days from the day you have confirmed the Subscription and been charged.<br>
                      Data charges may apply for your browsing and downloading of content. Please note that all charges include 5% Commercial Tax.<br>
                      You are responsible for the actions of any third party with whom you are sharing your mobile internet including, but not limited to, Subscription to the Service.<br>
                      These Terms are valid until you unsubscribe or until the Service is automatically terminated pursuant to these Terms.<br><br>
                      The Agreement term<br><br>
                      These above rules are the agreement for the Tap Tube of Tap Innovations Company and the user and they can be changed at any time from Tap Innovations Company. This agreement will be eligible from the date of subscription until subscription, these terms and conditions must be in accordance with enforcing. After subscription, the service fee, 99 Kyats will be charged per day. In order to avoid misunderstanding issues, the service using date will be considered as the service subscription date.                        
                    </p>";
        return response()->json(['status' => TRUE, 'data' => $contentText]);
    }

    public function help(Request $request) 
    {
        $content = json_decode($request->getContent(), true);
        $data = array(
            'name'      =>  $content['name'],
            'email'   =>  $content['email'],
            'phone'   =>  $content['phone'],
            'subject'   =>  $content['subject'],
            'message'   =>  $content['message']
        );
        Mail::to($content['email'])->send(new SendMail($data));
        return response()->json(['status' => TRUE, 'message' => 'Your message has been sent successfully']);
    }

    public function about() 
    {
        $appstore_link = "https://www.google.com/";
        $playstore_link = "https://www.google.com/";
        $label_one = "<div> 
                            TAP Tube ဆိုတာ တရုတ်ရုပ်ရှင်ဇာတ်လမ်းများကို အချိန်မရွေး နေရာမရွေး ကြည့်ရှုနိုင်တဲ့ 
                            Website/ APP တစ်ခုဖြစ်ပါတယ်။ Internet ချိတ်ဆက်ထားသောဖုန်းများ၊ တက်ဘလက်များ စသည်ဖြင့် TAP Tube ဝန်ဆောင်မှုအတွက်မှတ်ပုံတင်တားတဲ့ ဖုန်းနံပါတ်ဖြင့် ငွေပေးချေပြီး တိုက်ရိုက်ကြည့်ရှုနိုင်ပါတယ်။
                        </div>";

        $label_two = "<div> 
                        တရုတ်နိုင်ငံမှ HD အရည်သွေးဖြင့်ဇာတ်ကားကောင်းများကို English / မြန်မာ စာတန်းထိုး နှစ်မျိုးစလုံး
                        နှင့်ကြည့်ရှုနိုင်ပါသည်။ ဇာတ်လမ်းတွေကြည့်ရှုဖို့ ရွေးချယ်ရခက်နေပါသလား။ စိတ်လှုပ်ရှားစရာဇာတ်ကားကောင်းများအား အပါတ်စဉ်တင်ဆက်ပေးမှာဖြစ်ပါတယ်။ သင့်ကိုကြည့်ရှုဖို့
                        သူငယ်ချင်းမှအကြံပေးသော ရုပ်ရှင်နာမည်ကိုမေ့နေပါသလား။ ကိစ္စမရှိပါဘူး။ သရုပ်ဆောင်နာမည်၊
                        ဇာတ်လမ်းအမျိုးအစားအကြောင်းအရာ နည်းနည်းသိရုံဖြင့် ရှာဖွေလို့ရပါတယ်။ အက်ရှင်၊ ဒရာမာ၊ ဟာသ၊ အချစ်၊ သရဲကား၊ စစ်ကား အစရှိသော တရုတ်ရုပ်ရှင်အမျိုးအစားပေါင်းများစွာကို ကြည့်ရှုနိုင်ပါတယ်။
                        <br><br>
                        ရုပ်ရှင်တွေကိုကြည့်ရှုဖို့ APP အား Google Play Store မှ Download ဆွဲ၍သော်၎င်း၊ <a href='http://taptubemm.com/'>www.taptubemm.com</a>
                        Website မှ ၎င်းဝန်ဆောင်မှုရယူပြီး <b>တစ်ရက် (၉၉) ကျပ်</b> ဖြင့် ကြည့်ရှုနိုင်မှာ ဖြစ်ပါတယ်။ 
                    </div>";
        return response()->json(['status' => TRUE, 'app_store' => $appstore_link, 'play_store' => $playstore_link, 'label_one' => $label_one, 'label_two' => $label_two]);
    }

    public function checkSubscriber(Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $msisdn = $content['msisdn'];
        if ($msisdn != null) {
            $player = Player::where('msisdn', $msisdn)->first();
            if($player != null) {
                $subscriber = Subscriber::where('player_id', $player->id)->first();
                if($subscriber != null) {
                    if($subscriber['is_subscribed'] == 1) {
                        $response['status'] = TRUE;
                        $response['message'] = 'This MSISDN is subscriber';
                        return response()->json($response);
                    } else {
                        $response['status'] = FALSE;
                        $response['message'] = 'This MSISDN is not subscriber';
                        return response()->json($response);
                    }
                } else {
                    $response['status'] = FALSE;
                    $response['message'] = 'This MSISDN is not subscriber';
                    return response()->json($response);
                }
            } else {
                $response['status'] = FALSE;
                $response['message'] = 'This MSISDN is not subscriber';
                return response()->json($response);
            }
        } else {
            return response()->json(['status' => FALSE, 'message' => 'Phone number is empty'], 401);
        }        
    }

    public function getDownloadLink(Request $request) {
        $data = $request->all();
        $response = [];
        if (empty($data)) {
            $response = [
                'success' => false,
                'message' => "parameter missing",
            ];
            return response()->json($response);
        }
        $vdo = Vimeo::request('/videos/'.$data['video_id'].'/texttracks', [], 'GET');
        // dd($vdo['body']['data']);
        if (array_key_exists('video_id', $data)) {
            $row = Download::where('video_id', $data['video_id'])->first();
            if (empty($row)) {
                $response = [
                    'success' => false,
                    'message' => "video_id not found",
                ];
            } else {
                $response = [
                    'success' => true,
                    'download_link' => urlencode($row->download_link),
                ];
                if($vdo['body']['total'] > 0)
                {
                    foreach ($vdo['body']['data'] as $key => $subtitle) {
                        if($subtitle['active'] == true && $subtitle['type'] == 'subtitles')
                        {
                            $response['subtitle'][$key] = array(
                                'type' => $subtitle['language'],
                                'url' => $subtitle['link']
                            );
                            //$response['subtitle'][$key] = $subtitle['link'];
                        }
                    }
                }      
            }
        } else {
            $response = [
                'success' => false,
                'message' => "parameter missing",
            ];
        }
        return response()->json($response);
    }

}
