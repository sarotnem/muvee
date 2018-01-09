<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeenMovie extends Model
{
    protected $table = 'seen_movies';

    protected $fillable = [
        'user_id', 'movie_id'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
