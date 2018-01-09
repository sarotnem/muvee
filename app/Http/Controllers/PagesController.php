<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App;
use App\SeenMovie;
use App\PlannedMovie;
use App\PlannedTv;
use App\SeenTv;
use Tmdb\Model\Search\SearchQuery\KeywordSearchQuery;

class PagesController extends Controller
{
	public function home()
	{
		$repository = App::make(\Tmdb\Repository\MovieRepository::class);
		$popularMovies = $repository->getPopular();

		$repository = App::make(\Tmdb\Repository\TvRepository::class);
		$popularTv = $repository->getPopular();

		return view('index', compact('popularMovies', 'popularTv'));
	}

	public function search(Request $request)
	{
		$searchQuery = $request->input('query');
		$page = $request->input('page');

		$repository = App::make(\Tmdb\Repository\SearchRepository::class);
		$query = new \Tmdb\Model\Search\SearchQuery\KeywordSearchQuery();
		$query->page($page);

		$results = $repository->searchMulti($searchQuery, $query);
		return view('search', compact('results', 'searchQuery', 'page'));
	}

	public function movies()
	{
		$planned = PlannedMovie::where('user_id', '=', Auth::user()->id)
		->orderBy('created_at', 'asc')
		->get();

		$seen = SeenMovie::where('user_id', '=', Auth::user()->id)
		->orderBy('created_at', 'desc')
		->get();

		$repository = App::make(\Tmdb\Repository\MovieRepository::class);

		foreach ($planned as $movie) {
			$tmdb = $repository->load($movie->movie_id);
			$movie->tmdb = $tmdb;
		}

		foreach ($seen as $movie) {
			$tmdb = $repository->load($movie->movie_id);
			$movie->tmdb = $tmdb;
		}

		return view('pages.my.movies', compact('planned', 'seen'));
	}

	public function tv()
	{
		$planned = PlannedTv::where('user_id', '=', Auth::user()->id)
		->orderBy('created_at', 'asc')
		->get();

		$seen = SeenTv::select('tv_id')
		->distinct()
		->where('user_id', '=', Auth::user()->id)
		->get();

		$repository = App::make(\Tmdb\Repository\TvRepository::class);

		foreach ($planned as $tv) {
			$tmdb = $repository->load($tv->tv_id);
			$tv->tmdb = $tmdb;
		}

		foreach ($seen as $tv) {
			$tmdb = $repository->load($tv->tv_id);
			$tv->tmdb = $tmdb;
			$tv->tmdb->episodesSeen = SeenTv::where('user_id', '=', Auth::user()->id)
			->where('tv_id', '=', $tv->tv_id)
			->count();
		}

		return view('pages.my.tv', compact('planned', 'seen'));
	}
}
