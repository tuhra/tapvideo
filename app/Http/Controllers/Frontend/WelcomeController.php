<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Vimeo\Laravel\Facades\Vimeo;
use App\Model\Video;
use App\Model\Slider;
use App\Favourite;

class WelcomeController extends Controller
{
    public function index() {
        return redirect('admin/login');
    }
}
