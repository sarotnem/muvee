@extends('layouts.app')
@section('title', 'Muvee');

@section('content')

<div class="main mt-5">
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h2 class="mt-4">Welcome!</h2>
            </div>
        </div>
        <div class="row mt-2 similar mb-5">
            <div class="col-12">
                <h3 class="text-primary">Popular Movies</h3>
            </div>
            @foreach ($popularMovies as $movie)
            @if ($loop->iteration == 7)
            @break
            @endif
            <div class="col-2" style="height:400px">
                <div class="card card-inverse card-info">
                    <a href="{{ route('movie.show', $movie->getId()) }}">
                        @if ($movie->getPosterPath())
                        <img class="card-img-top" src="https://image.tmdb.org/t/p/w138_and_h175_bestv2/{{ $movie->getPosterPath() }}">
                        @else
                        <img class="card-img-top" src="/img/no-image-lg.jpg">
                        @endif
                        <div class="card-block">
                            <h4 class="card-title">{{ $movie->getTitle() }}</h4>
                        </a>
                        <div class="card-text">
                            <div>
                                <i class="fa fa-calendar mr-2"></i>{{ $movie->getReleaseDate()->format('Y') }}
                            </div>
                            <div class="mt-2">
                                <i class="fa fa-star mr-2"></i>{{ number_format($movie->getVoteAverage(), 1, '.', '') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
            <div class="row mt-5 similar mb-5">
            <div class="col-12">
                <h3 class="text-primary">Popular Tv Series</h3>
            </div>
            @foreach ($popularTv as $tv)
            @if ($loop->iteration == 7)
            @break
            @endif
            <div class="col-2" style="height:400px">
                <div class="card card-inverse card-info">
                    <a href="{{ route('tv.show', $tv->getId()) }}">
                        @if ($tv->getPosterPath())
                        <img class="card-img-top" src="https://image.tmdb.org/t/p/w138_and_h175_bestv2/{{ $tv->getPosterPath() }}">
                        @else
                        <img class="card-img-top" src="/img/no-image-lg.jpg">
                        @endif
                        <div class="card-block">
                            <h4 class="card-title">{{ $tv->getName() }}</h4>
                        </a>
                        <div class="card-text">
                            <div>
                                <i class="fa fa-calendar mr-2"></i>{{ $tv->getFirstAirDate()->format('Y') }}
                            </div>
                            <div class="mt-2">
                                <i class="fa fa-star mr-2"></i>{{ number_format($tv->getVoteAverage(), 1, '.', '') }}
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