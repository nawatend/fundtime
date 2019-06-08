<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-g-teal ">
  <div class="container">
    <a class="o-navbar-brand" href="{{ route('pages.home') }}"> <img src="{{ asset('images/logo.png') }}" alt=""></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
      aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link @if(Route::is('pages.home')) active @endif" href="{{ route('pages.home') }}">Home
          <span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link @if(Route::is('news.index')) active @endif"
          href="{{ route('news.index') }}">News</a>
        <a class="nav-item nav-link @if(Route::is('projects.index')) active @endif"
          href="{{ route('projects.index') }}">Projects</a>
        <a class="nav-item nav-link @if(Route::is('pages.about')) active @endif"
          href="{{ route('pages.about') }}">About</a>
        <a class="nav-item nav-link @if(Route::is('shop.index')) active @endif" href="{{ route('shop.index') }}">Buy
          F's</a>
      </div>
      <div class="navbar-nav">

        @if(Auth::check())
        <a class="nav-item nav-link @if(Route::is('projects.myprojects')) active @endif"
          href="{{route('projects.myprojects')}}">My Projects</a>
        <a href="{{ route('shop.index') }}" class="badge badge-light">
          <button type="button" class="btn btn-light">
            <span class="badge">You have {{Auth::user()->credits}} F's</span>
          </button>
        </a>

        <a class="nav-item nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        @else
        <a class="nav-item nav-link" href="{{route('home')}}">Login</a>
        <a class="nav-item nav-link" href="{{route('register')}}">Register</a>
        @endif
      </div>

    </div>
  </div>
</nav>