<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeenTv extends Model
{
    protected $table = 'seen_tv';

    protected $fillable = [
        'user_id', 'tv_id', 'episode_id'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
