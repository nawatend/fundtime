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
@foreach($categories as $category)
<h3>{{$category->category_name}}</h3>
<hr class="featurette-divider">
<div class="row">
    @foreach($projects as $project)
    @if($project->category_id == $category->id)
    @if($project->user_id == $user->id)
    <div class="col-sm-6 col-md-4 py-2">
        <div class="card h-100" style="width: 100%;">
            <img src="{{$project->cover_image_path}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$project->title}}</h5>
                <p class="card-text">{{$project->intro}}</p>
                <a href="{{route('projects.detail', $project->id)}}" class="btn btn-primary">View Project</a>
                <a class=" btn btn-warning dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Promote
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('projects.promote',[$project->id, 1])}}">To Layer: 1</a>
                    <a class="dropdown-item" href="{{route('projects.promote',[$project->id, 2])}}">To Layer: 2</a>
                    <a class="dropdown-item" href="{{route('projects.promote',[$project->id, 3])}}">To Layer: 3</a>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endif
    @endforeach
</div>
@endforeach



<!-- <div class="card  d-flex" style="width: 100%;">
        <img src="{{ asset('images/test1.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                card's
                content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
    <div class="card" style="width: 100%;">
        <img src="../images/test3.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title a example text to build on the
                card
                tiexample text to build on the card tind make up the bulk of the card's
                content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
    <div class="card" style="width: 100%;">
        <img src="../images/test1.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                card's
                content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
    <div class="card" style="width: 100%;">
        <img src="../images/test3.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                card's
                content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div> -->



@endsection