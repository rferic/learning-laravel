<?php

namespace App\Http\Controllers;

use App\Picture;
use Illuminate\Http\Request;

class PicturesController extends Controller
{
	public function upload(Request $request)
	{
		$album_id = $request->input('album_id');
		$file = $request->file('file');
		$fileId = $request->input('file_id');
		$extension = $file->getClientOriginalExtension();
		$originalName = $file->getClientOriginalName();
		$fileSize = $file->getClientSize();
		$mimeType = $file->getClientMimeType();
		$section = $request->input('section');
		$fileIdWithExtension = sprintf('%s.%s', $fileId, $extension);

		switch ($mimeType)
		{
			case "image/jpeg":
			case "image/png":
			case "image/jpg":
				if($file->isValid())
				{
					$file->move('pictures', $fileIdWithExtension);

					$picture = new Picture();
					$picture->album_id = $album_id;
					$picture->filename = $fileIdWithExtension;
					$picture->file_section = $section;
					$picture->mime_type = $mimeType;
					$picture->file_id = $fileId;
					$picture->original_name = $originalName;
					$picture->file_size = $fileSize;
					$picture->extension = $extension;

					if($picture->save())
					{
						$picture->delete();//borrado lógico
						return response()->json(['res' => 'upload_success']);
					}
				}
				break;
			default:
				return response()->json(['res' => 'extensión no permitida'], 401);
		}
	}

	public function remove(Request $request)
	{
		$fileId = $request->input('fileId');
		$picture = Picture::withTrashed()->where('file_id', $fileId)->first();
		if( ! $picture )
		{
			return response()->json(['res' => 'file not exists'], 200);
		}
		$fileIdWithExtension = $picture->filename;
		\File::delete(sprintf('%s/%s', 'pictures', $fileIdWithExtension));
		$picture->forceDelete();
		return response()->json(['res' => 'file removed'], 200);
	}
}
