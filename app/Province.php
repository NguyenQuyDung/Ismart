<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    protected $table = 'province';

    protected $fillable = [
        'province_id','name'
    ];
}
