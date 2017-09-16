<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Album;
use App\Picture;

use Yajra\Datatables\Facades\Datatables;

class AlbumsController extends Controller
{
    public $folder = 'pictures';

    public function index(){
        return view('albums.list');
    }

    //TODO method for use Datatables
    public function albumsData(){
        //TODO get Model with dependencies and including items has been logic removed
        $model = Album::with('pictures')->whereNotNull('name');
        //TODO specificate view for call action
        $actions = 'albums.datatables.actions';
        //TODO create a Datatables
        //TODO eloquetn => for specificate that working with a model (ORM)
        //TODO addColumn => add column with print view specificate
        return Datatables::eloquent($model)->addColumn('actions', $actions)->make(true);
    }

    public function create(Request $request){
        $createTemp = true;
        $path = $this->folder;

        //TODO Verificate on session exist (temporal or ral)
        if($request->session()->has('temp_album')){
            //TODO if exist is editable
            $album_id = $request->session()->get('temp_album');
            $album = Album::onlyTrashed()->where('id', $album_id)->first();
            $album->pictures = Picture::withTrashed()->where('album_id', $album->id)->get();
            $createTemp = is_null($album);
        }

        if($createTemp){
            $album = $this->createTemp($request);
        }

        return view('albums.create_update', compact('album', 'path'));
    }

    public function store(Request $request){
        //TODO Verificate on session temporal album exist
        if($request->session()->has('temp_album')){
            //TODO Save instance and stop being temporary
            $album_id = $request->session()->get('temp_album');
            $album = Album::withTrashed()->find($album_id);
            $album->name = $request->input('name');
            $album->save();

            //TODO Get Images with logic remove
            //TODO When upload image applicate a logic remove for prevent errors
            //TODO Before of upload images, restore images if all proccess has been succeffuly (now)
            //TODO Ideally schedule a daily cron for yesterday's remove images and it has logic remove
            $pictures = Picture::onlyTrashed()->where('album_id', $album_id)->get();

            if($pictures){
                foreach($pictures AS $picture){
                    //TODO Restore image => return exist => Logic Remove = NULL
                    $picture->restore();
                }
            }

            $album->restore();

            return redirect('albums/edit/' . $album_id)->with('message', 'Album has been created');
        }

        //TODO Return if not found temporal album (ERROR)
        return redirect('albums/create')->with('message', 'Album not found');
    }

    public function edit($id){
        $path = $this->folder;
        $album = Album::with('pictures')->find($id);
		$editable = true;
		return view('albums.create_update', compact('album', 'editable', 'path'));
    }

    public function update(Request $request, $id){
		$album = Album::find($id);
		$album->name = $request->input('name');
		$album->save();

		$pictures = Picture::onlyTrashed()->where('album_id', $id)->get();

		if($pictures){
			foreach ($pictures as $picture){
				$picture->restore();
			}
		}

		return redirect('albums/edit/' . $id)->with('message', 'Album has been updated');
	}

    public function remove(Request $request, $id){
        $album = Album::findOrFail($id);
        $pictures = Picture::where('album_id', $id)->get();

        foreach($pictures AS $picture){
            $picture->delete();
        }

        $album->delete();

        return redirect('albums/create/')->with('message', 'Album has been removed');
    }

    /**
     * [createTemp description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    private function createTemp($request){
        //TODO Create a Instance
        $album = new Album();
        //TODO Save instance (temporal)
        $album->save();
        $album->remove();

        $album_id = $album->id;

        //TODO Clear Session
        $request->session()->forget('temp_album');
        $request->session()->flush();
        //TODO Create a param session (temporal)
        $request->session()->put('temp_album', $album_id);
        //TODO Save param session (temporal)
        $request->session()->save();

        return $album;
    }
}
