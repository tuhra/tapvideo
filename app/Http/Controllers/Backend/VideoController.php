<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Video;
use Flash;
use App\Http\Requests\VideoRequest;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $videos = Video::orderBy('id', 'DESC')->paginate(25);
        if($request->all()) {
            $data = $request->all();
            $videos = Video::where('name', 'like', $data['name'])->paginate(25);
        }

        return view('admin.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = Category::all();
        return view('admin.video.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image_media')) {
            $media = saveSingleMedia($request, 'image');
            if (TRUE != $media['status']) {
                Flash::error($media['message']);
                return redirect(route('video.index'));
            }
            $data['media_id'] = $media['media_id'];
        }

        Video::create($data);
        Flash::success('Successfully created video');
        return redirect(route('video.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$categories = Category::all();
        $video = Video::find($id);
        if (empty($video)) {
            Flash::error('video not found!');
            return redirect(route('video.index'));
        }
        return view('admin.video.edit', compact('video','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VideoRequest $request, $id)
    {
        $video = Video::find($id);
        if (empty($video)) {
            Flash::error('video not found!');
            return redirect(route('video.index'));
        }

        $data = $request->all();
        if ($request->hasFile('image_media')) {
            $media = saveSingleMedia($request, 'image');
            if (TRUE != $media['status']) {
                Flash::error($media['message']);
                return redirect(route('video.index'));
            }
            $data['media_id'] = $media['media_id'];
        }

        Video::find($id)->update($data);
        Flash::success('Successfully update video');
        return redirect(route('video.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Video::find($id)->delete();
        Flash::success('Successfully delete video');
        return redirect(route('video.index'));
    }
}
