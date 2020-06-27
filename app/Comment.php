<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'body',
    ];

    public function boardlist()
    {
        return $this->belongsTo('App\BoardList', 'post_id', 'post_number');
    }
}
