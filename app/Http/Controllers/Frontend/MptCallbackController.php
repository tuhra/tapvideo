<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Player;
use App\Subscriber;
use App\Channel;
use DB;
use Session;
use App\Model\amor_cpa;

class MptCallbackController extends Controller
{
	private $reqBody;
	private $status_code;
	private $message;
	private $tranid;
	private $vDay;
	private $link;
    private $channel;

	public function callback(Request $request)
	{
		$callback = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$this->reqBody = $callback;
		
		$data = $request->all();
		$msisdn = $data['callingParty'];

		if (array_key_exists('result', $data)) {
			$this->message = $data['result'];
		}

		if (array_key_exists('operationId', $data)) {
			$operationId = $data['operationId'];
		}

		if (array_key_exists('sequenceNo', $data)) {
			$this->tranid = $data['sequenceNo'];
		}

		if (array_key_exists('chargeAmount', $data)) {
			$chargeAmount = $data['chargeAmount'];
		}

		if (array_key_exists('validityDays', $data)) {
			$this->vDay = $data['validityDays'];
		}

        if (array_key_exists('bearerId', $data)) {
            $this->channel = $data['bearerId'];
        }

        $channel_id = channel($this->channel);

		$player = Player::where('msisdn',$msisdn)->first();
        if(empty($player)) {
            $player = new Player;
            $player->msisdn = $msisdn;
            $player->msisdn = $msisdn;
            $player->save();
        }

		if (array_key_exists('resultCode', $data)) {
			$this->status_code = $data['resultCode'];
			// check respose code
			switch ($this->status_code) {
				// response success
				case '0':
					// check subscribe status
					switch ($operationId) {
						// New player
						case 'SN':
							$subscriber = Subscriber::where('player_id', $player->id)->first();
                            $this->link = 'http://taptubemm.com/welcome';
							if (empty($subscriber)) {	
								subscriber_creation($player->id, $this->tranid, 0);
                                subscriber_log($player->id, 'SUBSCRIBED', $channel_id);
                                $this->callbacklog($player->id, 'SUBSCRIBED');
							} else {
								renewal($subscriber->id, $this->tranid, 0);
                                subscriber_log($player->id, 'RENEWAL', $channel_id);
                                $this->callbacklog($player->id, 'RENEWAL');
							}
							$response['status'] = 200;
							return $response;
							break;
						// End new player

						// Returning player
                        case 'PN':
                            $subscriber = Subscriber::where('player_id', $player->id)->first();
                            $this->link = 'http://taptubemm.com/welcome';
                            if (empty($subscriber)) {   
                                subscriber_creation($player->id, $this->tranid, 0);
                                subscriber_log($player->id, 'SUBSCRIBED', $channel_id);
                                $this->callbacklog($player->id, 'SUBSCRIBED');
                            } else {
                                renewal($subscriber->id, $this->tranid, 0);
                                subscriber_log($player->id, 'RENEWAL', $channel_id);
                                $this->callbacklog($player->id, 'RENEWAL');
                            }
                            // renewal($subscriber->id, $this->tranid, 0);
                            // subscriber_log($player->id, 'RENEWAL', $channel_id);
                            $this->callbacklog($player->id, 'RENEWAL');
                            $response['status'] = 200;
                            return $response;
                            break;
                        // End returning player

                       	// Unsubscribe case
                        case 'ACI':
                        case 'PCI':
                        case 'SCI':
                        case 'YS':
                        case 'PD':
                        case 'RD':
                        // case 'SP':
                            $this->link = 'http://taptubemm.com/unsubscribe_success';
                            $subscriber = Subscriber::where('player_id', $player->id)->first();

                            unsubscribe($subscriber->id);
                            subscriber_log($player->id, 'UNSUBSCRIBED', $channel_id);
                            $this->callbacklog($player->id, 'UNSUBSCRIBED');
                            Session::forget('msisdn');
                            Session::forget('player_id');
                            Session::forget('error_code');
                            Session::forget('operationId');
                            $response['status'] = 200;
                            return $response;
                            break;
                        //End unsubscribe case

                        // Renewal success
                        case 'YR':
                        case 'YF':
                        case 'RR':
                        case 'RF':
                            $this->link = 'http://taptubemm.com/welcome';
                            $subscriber = Subscriber::where('player_id', $player->id)->first();
                            renewal($subscriber->id, $this->tranid, 0);
                            subscriber_log($player->id, 'RENEWAL', $channel_id);
                            $this->callbacklog($player->id, 'RENEWAL');
                            $response['status'] = 200;
                            return $response;
                            break;
                        // End Renewal success

					}
					break;

                // User have already subscribe
				case '2084':
					$this->link = 'http://taptubemm.com/welcome';
                    $subscriber = Subscriber::where('player_id', $player->id)->first();
                    if (!$subscriber) {
                        subscriber_creation($player->id, $this->tranid, 0);
                        subscriber_log($player->id, 'SUBSCRIBED', $channel_id);
                    } else {
                        renewal($subscriber->id, $this->tranid, 0);
                        subscriber_log($player->id, 'RENEWAL', $channel_id);
                    }
					$this->callbacklog($player->id, 'ALREADY SUBSCRIBED');
					$response['status'] = 200;
					return $response;
					break;

				// Insufficient balance
				case '2032':
					switch ($operationId) {
						// Unsubscribe case (Remove 'YS')
                        case 'ACI':
                        case 'PCI':
                        case 'SCI':
                        case 'PD':
                        case 'RD':
                            $this->link = 'http://taptubemm.com/unsubscribe_success';
                            $subscriber = Subscriber::where('player_id', $player->id)->first();
                            unsubscribe($subscriber->id);
                            subscriber_log($player->id, 'UNSUBSCRIBED', $channel_id);
                            $this->callbacklog($player->id, 'UNSUBSCRIBED');
                            Session::forget('msisdn');
                            Session::forget('player_id');
                            Session::forget('error_code');
                            Session::forget('operationId');
                            $response['status'] = 200;
                            return $response;
                            break;
                        //End unsubscribe case
                    }

                    $this->link = 'http://taptubemm.com/welcome';
                    $subscriber = Subscriber::where('player_id', $player->id)->first();
                    if (!$subscriber) {
                        subscriber_creation($player->id, $this->tranid, 1);
                        subscriber_log($player->id, 'SUBSCRIBED', $channel_id);
                    } else {
                        renewal($subscriber->id, $this->tranid, 1);
                        subscriber_log($player->id, 'RENEWAL', $channel_id);
                    }
                    $this->callbacklog($player->id, 'INSUFFICIENT BALANCE');
                    $response['status'] = 200;
                    return $response;
					break;

				// Msisdn is in black list
				case '4105':
					$this->link = 'http://taptubemm.com/blacklist';
                    $this->callbacklog($player->id, 'BLACK LIST');
                    $response['status'] = 200;
                    return $response;
					break;
				
				default:
					# code...
					break;
			}
		}
	}

