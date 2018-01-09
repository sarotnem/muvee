@extends('layouts.app')
@section('title', $tv->getName().' | Muvee')

@section('content')

<div class="page-header clear-filter" filter-color="orange" id="app">
    <div class="page-header-image" data-parallax="false" style="background-image: url('https://image.tmdb.org/t/p/w1400_and_h450_bestv2/{{$tv->getBackdropImage()}}');">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 mt-4">
                <div class="poster">
                    <img src="https://image.tmdb.org/t/p/w300_and_h450_bestv2/{{$tv->getPosterImage()}}" alt="">
                </div>
            </div>
            <div class="col-md-8 col-sm-12 mt-5">
                <div class="details">
                    <h1 class="title">{{ $tv->getName()}} <span class="year">({{ $tv->getFirstAirDate()->format('Y') }})</span></h1>

                    <div class="c100 p{{ $tv->getVoteAverage()*10 }} small mr-3">
                        <span>{{ $tv->getVoteAverage() }}</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>

                    <button class="btn-film-controls film-planned mt-3
                    @if ($planned)
                    true
                    @endif
                    ">Planned</button>

                    <h6 class="mt-4">Overview</h6>
                    <h5 class="overview">{{ $tv->getOverview() }}</h5>
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
                        <a href="{{ route('tv.cast', $tv->getId()) }}" class="btn btn-primary btn-round btn-lg">View Full Cast & Crew</a>
                    </div>
                </div>
            </div>
            <div class="col-4 sidebar pt-4">
                @if ($tv->getName() != $tv->getOriginalName())
                <p class="description">Original Title</p>
                <p class="value">{{ $tv->getOriginalName() }}</p>
                @endif
                <div class="genre">
                    <p class="description">Genre</p>
                    <p class="value">
                        @foreach ($tv->getGenres() as $genre)
                        @if(!$loop->last)
                        {{ $genre->getName() }},
                        @else
                        {{ $genre->getName() }}
                        @endif
                        @endforeach
                    </p>
                </div>
                <div class="status">
                    <p class="description">Status</p>
                    <p class="value">{{ $tv->getStatus() }}</p>
                </div>
                <div class="network">
                    <p class="description">Status</p>
                    <p class="value">
                        @foreach ($tv->getNetworks() as $network)
                        @if(!$loop->last)
                        {{ $network->getName() }},
                        @else
                        {{ $network->getName() }}
                        @endif
                        @endforeach
                    </p>
                </div>
                <div class="runtime">
                    <p class="description">Runtime</p>
                    <p class="value">
                        @if ($tv->getEpisodeRuntime())
                            {{ $tv->getEpisodeRuntime()[0] }}m
                        @else
                            Unknown
                        @endif
                    </p>
                </div>
                <div class="language">
                    <p class="description">Original Language</p>
                    <p class="value">{{ Languages::keyValue([$tv->getOriginalLanguage()])[0]->value }}</p>
                </div>
                <div class="release-date">
                    <p class="description">First Air Date</p>
                    <p class="value">{{ $tv->getFirstAirDate()->format('d F Y') }}</p>
                </div>
                <div class="type">
                    <p class="description">Type</p>
                    <p class="value">{{ $tv->getType() }}</p>
                </div>
                <div class="trailer">
                    <p class="description">View Trailer</p>
                    <p class="value"><a target="_blank" href="https://youtube.com/watch?v={{ $trailer }}"><i class="fa fa-youtube-play fa-3x" aria-hidden="true"></i></a></p>
                </div>
                <div class="watch-it">
                    <p class="description">Watch It Now!</p>
                    <p class="value"><a target="_blank" href="https://www.fan.tv/movies/{{ $tv->getId() }}"><i class="fa fa-television fa-3x" aria-hidden="true"></i></a></p>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mt-0 season">
            <div class="col-12"><h3>Last Season</h3></div>
            @foreach ($tv->getSeasons() as $season)
            @if($loop->last)
            <div class="col-2">
                <a href="{{ route('tv.season', [$tv->getId(), $season->getSeasonNumber()]) }}">
                    @if($season->getPosterPath())
                    <img src="https://image.tmdb.org/t/p/w130_and_h195_bestv2/{{ $season->getPosterPath() }}" alt="" class="rounded poster">
                    @else
                    <img src="/img/no-image-lg.jpg" alt="" class="rounded poster">
                    @endif
                </a>
            </div>
            <div class="col-10">
                <h3 class="name mb-1">
                    <a href="{{ route('tv.season', [$tv->getId(), $season->getSeasonNumber()]) }}">{{ $season->getName() }}</a>                    
                </h3>
                <h6 class="year">
                    {{ $season->getAirDate()->format('Y') }} |
                    <span class="episodes">{{ count($season->getEpisodes()) }} Episodes</span>
                </h6>
                <p class="overview mt-3">
                    @if ($season->getOverview())
                    {{ $season->getOverview() }}
                    @else
                    Season {{ $season->getSeasonNumber() }} of {{ $tv->getName() }} premiered on {{ $season->getAirDate()->format('Y-m-d') }}
                    @endif
                </p>
            </div>
            <div class="col-12 mt-4">
                <a href="{{ route('tv.seasons', $tv->getId()) }}" class="btn btn-lg btn-primary btn-block" style="font-size:1.4rem">All Seasons</a>
            </div>
            @endif
            @endforeach
        </div>
        <div class="row">
            <div class="col-12">
                <h3>Statistics</h3>
            </div>
            <div class="col-4">
                <h5>Total Episodes: {{ $totalEpisodes }}</h5>
                <h5>Episodes Seen: {{ $seenEpisodes }}</h5>
            </div>
            @if ($totalEpisodes != 0)
                <div class="col-8">
                <div class="progress-container progress-primary">
                    <span class="progress-badge">Progress</span>
                    <div class="progress" style="height:12px">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ round(($seenEpisodes/$totalEpisodes)*100) }}%;">
                            <span class="progress-value">{{ round(($seenEpisodes/$totalEpisodes)*100) }} %</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <hr>
        <div class="row mt-4 row-eq-heights similar mb-5">
            <div class="col-12">
                <h3>Similar TV Shows</h3>
            </div>
            @foreach ($tv->getSimilar() as $similar)
            @if ($loop->iteration == 7)
            @break
            @endif
            <div class="col-2">
                <div class="card card-inverse card-info">
                    <a href="{{ route('tv.show', $similar->getId()) }}">
                        @if ($similar->getPosterPath())
                        <img class="card-img-top" src="https://image.tmdb.org/t/p/w138_and_h175_bestv2/{{ $similar->getPosterPath() }}">
                        @else
                        <img class="card-img-top" src="/img/no-image-lg.jpg">
                        @endif
                        <div class="card-block">
                            <h4 class="card-title">{{ $similar->getName() }}</h4>
                        </a>
                        <div class="card-text">
                            <div>
                                <i class="fa fa-calendar mr-2"></i>{{ $similar->getFirstAirDate()->format('Y') }}
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
              <a href="{{ route('tv.similar', $tv->getId()) }}" class="btn btn-lg  btn-block btn-primary btn-round">View More Similar TV Shows</a>  
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
            url: "{{ route('tv.plan') }}",
            data: {'id': {{ $tv->getId() }} },
            type: "PUT",
            headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
            success: function(response) {
                $('.film-planned').toggleClass('true');
            }
        });
    });
</script>
@endsection