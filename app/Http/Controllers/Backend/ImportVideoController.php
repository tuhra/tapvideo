<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use Flash;
use App\Model\Video;

class ImportVideoController extends Controller
{
    public function index() {
    	return view('admin.video.import');
    }

    public function store(Request $request) {
        $data = $request->all();
    	if ($request->hasFile('file'))  {
			$file = $request->file('file');
			$filename = time().$file->getClientOriginalName();
    		$file->move('upload/excel', $filename);
    		$rows = Excel::load(public_path('/upload/excel') . '/' . $filename)->get();
            $file_path = public_path('/upload/excel') . '/' . $filename;
    		$insert = [];
            foreach ($rows as $key => $row) {
                $insert[] = [
                    'name' => $row->name,
                    'category_id' => $row->category_id,
                    'url' => $row->url
                ];    
            }
			Video::insert($insert);
			Flash::success('Success', 'Successfully imported Videos');
			return redirect('admin/video');
    	}
    }
}
