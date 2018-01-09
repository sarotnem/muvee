<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-primary ">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="/" data-placement="bottom">
                Muvee
            </a>
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="./assets/img/blurred-image-1.jpg">
            <ul class="navbar-nav">
                <li class="nav-item">
                 <div class="form-group search-form">
                    <form action="{{ route('search') }}" method="GET" autocomplete="off">
                       <input type="text" value="" placeholder="Search" class="form-control" name="query" id="search"> 
                       <input type="hidden" value="1" name="page" id="page"> 
                    </form>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('my.movies') }}">
                    <p>MY MOVIES</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('my.tv') }}">
                    <p>MY SERIES</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-neutral" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</div>
</div>
</nav>
    <!-- End Navbar -->