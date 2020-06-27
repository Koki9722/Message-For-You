<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardList extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'board_id',
        'id',
        'board_text',
        'nickname'
    ];

    public function comment()
    {
        return $this->hasOne('App\Comment', 'post_id', 'post_number');
    }

    public function post()
    {
        return $this->belongsTo('App\Post', 'board_id', 'id');
    }

}
