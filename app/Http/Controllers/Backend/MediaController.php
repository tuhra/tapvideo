<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Media;
use File;
use Redirect;
use Artisan;
use Flash;

class MediaController extends Controller
{
    public function destroy($id) {
    	$media = Media::find($id);
    	File::delete($media->file_path . $media->file_name);
    	Media::find($media->id)->delete();
    	return Redirect::back();
    }
}
