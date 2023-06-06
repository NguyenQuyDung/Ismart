<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'orders';

    protected $fillable = [
        'masp', 'thumbnail','sub_total', 'name', 'price', 'qty', 'color', 'subtotal', 'payment', 'status', 'customer_id', 'MaKH', 'disabler'
    ];
    function Customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
