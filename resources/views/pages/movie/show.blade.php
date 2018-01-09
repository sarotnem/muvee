@extends('layouts.app')
@section('title', $movie->getTitle().' | Muvee')

@section('content')

<div class="page-header clear-filter" filter-color="orange" id="app">
    <div class="page-header-image" data-parallax="false" style="background-image: url('https://image.tmdb.org/t/p/w1400_and_h450_bestv2/{{$movie->getBackdropImage()}}');">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 mt-4">
                <div class="poster">
                    <img src="https://image.tmdb.org/t/p/w300_and_h450_bestv2/{{$movie->getPosterImage()}}" alt="">
                </div>
            </div>
            <div class="col-md-8 col-sm-12 mt-5">
                <div class="details">
                    <h1 class="title">{{ $movie->getTitle()}} <span class="year">({{ $movie->getReleaseDate()->format('Y') }})</span></h1>
                    <h4 class="mt-0 tagline">{{ $movie->getTagline() }}</h4>

                    <div class="c100 p{{ $movie->getVoteAverage()*10 }} small mr-3">
                        <span>{{ $movie->getVoteAverage() }}</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>

                    <button class="btn-film-controls film-seen mt-3 mr-3
                    @if ($seen)
                    true
                    @endif
                    ">Seen</button>
                    <button class="btn-film-controls film-planned mt-3
                    @if ($planned)
                    true
                    @endif
                    ">Planned</button>

                    <h6 class="mt-4">Overview</h6>
                    <h5 class="overview">{{ $movie->getOverview() }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-8 pt-4">
                <h3>Top Billed Cast</h3>
                <div class="row row-eq-height cast">
                    @foreach ($featuredCast as $actor)
                    <div class="col-3">
                        <div class="card card-inverse card-info">
                            <a href="{{ route('people.show', $actor->getId()) }}">
                                @if ($actor->getProfilePath())
                                <img class="card-img-top" src="https://image.tmdb.org/t/p/w138_and_h175_bestv2/{{ $actor->getProfilePath() }}">
                                @else
                                <img class="card-img-top" src="/img/no-image-lg.jpg">
                                @endif
                                <div class="card-block">
                                    <h4 class="card-title">{{ $actor->getName() }}</h4>
                                </a>
                                <div class="card-text">
                                    {{ $actor->getCharacter() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-12 mt-4">
                        <a href="{{ route('movie.cast', $movie->getId()) }}" class="btn btn-primary btn-round btn-lg">View Full Cast & Crew</a>
                    </div>
                </div>
            </div>
            <div class="col-4 sidebar pt-4">
                <div class="crew">
                    @foreach ($featuredCrew as $name => $jobs)
                    <p class="description">
                        @foreach ($jobs as $job)
                        @if (!$loop->last)
                        {{$job}},
                        @else
                        {{ $job }}
                        @endif
                        @endforeach
                    </p>
                    <p class="value">{{ $name }}</p>
                    @endforeach
                    <hr>
                </div>
                @if ($movie->getTitle() != $movie->getOriginalTitle())
                <p class="description">Original Title</p>
                <p class="value">{{ $movie->getOriginalTitle() }}</p>
                @endif
                <div class="genre">
                    <p class="description">Genre</p>
                    <p class="value">
                        @foreach ($movie->getGenres() as $genre)
                        @if(!$loop->last)
                        {{ $genre->getName() }},
                        @else
                        {{ $genre->getName() }}
                        @endif
                        @endforeach
                    </p>
                </div>
                <div class="runtime">
                    <p class="description">Runtime</p>
                    <p class="value">{{ sprintf("%02dh %02dm",floor($movie->getRuntime()/60), $movie->getRuntime()%60) }}</p>
                </div>
                <div class="language">
                    <p class="description">Original Language</p>
                    <p class="value">{{ Languages::keyValue([$movie->getOriginalLanguage()])[0]->value }}</p>
                </div>
                <div class="release-date">
                    <p class="description">Release Date</p>
                    <p class="value">{{ $movie->getReleaseDate()->format('d F Y') }}</p>
                </div>
                <div class="trailer">
                    <p class="description">View Trailer</p>
                    <p class="value"><a target="_blank" href="https://youtube.com/watch?v={{ $trailer }}"><i class="fa fa-youtube-play fa-3x" aria-hidden="true"></i></a></p>
                </div>
                <div class="watch-it">
                    <p class="description">Watch It Now!</p>
                    <p class="value"><a target="_blank" href="https://www.fan.tv/movies/{{ $movie->getId() }}"><i class="fa fa-television fa-3x" aria-hidden="true"></i></a></p>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mt-4 row-eq-heights similar mb-5">
            <div class="col-12">
                <h3>Similar Movies</h3>
            </div>
            @foreach ($movie->getSimilar() as $similar)
            @if ($loop->iteration == 7)
            @break
            @endif
            <div class="col-2">
                <div class="card card-inverse card-info">
                    <a href="{{ route('movie.show', $similar->getId()) }}">
                        @if ($similar->getPosterPath())
                        <img class="card-img-top" src="https://image.tmdb.org/t/p/w138_and_h175_bestv2/{{ $similar->getPosterPath() }}">
                        @else
                        <img class="card-img-top" src="/img/no-image-lg.jpg">
                        @endif
                        <div class="card-block">
                            <h4 class="card-title">{{ $similar->getTitle() }}</h4>
                        </a>
                        <div class="card-text">
                            <div>
                                <i class="fa fa-calendar mr-2"></i>{{ $similar->getReleaseDate()->format('Y') }}
                            </div>
                            <div class="mt-2">
                                <i class="fa fa-star mr-2"></i>{{ number_format($similar->getVoteAverage(), 1, '.', '') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-12 mt-4">
              <a href="{{ route('movie.similar', $movie->getId()) }}" class="btn btn-lg  btn-block btn-primary btn-round">View More Similar Movies</a>  
          </div>
      </div>
  </div>
</div>
</div>
@endsection

@section('javascripts')
<script type="text/javascript">

    $('.film-planned').click(function() {
        $.ajax({
            url: "{{ route('movie.plan') }}",
            data: {'id': {{ $movie->getId() }} },
            type: "PUT",
            headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
            success: function(response) {
                $('.film-planned').toggleClass('true');
            }
        });
    });

    $('.film-seen').click(function() {
        $.ajax({
            url: "{{ route('movie.seen') }}",
            data: {'id': {{ $movie->getId() }} },
            type: "PUT",
            headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
            success: function(response) {
                $('.film-seen').toggleClass('true');
            }
        });
    });
</script>
@endsection