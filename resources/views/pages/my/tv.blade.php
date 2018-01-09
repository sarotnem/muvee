@extends('layouts.app')
@section('title', 'My Tv');

@section('content')

<div class="main mt-5">
	<div class="container">
		<div class="row mt-5">
			<div class="col-12">
				<h2 class="mt-4">My TV</h2>
			</div>
		</div>
		<div class="row mt-2 similar mb-5">
			<div class="col-12">
				<h3 class="text-primary">Planned TV</h3>
			</div>
			@foreach ($planned as $tv)
			<div class="col-2" style="height:400px">
				<div class="card card-inverse card-info">
					<a href="{{ route('tv.show', $tv->tmdb->getId()) }}">
						@if ($tv->tmdb->getPosterPath())
						<img class="card-img-top" src="https://image.tmdb.org/t/p/w138_and_h175_bestv2/{{ $tv->tmdb->getPosterPath() }}">
						@else
						<img class="card-img-top" src="/img/no-image-lg.jpg">
						@endif
						<div class="card-block">
							<h4 class="card-title">{{ $tv->tmdb->getName() }}</h4>
						</a>
						<div class="card-text">
							<div>
								<i class="fa fa-calendar mr-2"></i>{{ $tv->tmdb->getFirstAirDate()->format('Y') }}
							</div>
							<div class="mt-2">
								<i class="fa fa-star mr-2"></i>{{ number_format($tv->tmdb->getVoteAverage(), 1, '.', '') }}
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<div class="row mt-4 similar mb-5">
			<div class="col-12">
				<h3 class="text-primary">Seen TV</h3>
			</div>
			@foreach ($seen as $tv)
			<div class="col-2" style="height:400px">
				<div class="card card-inverse card-info">
					<a href="{{ route('tv.show', $tv->tmdb->getId()) }}">
						@if ($tv->tmdb->getPosterPath())
						<img class="card-img-top" src="https://image.tmdb.org/t/p/w138_and_h175_bestv2/{{ $tv->tmdb->getPosterPath() }}">
						@else
						<img class="card-img-top" src="/img/no-image-lg.jpg">
						@endif
						<div class="card-block">
							<h4 class="card-title">{{ $tv->tmdb->getName() }}</h4>
						</a>
						<div class="card-text">
							<div>
								<i class="fa fa-calendar mr-2"></i>{{ $tv->tmdb->getFirstAirDate()->format('Y') }}
							</div>
							<div class="mt-2">
								<i class="fa fa-star mr-2"></i>{{ number_format($tv->tmdb->getVoteAverage(), 1, '.', '') }}
							</div>
							<div class="mt-2">
								<i class="fa fa-tv mr-1"></i>{{ $tv->tmdb->episodesSeen }} / {{ $tv->tmdb->getNumberOfEpisodes() }}
								@if ($tv->tmdb->episodesSeen == $tv->tmdb->getNumberOfEpisodes())
									<i class="fa fa-check ml-1 text-success"></i>
								@else
									<i class="fa fa-ban ml-1 text-danger"></i>
								@endif
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