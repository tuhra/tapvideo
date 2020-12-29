<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vimeo\Laravel\Facades\Vimeo;
use App\Http\Middleware\InsufficientMiddleware;
use Session;
use App\Subscriber;
use App\Favourite;
use App\Model\Video;
use App\Model\Download;
use Redirect;

class VimeoController extends Controller
{
    public function __construct()
    {
        $this->middleware(InsufficientMiddleware::class);
    }

    public function category()
    {
        $validation = ["disable", "nobody"];
        $vdos = json_decode(file_get_contents(storage_path('app/vdos.json')), TRUE);
        $vdos = json_decode($vdos, TRUE);
        return view('frontend.category', compact('vdos', 'validation'));

    }

    public function specific_category($cat_id)
    {   
        $validation = ["disable", "nobody"];
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $vdos = Vimeo::request('/users/68253613/projects/'.$cat_id.'/videos', ['per_page' => 36, 'page' => $page], 'GET');
        } else {
            $vdos = Vimeo::request('/users/68253613/projects/'.$cat_id.'/videos', ['per_page' => 36], 'GET');
        }
        if($vdos['status'] == 200) {
            return view('frontend.specific_category', compact('vdos', 'cat_id', 'validation'));
        } else {
            return abort(404);
        }
    }

    public function video_detail($id, Request $request)
    {
        $vdo = Vimeo::request('/videos/'.$id.'?password=tapinnovation@2020', [], 'GET');
        if (array_key_exists('error', $vdo['body'])) {
            return redirect('/?myid_auth_password=taptubemyid@tech2020');
        }

        $favourite_vdo = Favourite::where('video_id', $id)->first();
        // Download
        $download = Download::where('video_id', $id)->first();
        return view('frontend.video_detail', compact('vdo', 'favourite_vdo', 'id', 'download'));
    }

    public function postFavourite(Request $request)
    {
        return setFavourite($request->all());
    }

    public function favourite()
    {
        $favourite_vdos = Favourite::orderby('count' , 'DESC')->get();
        return view('frontend.favourite', compact('favourite_vdos'));
    }

    public function deleteFavourite($id)
    {
        $msisdn = Session::get('msisdn');
        $player = Player::where('msisdn', $msisdn)->first();
        $subscriber = Subscriber::where('player_id', $player->id)->first();
        $favourite = Favourite::where([
                            ['subscriber_id', '=', $subscriber->id],
                            ['video_id', '=', $id],
                        ])->first();
        $favourite->delete();
        return redirect(route('frontend.favourite'));
    }

    public function search($keyword)
    {
        $validation = ["disable", "nobody"];
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $vdos = Vimeo::request('/users/68253613/videos', ['per_page' => 36, 'query' => $keyword, 'page' => $page], 'GET');
        } else {
            $vdos = Vimeo::request('/users/68253613/videos', ['per_page' => 36, 'query' => $keyword], 'GET');
        }
        if(0 == $vdos['body']['total']) {
            $vdos = Video::where('name', 'like', '%' . $keyword . '%')->get();
            return view('frontend.myanmar_result', compact('vdos', 'keyword', 'validation'));
        }

        if($vdos['status'] == 200) {
            return view('frontend.search_result', compact('vdos', 'keyword', 'validation'));
        } else {
            return abort(404);
        }
    }


    public function downloadVideo($video_id, Request $request) {
        $download = Download::where('video_id', $video_id)->first();
        if (empty($download)) {
            return redirect()->back();
        }
        return view('frontend.downloadtuto', compact('download'));
        // $data = $request->all();
        // shell_exec('curl -O '. $data['url']);
    }

    public function downloadGuide($video_id){
        $download = Download::where('video_id', $video_id)->first();
        return view('frontend.download_guide', compact('download'));
    }

}
