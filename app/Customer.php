<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'customers';

    protected $fillable = [
       'province', 'district','ward','fullname','name','name_order','qty','sub_total', 'phone','subtotal', 'address', 'customer_id', 'email', 'note', 'status', 'payment_method', 'MaKH', 'disabler'
    ];
    function Order()
    {
        return $this->hasMany('App\Order');
    }
}
