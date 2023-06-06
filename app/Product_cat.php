<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_cat extends Model
{
    //
    protected $table = 'product_cats';
    protected $fillable = [
        'name', 'slug', 'parent_id', 'user_id', 'user_create'
    ];
    // lấy tất cả bài viet do user products tạo ra
    function products()
    {
        return $this->hasMany('App\Product');
    }
}
