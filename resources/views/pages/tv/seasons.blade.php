@extends('layouts.app')
@section('title', $tv->getName().' Seasons');

@section('content')

<div class="main mt-5">
    <div class="container">
        <div class="row mt-5 header-title">
            <div class="col-2 mt-5 text-left">
                <img src="https://image.tmdb.org/t/p/w300_and_h450_bestv2{{$tv->getPosterPath()}}" alt="" class="poster rounded">
            </div>
            <div class="col-10 mt-5">
                <h2 class="mb-0">{{ $tv->getName() }}</h2>
                <h4 class="text-muted mt-0">Seasons</h4>
                <a href="{{route('tv.show', $tv->getId())}}">&larr; Back to {{ $tv->getName() }}</a>
            </div>
        </div>
        <hr>
        @foreach ($tv->getSeasons() as $season)
        <div class="row season">
            <div class="col-4">
                <a href="{{ route('tv.season', [$tv->getId(), $season->getSeasonNumber()]) }}">
                    @if($season->getPosterPath())
                    <img src="https://image.tmdb.org/t/p/w130_and_h195_bestv2/{{ $season->getPosterPath() }}" alt="" class="rounded poster">
                    @else
                    <img src="/img/no-image-lg.jpg" alt="" class="rounded poster">
                    @endif
                </a>
            </div>
            <div class="col-8">
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
            <div class="col-12 stats pt-3 pb-3 mt-3 rounded text-center 
            @if (($seenEpisodes[$season->getSeasonNumber()] == 0))
            bg-danger
            @elseif (($seenEpisodes[$season->getSeasonNumber()] == count($season->getEpisodes())))
            bg-success
            @else
            bg-primary

            @endif
            ">
                You have seen {{ $seenEpisodes[$season->getSeasonNumber()] }}/{{ count($season->getEpisodes()) }} episodes.
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection

@section('javascripts')
<script type="text/javascript">
    $(document).ready(function() {
        // the body of this function is in assets/js/now-ui-kit.js
        nowuiKit.initSliders();
    });
</script>
@endsection