<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Picture;

class PicturesController extends Controller
{
    public function upload(Request $request){
        //TODO Procees upload Images
        //TODO Get file
        $path = $request->input('path');
        $file = $request->file('file');
        $fileId = uniqid();

        //TODO GEetter params file
        //TODO New name file
        $fileIdWithExtension = sprintf('%s.%s', $fileId, $file->getClientOriginalExtension());

        //TODO Extensions available
        switch ($file->getClientMimeType()) {
            case 'image/jpeg':
            case 'image/png':
            case 'image/jpg':
                if($file->isValid()){
                    //TODO move temporal file to finally file
                    $file->move($path, $fileIdWithExtension);

                    //TODO Implementin instance for save
                    $picture = new Picture();
                    $picture->album_id = $request->input('album_id');
                    $picture->filename = $fileIdWithExtension;
                    $picture->file_section = $request->input('section');
                    $picture->mime_type = $file->getClientMimeType();
                    $picture->file_id = $fileId;
                    $picture->original_name = $file->getClientOriginalName();
                    $picture->file_size = $file->getClientSize();
                    $picture->extension = $file->getClientOriginalExtension();
                    //TODO Save Instance
                    if($picture->save()){
                        //TODO When upload image applicate a logic remove for prevent errors
                        //TODO After, when save album restore this images
                        $picture->delete();
                        return response()->json(['res' => true, 'picture' => $picture->file_id], 200);
                    }
                }

                return response()->json(['res' => false, 'message' => 'File not valid'], 401);

                break;
            default:
                return response()->json(['res' => false, 'message' => 'MIME TYPE not valid'], 401);
                break;
        }

        return response()->json(['res' => false, 'message' => 'Critical ERROR'], 401);
    }

    public function remove(Request $request){
        $path = $request->input('path');
        $picture = Picture::withTrashed()->where('file_id', $request->input('file_id'))->first();

        if(!is_null($picture)){
            if(file_exists($path . '/' . $picture->filename)){
                //TODO Remove file
                \File::delete(sprintf('%s/%s', 'pictures', $picture->filename));
            }

            //TODO Force real remove without logic remove
    		$picture->forceDelete();

    		return response()->json(['res' => true], 200);
        }

        return response()->json(['res' => false, 'message' => 'File not exists'], 401);
    }
}
