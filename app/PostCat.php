<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCat extends Model
{
    //
    protected $table = 'postcats';
    protected $fillable = [
        'name', 'slug', 'parent_id', 'user_id', 'user_create'
    ];
    // lấy tất cả bài viet do user poossts tạo ra
     function posts()
    {
        return $this->hasMany('App\Post');
    }
}
