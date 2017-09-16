<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    //TODO specificate that this attributes are Dates
    protected $dates = ['created_at'];
    //TODO specificate attributes take of method (this case => getFormattedLibrariesAttribute OR getFormattedCreatedAttribute)
    protected $appends = ['formatted_libraries', 'formatted_created'];

    public function author(){
        //TODO examplete: Book can has one Aithor (One to One)
        return $this->belongsTo('App\Author');
    }

    public function libraries(){
        //TODO examplete: Books can has associations to many Librearies (Many to Many)
        return $this->belongsToMany('App\Library');
    }

    //TODO require prefix = get & subfix Attribute
    public function getFormattedCreatedAttribute(){
        return $this->created_at->format('d/m/Y');
    }

    public function getFormattedLibrariesAttribute(){
        if($this->libraries->count()){
            $list = [];

            foreach($this->libraries AS $library){
                array_push($list, $library->name);
            }

            return implode(', ', $list);
        }

        return '';
    }
}
