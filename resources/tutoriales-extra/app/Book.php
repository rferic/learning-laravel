<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at'];

	protected $appends = ['formatted_libraries', 'formatted_created'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function author()
	{
		return $this->belongsTo('App\Author');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function libraries()
	{
		return $this->belongsToMany('App\Library');
	}

	public function getFormattedCreatedAttribute()
	{
		return $this->created_at->format('d/m/Y');
	}

	public function getFormattedLibrariesAttribute()
	{
		if($this->libraries->count())
		{
			$data = [];
			foreach($this->libraries as $library)
			{
				array_push($data, $library->name);
			}
			return implode(', ', $data);
		}
		return '';
	}
}
