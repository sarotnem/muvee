@extends('layouts.app')
@section('title', 'Search Results');

@section('content')

<div class="main mt-5">
  <div class="container mb-5">
    <div class="row mt-5">
      <div class="col-12">
        <h2 class="mt-4">Search</h2>
        <h5>Showing results for "<strong>{{ $searchQuery }}</strong>"</h5>
        <h6>Page {{ $page }} of {{ $results->getTotalPages() }}</h6>
        <ul class="pagination pagination-primary mt-3 mb-3">
          @for ($i=1; $i<=$results->getTotalPages(); $i++)
          <li class="page-item
          @if ($page == $i)
          active
          @endif
          "><a class="page-link" href="{{ route('search') }}?query={{ $searchQuery }}&page={{ $i }}">{{ $i }}</a></li>
          @endfor
        </ul>
      </div>
    </div>
    @if ($results->getTotalResults() == 0)
    <div class="row">
      <div class="col-12 mt-5" style="height:100vh">
        <h3 class="text-center text-danger">No results have been found :'(</h3>
      </div>
    </div>
    @endif
    @foreach ($results as $result)
    <div class="row mt-3 search-result pb-3">
      @if ($result instanceof Tmdb\Model\Movie)
      <div class="col-2">
        <a href="{{ route('movie.show', $result->getId()) }}">
          @if($result->getPosterPath())
          <img src="https://image.tmdb.org/t/p/w130_and_h195_bestv2/{{ $result->getPosterPath() }}" alt="" class="rounded poster">
          @else
          <img src="/img/no-image-lg.jpg" alt="" class="rounded poster" width="130" height="195">
          @endif
        </a>
      </div>
      <div class="col-10">
        <h3 class="name mb-1">
          <a href="{{ route('movie.show', $result->getId()) }}">{{ $result->getTitle() }}</a>
          <small>({{ $result->getReleaseDate()->format('Y') }})</small>
        </h3>
        <h6 class="type">
         <i class="fa fa-film" aria-hidden="true"></i>
         <span>MOVIE</span>
         <i class="fa fa-star ml-4" aria-hidden="true"></i>
         <span>{{ $result->getVoteAverage() }}</span> 
       </h6>
       <p>{{ $result->getOverview() }}</p>
       <a class="btn btn-md btn-primary" href="{{ route('movie.show', $result->getId()) }}">
         More Info
       </a>
     </div>
     @elseif ($result instanceof Tmdb\Model\Tv)
     <div class="col-2">
      <a href="{{ route('tv.show', $result->getId()) }}">
        @if($result->getPosterPath())
        <img src="https://image.tmdb.org/t/p/w130_and_h195_bestv2/{{ $result->getPosterPath() }}" alt="" class="rounded poster">
        @else
        <img src="/img/no-image-lg.jpg" alt="" class="rounded poster" width="130" height="195">
        @endif
      </a>
    </div>
    <div class="col-10">
      <h3 class="name mb-1">
        <a href="{{ route('tv.show', $result->getId()) }}">{{ $result->getName() }}</a>
        <small>({{ $result->getFirstAirDate()->format('Y') }})</small>
      </h3>
      <h6 class="type">
       <i class="fa fa-television" aria-hidden="true"></i>
       <span>TV SHOW</span>
       <i class="fa fa-star ml-4" aria-hidden="true"></i>
       <span>{{ $result->getVoteAverage() }}</span> 
     </h6>
     <p>{{ $result->getOverview() }}</p>
     <a class="btn btn-md btn-primary" href="{{ route('tv.show', $result->getId()) }}">
       More Info
     </a>
   </div>
   @elseif ($result instanceof Tmdb\Model\Person)
   <div class="col-2">
    <a href="{{ route('people.show', $result->getId()) }}">
      @if($result->getProfilePath())
      <img src="https://image.tmdb.org/t/p/w130_and_h195_bestv2/{{ $result->getProfilePath() }}" alt="" class="rounded poster">
      @else
      <img src="/img/no-image-lg.jpg" alt="" class="rounded poster" width="130" height="195">
      @endif
    </a>
  </div>
  <div class="col-10">
    <h3 class="name mb-1">
      <a href="{{ route('people.show', $result->getId()) }}">{{ $result->getName() }}</a>
    </h3>
    <h6 class="type">
     <i class="fa fa-user" aria-hidden="true"></i>
     <span>PERSON</span>
   </h6>
   <a class="btn btn-md btn-primary" href="{{ route('people.show', $result->getId()) }}">
     More Info
   </a>
 </div>
 @endif 
</div>
@endforeach
<ul class="pagination pagination-primary mt-3 mb-3">
  @for ($i=1; $i<=$results->getTotalPages(); $i++)
  <li class="page-item
  @if ($page == $i)
  active
  @endif
  "><a class="page-link" href="{{ route('search') }}?query={{ $searchQuery }}&page={{ $i }}">{{ $i }}</a></li>
  @endfor
</ul>
</div>
</div>
@endsection

@section('javascripts')
<script type="text/javascript">

</script>
@endsection