<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{

    public function uploadFile(Request $request){
        if ($request->ajax()) {
            if ($request->hasFile('file')) {
                $imageFiles = $request->file('file');
                $lang = $request->request->get('lang_code');
                // set destination path
                $folderDir = 'uploads/'.date('Ymd');
                $destinationPath = public_path() . '/' . $folderDir;
                // this form uploads multiple files
                $destinationFileName = time() . $imageFiles->getClientOriginalName();
                // move the file from tmp to the destination path
                $imageFiles->move($destinationPath, $destinationFileName);
                // save the the destination filename
                $media = new Media();
                $media->file_url = $folderDir . $destinationFileName;
                $media->lang = $lang;
                $media->date = new \MongoDB\BSON\UTCDateTime();
                $media->save();

            }
        }
    }
}
