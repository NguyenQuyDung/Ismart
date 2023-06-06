<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comment';
    protected $fillable = [
        'comment_parent_comment','id','comment','comment_status','comment_name','comment_product_id'
    ];
    public function Product()
    {
        return $this->belongsTo('App\Product', 'comment_product_id');
    }
}
