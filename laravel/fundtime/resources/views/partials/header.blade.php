<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-teal">
  <div class="container">
    <a class="navbar-brand" href="{{ route('pages.home') }}">Fund Time</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
      aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link active" href="{{ route('pages.home') }}">Home <span
            class="sr-only">(current)</span></a>
        <a class="nav-item nav-link" href="{{ route('news.index') }}">News</a>
        <a class="nav-item nav-link" href="{{ route('projects.index') }}">Projects</a>
        <a class="nav-item nav-link" href="{{ route('pages.about') }}">About</a>
        <a class="nav-item nav-link" href="{{ route('shop.index') }}">Buy F's</a>
      </div>
      <div class="navbar-nav">

        @if(Auth::check())
        <a class="nav-item nav-link" href="{{route('projects.myprojects')}}">My Projects</a>
        <a href="{{ route('shop.index') }}" class="badge badge-light">
          <button type="button" class="btn btn-light">
            <span class="badge">You have {{Auth::user()->credits}} F's</span>
          </button>
        </a>
        <a class="nav-item nav-link" href="{{route('home')}}">Logout</a>
        @else
        <a class="nav-item nav-link" href="{{route('home')}}">Login</a>
        <a class="nav-item nav-link" href="{{route('register')}}">Register</a>
        @endif
      </div>

    </div>
  </div>
</nav>