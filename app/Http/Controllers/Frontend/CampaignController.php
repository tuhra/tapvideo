<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class CampaignController extends Controller
{
    public function getCampaign(Request $request)
    {
        Session::forget('kp');
        Session::forget('premiumkp');
        Session::forget('txid');
        Session::forget('clickid');
    	$data = $request->all();
        // Koncept
        if(array_key_exists('tid', $data))
        {
            create_koncept_cpc($data);
            Session::put('tid', $data['tid']);
        }

        // Armor
    	if(array_key_exists('kp', $data))
        {
            create_armor_cpc($data['kp'], NULL);
            Session::put('kp', $data['kp']);
            Session::put('source', $data['source']);
        }

        if(array_key_exists('premiumkp', $data))
        {
            create_armor_cpc($data['premiumkp'], 'PREMIUM');
            Session::put('premiumkp', $data['premiumkp']);
            Session::put('source', $data['source']);
        }

        // Witskies
        if(array_key_exists('txid', $data))
        {
            witskies_cpc_creation($data);
            Session::put('txid', $data['txid']);
        }

        // Mobipium
        if(array_key_exists('clickid', $data))
        {
            mobipium_cpc_creation($data);
            Session::put('clickid', $data['clickid']);
        }
    	return view('frontend.campaign-landing');
    }

    public function getcgRequest()
    {
    	$tranid = getUUID();

        if (Session::get('kp')) {
            $agency = 'armor';
        }

        if (Session::get('clickid')) {
            $agency = 'mobipium';
        }

        if (Session::get('subid')) {
            $agency = 'digifox';   
        }

        if (Session::get('skmobi')) {
            $agency = 'skmobi';   
        }

        // cg_request_creation($agency, $tranid);
    	$url = 'http://macnt.mpt.com.mm/API/CGRequest?CpId=TAP&productID=10500&pName=Taptube&pPrice=99&pVal=1&CpPwd=tap@123&CpName=TAP&reqMode=WAP&reqType=SUBSCRIPTION&ismID=17&transID='. $tranid .'&sRenewalPrice=99&sRenewalValidity=1&request_locale=my&serviceType=T_TAP_WAP_SUB_D&planId=T_TAP_WAP_SUB_D_99' ;
    	return redirect($url);
    }
}
