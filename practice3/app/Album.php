<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use SoftDeletes;

    //TODO specificate that this attributes are Dates
    protected $dates = ['created_at'];
    //TODO specificate attributes take of method
    protected $appends = ['formatted_pictures_count', 'formatted_created'];

    public function pictures(){
        //TODO examplete: Album can contain many Pcitures (One to Many)
        return $this->hasMany('App\Picture');
    }

    //TODO require prefix = get & subfix Attribute
    public function getFormattedCreatedAttribute(){
        return $this->created_at->format('d/m/Y');
    }

    public function getFormattedPicturesCountAttribute(){
        return $this->pictures->count();
    }
}