	private function callbacklog($player_id, $action) {
        $date = $date = date('Y-m-d H:i:s');
        DB::table('callback_log')
            ->insert([
                'player_id' => $player_id,
                'reqBody' => $this->reqBody,
                'resBody' => '200',
                'status_code' => $this->status_code,
                'tranid' => $this->tranid,
                'message' => $this->message,
                'action' => $action,
                'link' => $this->link,
                'created_at' => $date,
                'updated_at' => $date
            ]);
    }

  	public function notify(Request $request)
   	{
   		/*$notify = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   		\Log::info($notify);*/
   		$notify = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   		$data = $request->all();
   		return view('frontend.landing.loading', compact('data'));
   	}

   	public function checkStatus(Request $request)
    {
        $data = $request->all();
        $msisdn = '95'.$data['msisdn'];
        $player = Player::where('msisdn', $msisdn)->first();
        $subscriber = Subscriber::where('player_id', $player->id)->first();
        Session::put('msisdn', $msisdn);
        Session::put('player_id', $player->id);

        if($subscriber != null) {
            if (TRUE == $subscriber->is_not_enough) {
                Session::put('insufficient', TRUE);
                $response['url'] = url('/landing');
            }
        }
        
        $result = check_callback($player->id, $data['tranid']);
        if ($result) {
            Session::put('operationId', 'true');
            if ("SUBSCRIBED" == $result->action || "RENEWAL" == $result->action) {
                
                // ARMOR POSTBACK
                if (Session::get('kp')) {
                    armor_cpa_postback($player->id, null, Session::get('kp'));
                }
                
                if (Session::get('premiumkp')) {
                    armor_cpa_postback($player->id, 'PREMIUM', Session::get('premiumkp'));
                }

                // MOBI PIUM POSTBACK
                if (Session::get('clickid')) {
                    mobipium_cpa_postback($player->id);
                }

                // Witskies
                if (Session::get('txid')) {
                    witskies_cpa_postback($player->id);
                }

                // Koncept
                if (Session::get('tid')) {
                    koncept_cpa_postback($player->id);
                }
                
                /*
                // DIGITFOX POSTBACK
                if (Session::get('subid')) {
                    digifox_cpa_postback($player->id);
                }
                if (Session::get('skmobi')) {
                    skmobi_cpa_postback($player->id);
                }
                */
            }

            $response['url'] = $result->link;

        } else {
            $response['url'] = url('/');   
        }
        return json_encode($response);
    }

}
