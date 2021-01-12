<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Video;

class VideoController extends Controller
{
    public function getVideo($category_id){
    	$data = Video::where('id', $category_id)->first();
    	if($data){
			return response()->json([
		    'message' => 'Success', 'data' => $data]);
    	}
		return response()->json([
	    'message' => 'Not Found']);
    }
}
