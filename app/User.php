<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Repositories\ManagesMoviesAndTvTrait as ManagesMAT;

class User extends Authenticatable
{
    use Notifiable, ManagesMAT;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function plannedMovies()
    {
        return $this->hasMany('App\PlannedMovie');
    }

    public function seenMovies()
    {
        return $this->hasMany('App\SeenMovie');
    }

    public function plannedTvs()
    {
        return $this->hasMany('App\PlannedTv');
    }

    public function seenTvs()
    {
        return $this->hasMany('App\SeenTv');
    }
}
