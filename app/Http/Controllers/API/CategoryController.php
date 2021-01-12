<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use DB;
class CategoryController extends Controller
{
    //
    public function categories() {
    	$categories = Category::all();
    	return response()->json($categories);
    }
}
