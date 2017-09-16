<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;


class Project extends Model
{
    //TODO Mod format Date
    public function getCreatedAtAttribute($date){
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
    }
}
