<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    //
    protected $table = 'Wards';

    protected $fillable = [
      'wards_id', 'district_id','name'
    ];
}
