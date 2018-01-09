<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlannedMovie extends Model
{
    protected $table = 'planned_movies';

    protected $fillable = [
        'user_id', 'movie_id'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
