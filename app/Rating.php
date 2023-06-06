<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $table = 'rating';

    protected $fillable = [
        'id', 'product_id', 'rating'
    ];
    public function Product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
