<?php

namespace App\Repositories;

use Auth;
use App\PlannedMovie;
use App\SeenMovie;
use App\PlannedTv;
use App\SeenTv;

trait ManagesMoviesAndTvTrait 
{
	public function togglePlannedMovie($id)
	{
		$planned = PlannedMovie::where('user_id', '=', Auth::user()->id)
		->where('movie_id', '=', $id)
		->first();

		if ($planned) 
		{
			$planned->delete();
		}
		else 
		{
			PlannedMovie::create([
				'user_id' => Auth::user()->id,
				'movie_id' => $id
			]);
		}
	}

	public function toggleSeenMovie($id)
	{
		$seen = SeenMovie::where('user_id', '=', Auth::user()->id)
		->where('movie_id', '=', $id)
		->first();

		if ($seen) 
		{
			$seen->delete();
		}
		else 
		{
			SeenMovie::create([
				'user_id' => Auth::user()->id,
				'movie_id' => $id
			]);
		}
	}

	public function togglePlannedTv($id)
	{
		$planned = PlannedTv::where('user_id', '=', Auth::user()->id)
		->where('tv_id', '=', $id)
		->first();

		if ($planned) 
		{
			$planned->delete();
		}
		else 
		{
			PlannedTv::create([
				'user_id' => Auth::user()->id,
				'tv_id' => $id
			]);
		}
	}

	public function toggleSeenTv($tv_id, $episode_id)
	{
		$seen = SeenTv::where('user_id', '=', Auth::user()->id)
		->where('tv_id', '=', $tv_id)
		->where('episode_id', '=', $episode_id)
		->first();

		if ($seen) 
		{
			$seen->delete();
		}
		else 
		{
			SeenTv::create([
				'user_id' => Auth::user()->id,
				'tv_id' => $tv_id,
				'episode_id' => $episode_id
			]);
		}
	}
}