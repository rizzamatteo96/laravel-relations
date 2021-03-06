<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category_id'
    ];

    public function postCategory(){
        return $this->belongsTo('App\Category','category_id','id');
    }
}
