<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'board_title',
        'board_password',
        'min_number',
        'max_number',
        'user_id',
        'sharejudge',
        'about'
    ];

    public function boardlist()
    {
        return $this->hasMany('App\BoardList', 'board_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
