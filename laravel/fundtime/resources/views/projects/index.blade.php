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
<div class="row">
    @foreach($projects as $project)
    <div class="col-sm-6 col-md-4 py-2">
        <div class="card h-100" style="width: 100%;">
            <img src="{{asset($project->cover_image_path)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$project->title}}</h5>
                <p class="card-text">{{$project->intro}}</p>
                <a href="{{route('projects.detail', $project->id)}}" class="btn btn-primary">View Project</a>
            </div>
        </div>
    </div>

    @endforeach
</div>



@endsection