<?php

namespace App\Http\Controllers\Frontend;
use App\Model\amor_cpc;
use App\Model\amor_cpa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Flash;
use App\Model\ArmorCPC;
use DB;
use App\Model\DigifoxCPC;
use App\Model\DigifoxCPA;

class DigiController extends Controller
{
    // Armor
    public function getKp(Request $request)
    {
    	$data = $request->all();
    	if(array_key_exists('kp', $data)){
            create_armor_cpc($data);
            Session::put('kp',$data['kp']); 
    	}
    	return redirect('/');
    }

    // Digifox
    public function getDigifox(Request $request)
    {
    	$data = $request->all();
    	if(array_key_exists('subid', $data)) 
    	{
    		digifox_cpc_creation($data);
    		Session::put('subid', $data['subid']);
    	}
    	return redirect('/');
    }

    // Motomedia
    public function campaign(Request $request)
    {
        $data = $request->all();
        if(array_key_exists('skmobi', $data))
        {
            create_skmobi_cpc($data);
            Session::put('skmobi', $data['skmobi']);
        }
        return redirect('/');
    }
}

