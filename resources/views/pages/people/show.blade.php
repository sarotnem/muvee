@extends('layouts.app')
@section('title', $person->getName());

@section('content')

<div class="main mt-5">
    <div class="container">
        <div class="row person">
            <div class="col-4 mt-4">
                <div class="col-12">
                 <img src="https://image.tmdb.org/t/p/w300_and_h450_bestv2/{{ $person->getProfilePath() }}" class="rounded profile-img" alt=""> 
             </div>
             <div class="col-12 sidebar mt-4">
                <h5>Personal Info</h5>
                <div class="gender">
                    <p class="description">Gender</p>
                    <p class="value">
                        @if ($person->isMale())
                        Male
                        @elseif ($person->isFemale())
                        Female
                        @else
                        -
                        @endif
                    </p>
                </div>
                <div class="birthday">
                    <p class="description">Birthday</p>
                    <p class="value">
                        {{ $person->getBirthday()->format('Y-d-m') }}
                    </p>
                </div>
                <div class="placeofbirth">
                    <p class="description">Place of Birth</p>
                    <p class="value">
                        @if ($person->getPlaceOfBirth())
                        {{ $person->getPlaceOfBirth() }}
                        @else
                        -
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-8 mt-5">
            <div class="col-12">
                <h2 class="text-primary">{{ $person->getName() }}</h2>
                <h5>Biography</h5>
                <p>{{ $person->getBiography() }}</p>
            </div>
            <div class="col-12 credits mt-5">
                <div class="card">
                    <ul class="nav nav-tabs nav-tabs-neutral justify-content-center" role="tablist" data-background-color="orange">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#movie" role="tab">Movie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tv" role="tab">TV</a>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="tab-content text-center">
                            <div class="tab-pane active" id="movie" role="tabpanel">
                                <table class="table table-striped person-table thead-inverse">
                                    <th colspan="4">ACTING</th>
                                    @foreach ($person->getMovieCredits()->getCast() as $cast)
                                    <tr>
                                        <td class="year">
                                            @if ($cast->getReleaseDate())
                                            {{ $cast->getReleaseDate()->format('Y') }}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td class="title">
                                            <a href="{{route('movie.show', $cast->getId())}}">
                                                {{ $cast->getTitle() }} 
                                                @if ($cast->getCharacter())
                                                <span> as {{ $cast->getCharacter() }}</span>
                                                @endif
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <th colspan="4">CREW</th>
                                    @foreach ($person->getMovieCredits()->getCrew() as $crew)
                                    <tr>
                                        <td class="year">@if ($crew->getReleaseDate())
                                            {{ $crew->getReleaseDate()->format('Y') }}
                                            @else
                                            -
                                        @endif</td>
                                        <td class="title">
                                         <a href="{{route('movie.show', $cast->getId())}}">
                                            {{ $crew->getTitle() }} 
                                            @if ($crew->getJob())
                                            <span>{{ $crew->getJob() }}</span>
                                            @endif
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="tab-pane" id="tv" role="tabpanel">
                            <table class="table table-striped person-table thead-inverse">
                                <th colspan="4">ACTING</th>
                                @foreach ($person->getTvCredits()->getCast() as $cast)
                                <tr>
                                    <td class="year">{{ explode('-',$cast->getFirstAirDate())[0] }}</td>
                                    <td class="title">
                                        <a href="{{ route('tv.show', $cast->getId()) }}">{{ $cast->getName() }} 
                                            @if ($cast->getEpisodeCount())
                                            <span> ({{ $cast->getEpisodeCount() }} episodes)</span>
                                            @endif
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                <th colspan="4">CREW</th>
                                @foreach ($person->getTvCredits()->getCrew() as $crew)
                                <tr>
                                    <td class="year">{{ explode('-',$crew->getFirstAirDate())[0] }}</td>
                                    <td class="title">{{ $crew->getName() }} 
                                        @if ($crew->getJob())
                                        <span>{{ $crew->getJob() }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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