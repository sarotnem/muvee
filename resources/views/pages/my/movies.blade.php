@extends('layouts.app')
@section('title', 'My Movies');

@section('content')

<div class="main mt-5">
	<div class="container">
		<div class="row mt-5">
			<div class="col-12">
				<h2 class="mt-4">My Movies</h2>
			</div>
		</div>
		<div class="row mt-2 similar mb-5">
			<div class="col-12">
				<h3 class="text-primary">Planned Movies</h3>
			</div>
			@foreach ($planned as $movie)
			<div class="col-2" style="height:400px">
				<div class="card card-inverse card-info">
					<a href="{{ route('movie.show', $movie->tmdb->getId()) }}">
						@if ($movie->tmdb->getPosterPath())
						<img class="card-img-top" src="https://image.tmdb.org/t/p/w138_and_h175_bestv2/{{ $movie->tmdb->getPosterPath() }}">
						@else
						<img class="card-img-top" src="/img/no-image-lg.jpg">
						@endif
						<div class="card-block">
							<h4 class="card-title">{{ $movie->tmdb->getTitle() }}</h4>
						</a>
						<div class="card-text">
							<div>
								<i class="fa fa-calendar mr-2"></i>{{ $movie->tmdb->getReleaseDate()->format('Y') }}
							</div>
							<div class="mt-2">
								<i class="fa fa-star mr-2"></i>{{ number_format($movie->tmdb->getVoteAverage(), 1, '.', '') }}
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<div class="row mt-4 similar mb-5">
			<div class="col-12">
				<h3 class="text-primary">Seen Movies</h3>
			</div>
			@foreach ($seen as $movie)
			<div class="col-2" style="height:400px">
				<div class="card card-inverse card-info">
					<a href="{{ route('movie.show', $movie->tmdb->getId()) }}">
						@if ($movie->tmdb->getPosterPath())
						<img class="card-img-top" src="https://image.tmdb.org/t/p/w138_and_h175_bestv2/{{ $movie->tmdb->getPosterPath() }}">
						@else
						<img class="card-img-top" src="/img/no-image-lg.jpg">
						@endif
						<div class="card-block">
							<h4 class="card-title">{{ $movie->tmdb->getTitle() }}</h4>
						</a>
						<div class="card-text">
							<div>
								<i class="fa fa-calendar mr-2"></i>{{ $movie->tmdb->getReleaseDate()->format('Y') }}
							</div>
							<div class="mt-2">
								<i class="fa fa-star mr-2"></i>{{ number_format($movie->tmdb->getVoteAverage(), 1, '.', '') }}
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection

@section('javascripts')
<script type="text/javascript">

</script>
@endsection