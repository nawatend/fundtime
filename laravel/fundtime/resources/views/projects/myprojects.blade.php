@extends('layout')


@section("title",'Projects')

@section('content')
@if(Auth::check())
<a href="{{route('projects.create')}}"><button class="btn btn-primary" type="submit">Create New
        Project</button></a>
@else
<h4>Do you have a Great Project To Show The World? <a href="{{route('home')}}"><button class="btn btn-primary"
            type="submit">Log in here</button></a></h4>
@endif

<h1>My Projects</h1>

@if (Session::has('message'))
<div class="alert alert-danger">{{ Session::get('message') }}</div>
@endif

@foreach($categories as $category)
<h3>{{$category->category_name}}</h3>
<hr class="featurette-divider">
<div class="row">
    @foreach($projects as $project)
    @if($project->category_id == $category->id)
    @if($project->user_id == $user->id)
    <div class="col-sm-6 col-md-4 py-2">
        <div class="card h-100" style="width: 100%;">
            <img src="{{$project->cover_image_path}}" class="o-card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$project->title}}</h5>
                <p class="card-text">{{$project->intro}}</p>
                <a href="{{route('projects.detail', $project->id)}}" class="btn btn-primary">View Project</a>
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
            </div>
        </div>
    </div>
    @endif
    @endif
    @endforeach
</div>
@endforeach
@endsection