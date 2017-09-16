<?php

namespace App\Http\Controllers;

use App\Album;
use App\Picture;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
	public function create(Request $request)
	{
		if ($request->session()->has('temp_album'))
		{
			$album_id = $request->session()->get('temp_album');
			$album = Album::find($album_id);
		}
		else
		{
			$album = new Album();
			$album->save();
			$album_id = $album->id;
			$request->session()->put('temp_album', $album_id);
			$request->session()->save();
		}
		return view('albums.create_update', compact('album'));
	}

	public function store(Request $request)
	{
		if ($request->session()->has('temp_album'))
		{
			$album_id = $request->session()->get('temp_album');
			$album = Album::find($album_id);
			$album->name = $request->input('name');
			$album->save();

			$pictures = Picture::onlyTrashed()->where('album_id', $album_id)->get();

			if($pictures)
			{
				foreach ($pictures as $picture)
				{
					$picture->restore();
				}
			}

			$request->session()->remove('temp_album');
			$request->session()->save();

			return redirect('albums/edit/' . $album_id)->with('message', 'Albúm creado correctamente');
		}
		return redirect('albums/create')->with('message', 'El albúm no existe');
	}

	public function edit($id)
	{
		$album = Album::with('pictures')->find($id);
		$editable = true;
		return view('albums.create_update', compact('album', 'editable'));
	}

	public function update(Request $request, $id)
	{
		$album = Album::find($id);
		$album->name = $request->input('name');
		$album->save();

		$pictures = Picture::onlyTrashed()->where('album_id', $id)->get();

		if($pictures)
		{
			foreach ($pictures as $picture)
			{
				$picture->restore();
			}
		}
		return redirect('albums/edit/' . $id)->with('message', 'Albúm actualizado correctamente');
	}
}
