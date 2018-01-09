<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PeopleController extends Controller
{
	public function show($id)
	{
		$repository = App::make(\Tmdb\Repository\PeopleRepository::class);

		$person = $repository->load($id);

		$person->getMovieCredits()->getCast()->sort(function($a, $b){
			if ($a->getReleaseDate() == $b->getReleaseDate()) {
				return 0;
			}

			return $a->getReleaseDate() < $b->getReleaseDate() ? 1 : -1;
		});

		$person->getMovieCredits()->getCrew()->sort(function($a, $b){
			if ($a->getReleaseDate() == $b->getReleaseDate()) {
				return 0;
			}

			return $a->getReleaseDate() < $b->getReleaseDate() ? 1 : -1;
		});

		$person->getTvCredits()->getCast()->sort(function($a, $b){
			if ($a->getFirstAirDate() == $b->getFirstAirDate()) {
				return 0;
			}

			return $a->getFirstAirDate() < $b->getFirstAirDate() ? 1 : -1;
		});

		$person->getTvCredits()->getCrew()->sort(function($a, $b){
			if ($a->getFirstAirDate() == $b->getFirstAirDate()) {
				return 0;
			}

			return $a->getFirstAirDate() < $b->getFirstAirDate() ? 1 : -1;
		});
		
		return view('pages.people.show', compact('person'));
	}
}
