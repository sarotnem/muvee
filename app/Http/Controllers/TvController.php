<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tmdb\Repository\TvRepository;
use App;
use Auth;
use App\PlannedTv;
use App\SeenTv;

class TvController extends Controller
{
	public function show($id)
	{
		$repository = App::make(\Tmdb\Repository\TvRepository::class);

		$tv = $repository->load($id);

		$planned = PlannedTv::where('user_id', '=', Auth::user()->id)
		->where('tv_id', '=', $tv->getId())
		->first();

		$tv->getCredits()->getCast()->sort(function($a, $b){
			if ($a->getOrder() == $b->getOrder()) {
				return 0;
			}

			return $a->getOrder() > $b->getOrder() ? 1 : -1;
		});

		//Get featured Cast
		$featuredCast = array();

		foreach ($tv->getCredits()->getCast() as $actor) {
			if ($actor->getOrder() > 3) {
				break;
			}
			else {
				array_push($featuredCast, $actor);
			}
		}

		//Get trailer youtube link
		$trailer = false;
		foreach ($tv->getVideos() as $video) {
			if ($video->getSite() == 'YouTube' && $video->getType() == 'Trailer') {
				$trailer = $video->getKey();
			}
		}

		//Get Seasons Info
		$seasons = array();

		foreach ($tv->getSeasons() as $season) {
			$repository = App::make(\Tmdb\Repository\TvSeasonRepository::class);
			array_push($seasons, $repository->load($tv->getId(), $season->getSeasonNumber()));
		}

		$tv->setSeasons($seasons);

		//Get Episodes Seen
		$totalEpisodes = 0;
		$seenEpisodes = 0;

		foreach ($tv->getSeasons() as $season) {
			$totalEpisodes += count($season->getEpisodes());

			foreach ($season->getEpisodes() as $episode) {
				$seen = SeenTv::where('user_id', '=', Auth::user()->id)
				->where('tv_id', '=', $tv->getId())
				->where('episode_id', '=', $episode->getId())
				->first();

				if ($seen) 
					$seenEpisodes++;
			}
		}
		
		return view('pages.tv.show', compact('tv', 'featuredCast', 'trailer', 'planned', 'totalEpisodes', 'seenEpisodes'));
	}

	public function cast($id)
	{
		$repository = App::make(\Tmdb\Repository\TvRepository::class);

		$tv = $repository->load($id);

		$tv->getCredits()->getCast()->sort(function($a, $b){
			if ($a->getOrder() == $b->getOrder()) {
				return 0;
			}

			return $a->getOrder() > $b->getOrder() ? 1 : -1;
		});

		return view('pages.tv.cast', compact('tv'));
	}

	public function similar($id)
	{
		$repository = App::make(\Tmdb\Repository\TvRepository::class);

		$tv = $repository->load($id);

		return view('pages.tv.similar', compact('tv'));
	}

	public function seasons($id)
	{
		$repository = App::make(\Tmdb\Repository\TvRepository::class);

		$tv = $repository->load($id);

		$seasons = array();

		foreach ($tv->getSeasons() as $season) {
			$repository = App::make(\Tmdb\Repository\TvSeasonRepository::class);
			array_push($seasons, $repository->load($tv->getId(), $season->getSeasonNumber()));
		}

		$tv->setSeasons($seasons);

		$seenEpisodes = array();

		foreach ($tv->getSeasons() as $season) {
			$episodesSeenCount = 0;
			foreach ($season->getEpisodes() as $episode) {
				$seen = SeenTv::where('user_id', '=', Auth::user()->id)
				->where('tv_id', '=', $tv->getId())
				->where('episode_id', '=', $episode->getId())
				->first();

				if ($seen) 
				{
					$episodesSeenCount++;
				}
			}

			$seenEpisodes[$season->getSeasonNumber()] = $episodesSeenCount;
		}

		return view('pages.tv.seasons', compact('tv', 'seenEpisodes'));
	}

	public function season($id, $seasonId)
	{
		$repository = App::make(\Tmdb\Repository\TvRepository::class);

		$tv = $repository->load($id);

		$repository = App::make(\Tmdb\Repository\TvSeasonRepository::class);
		$season = $repository->load($tv->getId(), $seasonId);

		$seenEpisodes = 0;

		foreach ($season->getEpisodes() as $episode) {
			$seen = SeenTv::where('user_id', '=', Auth::user()->id)
			->where('tv_id', '=', $tv->getId())
			->where('episode_id', '=', $episode->getId())
			->first();

			if ($seen) 
			{
				$episode->seen = true;
				$seenEpisodes++;
			}
			else 
			{
				$episode->seen = false;
			}
		}

		return view('pages.tv.season', compact('tv', 'season', 'seenEpisodes'));
	}

	public function plan(Request $request)
	{
		Auth::user()->togglePlannedTv($request->input('id'));
	}

	public function seen(Request $request)
	{
		Auth::user()->toggleSeenTv($request->input('tv_id'), $request->input('episode_id'));
	}
}
