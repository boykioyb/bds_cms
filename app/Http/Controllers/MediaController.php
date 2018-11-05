<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Croppa;
use FileUpload;
use File;

class MediaController extends Controller
{
    public $folder = '/uploads/'; // add slashes for better url handling

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all pictures
        $pictures = Media::all();

        // add properties to pictures
        $pictures->map(function ($picture) {
            $picture['size'] = File::size(public_path($picture['url']));
            $picture['thumbnailUrl'] = Croppa::url($picture['url'], 80, 80, ['resize']);
            $picture['deleteType'] = 'DELETE';
            $picture['deleteUrl'] = route('medias.destroy', $picture->id);
            return $picture;
        });

        // show all pictures
        return response()->json(['files' => $pictures]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // create upload path if it does not exist
        $this->folder = $this->folder. date('Ym') . '/';
        $path = public_path($this->folder);
        if(!File::exists($path)) {
            File::makeDirectory($path);
        };
        // Simple validation (max file size 2MB and only two allowed mime types)
        $validator = new FileUpload\Validator\Simple('256M', ['image/png', 'image/jpg', 'image/jpeg']);
        // Simple path resolver, where uploads will be put
        $pathresolver = new FileUpload\PathResolver\Simple($path);
        // The machine's filesystem
        $filesystem = new FileUpload\FileSystem\Simple();
        // FileUploader itself
        $fileupload = new FileUpload\FileUpload($_FILES['files'], $_SERVER);
        $slugGenerator = new FileUpload\FileNameGenerator\Slug();
        // Adding it all together. Note that you can use multiple validators or none at all
        $fileupload->setPathResolver($pathresolver);
        $fileupload->setFileSystem($filesystem);
        $fileupload->addValidator($validator);
        $fileupload->setFileNameGenerator($slugGenerator);
        // Doing the deed
        list($files, $headers) = $fileupload->processAll();
        // Outputting it, for example like this
        foreach($headers as $header => $value) {
            header($header . ': ' . $value);
        }
        foreach($files as $file){
            //Remember to check if the upload was completed
            if ($file->completed) {
                // set some data
                $filename = $file->getFilename();
                $url = $this->folder . $filename;

                // save data
                $picture = Media::create([
                    'name' => $filename,
                    'size' => $file->size,
                    'mime' => $file->mime,
                    'file_url' => $this->folder . $filename,
                ]);
                // prepare response
                $data[] = [
                    'size' => $file->size,
                    'name' => $filename,
                    'url' => $url,
                    'thumbnailUrl' => Croppa::url($url, 80, 80, ['resize']),
                    'deleteType' => 'DELETE',
                    'deleteUrl' => route('medias.destroy', $picture->id),
                ];
                // output uploaded file response
                echo  json_encode($data);
                return;
            }
        }
        // errors, no uploaded file
        return response()->json(['files' => $files]);
    }

    /**
     * @param Media $media
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Media $media)
    {
        Croppa::delete($media->url); // delete file and thumbnail(s)
        $media->delete(); // delete db record
        return response()->json([$media->url]);
    }
}
