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
@foreach($categories as $category)
<h3>{{$category->category_name}}</h3>
<hr class="featurette-divider">
<div class="row">
    @foreach($projects as $project)
    @if($project->category_id == $category->id)
    <div class="col-sm-6 col-md-4 py-2">
        <div class="card h-100" style="width: 100%;">
            <img src="{{$project->cover_image_path}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$project->title}}</h5>
                <p class="card-text">{{$project->description}}</p>
                <a href="{{route('projects.detail', $project->id)}}" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
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