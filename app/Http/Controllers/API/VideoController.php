<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Video;

class VideoController extends Controller
{
    public function getVideo($category_id){
    	$video = Video::where('category_id', $category_id)->get();
    	if($video){
			return response()->json([
		    'message' => 'Success', 'data' => $video]);
    	}
		return response()->json([
	    'message' => 'Not Found']);
    }
}
