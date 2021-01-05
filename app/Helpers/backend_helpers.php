<?php
use Illuminate\Http\Request;
use App\Model\Media;

function saveSingleMedia(Request $request, $upload_type)
{
    $media_paths = json_decode(MEDIA_PATH, true);
    $media_types = json_decode(MEDIA_TYPE, true);
    $mediaField = $media_types[$upload_type];
    $upload_path = $media_paths[$request->media_path] . "/" . date("Y") . "/" . date("m") . "/";
    if (!is_dir($upload_path)) {
        mkdir($upload_path, 0775, true);
        file_put_contents($upload_path . "/index.html", "");
    }

    $file = $request->file($mediaField['field_name']);
    $time = substr(number_format(time() * mt_rand(), 0, '', ''), 0, 10);
    $data = array(
        'file_name' => $time . "." . $file->getClientOriginalExtension(),
        'file_path' => $upload_path,
        'file_type' => $file->getClientOriginalExtension(),
        'file_size' => $file->getClientSize(),
        'file_caption' => $file->getClientOriginalName()
    );
    $result = saveUploadMedia($file, $data, $mediaField);
    if ($result['status'] == TRUE) {
        $result['media_id'] = Media::insertGetId($data);
    }
    return $result;
}


function saveUploadMedia($file, $data, $mediaField)
{
    $target_file = $data['file_path'] . $data['file_name'];
    $uploadOk = 1;
    $file->move($data['file_path'], $data['file_name']);
    if (file_exists($target_file)) {
        $result['status'] = TRUE;
        $result['message'] = "The file " . $data['file_caption'] . " has been uploaded.";
        return $result;
    } else {
        $result['status'] = FALSE;
        $result['message'] = "Sorry, there was an error uploading your file.";
        return $result;
    }
}

function saveVideo(Request $request, $upload_type)
{
    $media_paths = json_decode(MEDIA_PATH, true);
    $media_types = json_decode(MEDIA_TYPE, true);
    $mediaField = $media_types[$upload_type];

    $upload_path = $media_paths[$request->media_path] . "/" . date("Y") . "/" . date("m") . "/";
    if (!is_dir($upload_path)) {
        mkdir($upload_path, 0775, true);
        file_put_contents($upload_path . "/index.html", "");
    }

    $file = $request->file($mediaField['field_name']);
    $time = substr(number_format(time() * mt_rand(), 0, '', ''), 0, 10);
    $data = array(
        'file_name' => $time . "." . $file->getClientOriginalExtension(),
        'file_path' => $upload_path,
        'file_type' => $file->getClientOriginalExtension(),
        'file_size' => $file->getClientSize(),
        'file_caption' => $file->getClientOriginalName()
    );
    $result = saveUploadVideo($file, $data, $mediaField);
    if ($result['status'] == TRUE) {
        return array('status' => TRUE, 'file_path' => $data['file_path']."/".$data['file_name']);
    } else {
        return array('status' => FALSE, 'message' => $result['message']);
    }
    return $result;
}


function saveUploadVideo($file, $data, $mediaField)
{
    $target_file = $data['file_path'] . $data['file_name'];
    $uploadOk = 1;
    // Plupload::file($mediaField['field_name'] , function($media_file) use ($data, $file) {
        // $file->move($data['file_path'], $data['file_name']);
    // });
    $file->move($data['file_path'], $data['file_name']);   
    if (file_exists($target_file)) {
        $result['status'] = TRUE;
        $result['message'] = "The file " . $data['file_caption'] . " has been uploaded.";
    } else {
        $result['status'] = FALSE;
        $result['message'] = "Sorry, there was an error uploading your file.";
    }
    return $result;
}




