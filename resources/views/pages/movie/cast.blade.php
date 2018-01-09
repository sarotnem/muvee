@extends('layouts.app')
@section('title', $movie->getTitle().' Full Cast & Crew');

@section('content')

<div class="main mt-5">
    <div class="container">
        <div class="row mt-5 header-title">
            <div class="col-2 mt-5 text-left">
                <img src="https://image.tmdb.org/t/p/w300_and_h450_bestv2{{$movie->getPosterPath()}}" alt="" class="poster rounded">
            </div>
            <div class="col-10 mt-5">
                <h2 class="mb-0">{{ $movie->getTitle() }}</h2>
                <h4 class="text-muted mt-0">Full Cast & Crew</h4>
                <a href="{{route('movie.show', $movie->getId())}}">&larr; Back to {{ $movie->getTitle() }}</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-6">
                <h5>Cast <span class="text-muted">({{ count($movie->getCredits()->getCast()) }})</span></h5>
                @foreach ($movie->getCredits()->getCast() as $actor)
                <div class="row">
                    <div class="col-12">
                        <ul class="credits">
                            <li>
                                @if ($actor->getProfilePath())
                                <img alt="{{ $actor->getName() }}" src="
                                https://image.tmdb.org/t/p/w138_and_h175_bestv2/{{ $actor->getProfilePath() }}" />
                                @else
                                <img alt="{{ $actor->getName() }}" src="
                                /img/no-image.jpg" />
                                @endif
                                <div class="info">
                                    <h2 class="title">{{ $actor->getName() }}</h2>
                                    <p class="desc">{{ $actor->getCharacter() }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-6">
                <h5>Crew <span class="text-muted">({{ count($movie->getCredits()->getCrew()) }})</span></h5>
                @foreach ($movie->getCredits()->getCrew() as $person)
                <div class="row">
                    <div class="col-12">
                        <ul class="credits">
                            <li>
                                @if ($person->getProfilePath())
                                <img alt="{{ $person->getName() }}" src="
                                https://image.tmdb.org/t/p/w138_and_h175_bestv2/{{ $person->getProfilePath() }}" />
                                @else
                                <img alt="{{ $person->getName() }}" src="
                                /img/no-image.jpg" />
                                @endif
                                <div class="info">
                                    <h2 class="title">{{ $person->getName() }}</h2>
                                    <p class="desc">{{ $person->getJob() }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
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