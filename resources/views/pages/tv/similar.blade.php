@extends('layouts.app')
@section('title', $tv->getName().' Similar TV Shows');

@section('content')

<div class="main mt-5">
    <div class="container">
        <div class="row mt-5 header-title">
            <div class="col-2 mt-5 text-left">
                <img src="https://image.tmdb.org/t/p/w300_and_h450_bestv2{{$tv->getPosterPath()}}" alt="" class="poster rounded">
            </div>
            <div class="col-10 mt-5">
                <h2 class="mb-0">{{ $tv->getName() }}</h2>
                <h4 class="text-muted mt-0">Similar Movies</h4>
                <a href="{{route('tv.show', $tv->getId())}}">&larr; Back to {{ $tv->getName() }}</a>
            </div>
        </div>
        <div class="row mt-4 row-eq-heights similar mb-5">
            @foreach ($tv->getSimilar() as $similar)
            <div class="col-2">
                <div class="card card-inverse card-info" style="height:auto">
                    <a href="{{ route('movie.show', $similar->getId()) }}">
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
        </a>
        @endforeach
    </div>
</div>
</div>
</div>
@endsection

@section('javascripts')
<script type="text/javascript">
 
</script>
@endsection