<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    //lấy danh mcuj tạo ra bài viet
    protected $table = 'posts';
    function PostCat(){
        return $this->belongsTo('App\PostCat','cat_id');
    }
    protected $fillable = [
        'name', 'content', 'status','user_id', 'user_create', 'detail', 'parent_id', 'images', 'cat_id'
    ];
}
