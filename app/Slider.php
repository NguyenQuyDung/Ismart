<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //
    protected $table = 'sliders';

    protected $fillable = [
        'status','user_id','user_create','images_slider','name_slider','name_slug'
    ];
}
