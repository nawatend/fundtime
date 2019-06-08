@extends('layout')


@section("title",'Home')

@section('content')

<!-- layer one start -->
<div class="o-layer bg-g-legendary d-flex justify-content-start align-items-center ">
    <h3 class="">Best Projects</h3>
</div>
<hr class="featurette-divider">
<div class="row">
    @foreach($projects as $project)
    @if($project->layer == 1)
    <div class="col-sm-12 col-md-12 py-2">
        <div class="card h-100" style="width: 100%;">
            <img src="{{asset($project->cover_image_path)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$project->title}}</h5>
                <p class="card-text">{{$project->intro}}</p>
                <a href="{{route('projects.detail', $project->id)}}" class="btn btn-primary">View Project</a>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
<!-- layer one end -->

<!-- layer two start -->
<div class="o-layer bg-g-epic d-flex justify-content-start align-items-center ">
    <h3 class="">Great Projects</h3>
</div>
<hr class="featurette-divider">
<div class="row">
    @foreach($projects as $project)
    @if($project->layer == 2)
    <div class="col-sm-12 col-md-6 py-2">
        <div class="card h-100" style="width: 100%;">
            <img src="{{asset($project->cover_image_path)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$project->title}}</h5>
                <p class="card-text">{{$project->intro}}</p>
                <a href="{{route('projects.detail', $project->id)}}" class="btn btn-primary">View Project</a>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
<!-- layer two end -->


<!-- layer 3 start -->
<div class="o-layer bg-g-rare d-flex justify-content-start align-items-center ">
    <h3 class="">Good Projects</h3>
</div>
<hr class="featurette-divider">
<div class="row">
    @foreach($projects as $project)
    @if($project->layer == 3)
    <div class="col-sm-12 col-md-4 py-2">
        <div class="card h-100" style="width: 100%;">
            <img src="{{asset($project->cover_image_path)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$project->title}}</h5>
                <p class="card-text">{{$project->intro}}</p>
                <a href="{{route('projects.detail', $project->id)}}" class="btn btn-primary">View Project</a>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
<!-- layer 3 end -->


@endsection