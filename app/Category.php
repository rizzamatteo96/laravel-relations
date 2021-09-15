<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function categoryPost(){
        return $this->belongsTo('App\Post');
    }
}
