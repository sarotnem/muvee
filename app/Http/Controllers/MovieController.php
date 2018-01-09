<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tmdb\Repository\MovieRepository;
use App;
use Auth;
use App\PlannedMovie;
use App\SeenMovie;

class MovieController extends Controller
{
	public function show($id)
	{
		$repository = App::make(\Tmdb\Repository\MovieRepository::class);

		$movie = $repository->load($id);

		$planned = PlannedMovie::where('user_id', '=', Auth::user()->id)
		->where('movie_id', '=', $movie->getId())
		->first();

		$seen = SeenMovie::where('user_id', '=', Auth::user()->id)
		->where('movie_id', '=', $movie->getId())
		->first();

		//Get featured cast
		$featuredCast = array();

		foreach ($movie->getCredits()->getCast() as $actor) {
			if ($actor->getOrder() > 3) {
				break;
			}
			else {
				array_push($featuredCast, $actor);
			}
		}

		//Get featured crew
		$featuredCrewTemp = array();

		foreach ($movie->getCredits()->getCrew() as $crew) {
			if ($crew->getJob() == 'Director' || $crew->getJob() == 'Writer' || $crew->getJob() == 'Story' || $crew->getJob() == 'Screenplay' || $crew->getJob() == 'Author') {
				array_push($featuredCrewTemp, $crew);
			}
		}

		$featuredCrew = array();

		foreach ($featuredCrewTemp as $key => $crew) {
			$name = $crew->getName();
			$job = $crew->getJob();

			$featuredCrew[$name][$key] = $job; 
		}

		//Get trailer youtube link
		$trailer = false;
		foreach ($movie->getVideos() as $video) {
			if ($video->getSite() == 'YouTube' && $video->getType() == 'Trailer') {
				$trailer = $video->getKey();
			}
		}

		return view('pages.movie.show', compact('movie', 'featuredCast', 'featuredCrew', 'trailer', 'planned', 'seen'));
	}

	public function cast($id)
	{
		$repository = App::make(\Tmdb\Repository\MovieRepository::class);

		$movie = $repository->load($id);

		return view('pages.movie.cast', compact('movie'));
	}

	public function similar($id)
	{
		$repository = App::make(\Tmdb\Repository\MovieRepository::class);

		$movie = $repository->load($id);

		return view('pages.movie.similar', compact('movie'));
	}

	public function plan(Request $request)
	{
		Auth::user()->togglePlannedMovie($request->input('id'));
	}

	public function seen(Request $request)
	{
		Auth::user()->toggleSeenMovie($request->input('id'));
	}
}
