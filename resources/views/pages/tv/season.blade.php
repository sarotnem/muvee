@extends('layouts.app')
@section('title', $tv->getName().' '.$season->getName());

@section('content')

<div class="main mt-5" id="app">
    <div class="container">
        <div class="row mt-5 header-title">
            <div class="col-2 mt-5 text-left">
                @if ($season->getPosterPath())
                <img src="https://image.tmdb.org/t/p/w300_and_h450_bestv2{{$season->getPosterPath()}}" alt="" class="poster rounded">
                @else
                <img src="/img/no-image-lg.jpg" alt="" class="poster rounded">
                @endif
            </div>
            <div class="col-10 mt-5">
                <h2 class="mb-0">{{ $tv->getName() }}</h2>
                <h4 class="text-muted mt-0">{{ $season->getName() }}</h4>
                <a href="{{route('tv.seasons', $tv->getId())}}">&larr; Back to {{ $tv->getName() }} Seasons</a>
                <h5 class="mt-3" style="position:absolute; bottom:0; margin-bottom: 0">You have seen <span class="seen-episodes">{{ $seenEpisodes }}</span>/{{ count($season->getEpisodes()) }} episodes.</h5>
            </div>
        </div>
        <hr>
        @foreach ($season->getEpisodes() as $episode)
        <div class="row episode">
            <div class="col-4">
                @if($episode->getStillPath())
                <img src="https://image.tmdb.org/t/p/w454_and_h254_bestv2{{ $episode->getStillPath() }}" alt="" class="rounded poster">
                @else
                <img src="/img/no-image-lg.jpg" alt="" class="rounded poster">
                @endif
            </div>
            <div class="col-8">
                <h3 class="name mb-1">
                    <span class="mr-2 text-dark">{{ $episode->getEpisodeNumber() }} |</span>{{ $episode->getName() }}       
                </h3>
                <h6 class="year">
                    {{ $episode->getAirDate()->format('F d, Y') }} 
                </h6>
                <p class="overview mt-3">
                    @if ($episode->getOverview())
                    {{ $episode->getOverview() }}
                    @else
                    episode {{ $episode->getEpisodeNumber() }} of {{ $tv->getName() }}
                    @endif
                </p>
            </div>
            <div class="col-12 mt-3 seen">
                <button data-episode="{{ $episode->getId() }}" class="btn-seen btn btn-danger btn-lg btn-block 
                @if ($episode->seen)
                    bg-success
                @else
                    bg-danger
                @endif
                ">I've seen it!</button>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection

@section('javascripts')
<script type="text/javascript">
    $('.btn-seen').click(function(e) {
        $.ajax({
            url: "{{ route('tv.seen') }}",
            data: { 
                'tv_id': {{ $tv->getId() }} ,
                'episode_id': $(e.target).data('episode'),
            },
            type: "PUT",
            headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
            success: function(response) {
                if ($(e.target).hasClass('bg-success'))
                {
                    $(e.target).removeClass('bg-success').addClass('bg-danger');
                    $('.seen-episodes').text(parseInt($('.seen-episodes').text())-1)
                }
                else 
                {
                    $(e.target).removeClass('bg-danger').addClass('bg-success')
                    $('.seen-episodes').text(parseInt($('.seen-episodes').text())+1)
                }
            }
        });
    });
</script>
@endsection