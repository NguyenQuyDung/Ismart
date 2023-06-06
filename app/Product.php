<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use softDeletes;
    protected $table = 'products';
    public function Product_cat()
    {
        return $this->belongsTo('App\Product_cat', 'cat_id');
    }
    public function Gallery()
    {
        return $this->hasMany('App\Gallery');
    }
    public function Comment()
    {
        return $this->hasMany('App\Comment');
    }
    public function Rating()
    {
        return $this->hasMany('App\Rating');
    }
    protected $fillable = [
        'name', 'intro', 'detail', 'price', 'price_old', 'status', 'user_id', 'user_create', 'detail', 'parent_id', 'images_product', 'cat_id'
    ];
}
