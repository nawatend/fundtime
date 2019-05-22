@extends('layout')


@section("title",'Projects')

@section('content')
<div class="project_title">
    <div style="width: 80%;">
        <h1>{{$project->title}}</h1>
    </div>
    <a href="{{route('projects.edit', $project->id)}}"><button class="btn btn-primary" type="submit">Edit
            Project</button></a>
</div>

<!-- images slider -->
<div id="carouselExampleIndicators" class="carousel slide" style="width: 100%;" data-ride="carousel">
    <ol class="carousel-indicators">
        @php ($i = 0)
        @foreach($images as $image)

        <li data-target="#carouselExampleIndicators" data-slide-to={{$i}} class="active"></li>
        @php ($i += 1)
        @endforeach
        <li data-target="#carouselExampleIndicators" data-slide-to={{$i}} class="active"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100 slide-image" src="../../images/blur.png" alt="First slide">
        </div>
        @foreach($images as $image)
        <div class="carousel-item">
            <img class="d-block w-100 slide-image" src="../../images/{{$image->image_path}}" alt="First slide">
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- images slider end-->



<!-- Pledges card info -->
<div class="pledges-container">
    <div class="card-deck mb-3 text-center">

        @foreach($pledges as $pledge)

        <div class="card mb-4 box-shadow">
            <form action="{{route('projects.savefund')}}" method="post">
                @csrf

                <input type="hidden" name="pledge_id" value="{{ $pledge->id }}" />
                <input type="hidden" name="project_id" value="{{ $project->id }}" />
                <input type="hidden" name="project_user_id" value="{{ $project->user_id }}" />

                @if(Auth::check())
                <input type="hidden" name="user_id" value="{{ $user->id }}" />
                @endif
                <div class="card-header bg-{{$pledge->slug}}">
                    <h4 class="my-0 font-weight-normal">{{$pledge->title}}</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">{{$pledge->price}} F's</h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>{{$pledge->description}}</li>

                    </ul>
                    @if(Auth::check())
                    @if($project->user_id == $user->id)
                    <ul class="list-unstyled mt-3 mb-4">
                        <li class="alert alert-danger">You can't fund yourself!</li>
                    </ul>
                    @endif
                    @if($project->user_id == $user->id)
                    <button type="submit" class="btn btn-lg btn-block btn-outline-secondary" disabled>Fund it</button>
                    @else
                    <button type="submit" class="btn btn-lg btn-block btn-outline-primary">Fund it</button>
                    @endif

                    @else
                    <ul class="list-unstyled mt-3 mb-4">
                        <li class="alert alert-info">Login To Fund This Project</li>
                    </ul>
                    <button type="submit" class="btn btn-lg btn-block btn-outline-secondary" disabled>Fund it</button>
                    @endif
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
<!-- Pledges card info END-->

<!-- Project Information -->



<!-- Project Information End -->

@endsection