<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlannedTv extends Model
{
    protected $table = 'planned_tv';

    protected $fillable = [
        'user_id', 'tv_id'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
