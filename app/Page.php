<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Page extends Model
{
    //
    use softDeletes;
    protected $table = 'pages';

    protected $fillable = [
        'name', 'content', 'status', 'user_id', 'user_create'
    ];
}
