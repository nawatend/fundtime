@extends('layout')


@section("title",'Projects')

@section('content')
@if(Auth::check())
<a href="{{route('projects.create')}}"><button class="btn btn-primary" type="submit">New
        Project</button></a>

<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        Sort By Category
    </button>
    <div class="dropdown-menu">
        @foreach($categories as $category)
        <a class="dropdown-item"
            href="{{route('categories.index', $category->category_name)}}">{{ucfirst($category->category_name)}}</a>

        @endforeach
    </div>
</div>
@else
<h4>Do you have a Great Project To Show The World? <a href=" {{route('home')}}"><button class="btn btn-primary"
            type="submit">Log in here</button></a></h4>

@endif

<hr class="featurette-divider">
@if (Session::has('message'))
<div class="alert alert-danger">{{ Session::get('message') }}</div>
@endif
<div class="row">
    @if($projects->isEmpty())

    <div class="alert alert-info" role="alert">
        <h4 class="alert-heading">Oh Dear!</h4>
        <p>Son, nothing to see here! <span class='text-bold'></span>.
            <span class='text-bold'> Check out other category </span></p>
        <hr>
        <p class="mb-0">Shall we explore some other innovative projects?</p>
        <br>
        <a href="{{route('projects.index')}}"><button class="btn btn-success" type="submit">Explore
                Innovations</button></a>

    </div>
    @endif
    @foreach($projects as $project)
    <div class="col-sm-6 col-md-4 py-2">
        <div class="card h-100" style="width: 100%;">
            <img src="{{asset($project->cover_image_path)}}" class="o-card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$project->title}}</h5>
                <p class="card-text">{{$project->intro}}</p>
                <a href="{{route('projects.detail', $project->id)}}" class="btn btn-primary">View Project</a>

                @if(Auth::check() && Auth::user()->id == $project->user_id )
                <a class=" btn btn-warning dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Promote
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                    @if($project->layer == 0)
                    <a class="dropdown-item bg-g-legendary" href="{{route('projects.promote',[$project->id, 1])}}">To
                        Layer:
                        1 [700
                        F's for 7 Days]</a>
                    <a class="dropdown-item bg-g-epic" href="{{route('projects.promote',[$project->id, 2])}}">To Layer:
                        2 [500
                        F's for 7 Days]</a>
                    <a class="dropdown-item bg-g-rare" href="{{route('projects.promote',[$project->id, 3])}}">To Layer:
                        3 [300
                        F's for 7 Days]</a>
                    @endif

                    @if($project->layer != 0)
                    <a class="dropdown-item list-group-item-action list-group-item-success disabled"
                        href="{{route('projects.promote',[$project->id, 3])}}">Current Layer:
                        {{$project->layer}}</a>
                    <a class="dropdown-item list-group-item-action list-group-item-danger"
                        href="{{route('projects.promote',[$project->id, 0])}}">Stop
                        Promotion</a>
                    @endif

                </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>



@endsection