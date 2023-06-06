<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
    protected $table = 'Gallery';

    protected $fillable = [
        'id','product_id','images','name'
    ];
    function Product(){
        return $this->belongsTo('App\Product', 'id');
    }
}
