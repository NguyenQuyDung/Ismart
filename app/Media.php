<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    protected $table = 'media';

    protected $fillable = [
        'status','user_id','user_create','name_media','images_media','name_slug'
    ];
}
