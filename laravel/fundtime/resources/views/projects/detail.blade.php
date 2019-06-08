@extends('layout')


@section("title",'Project')

@section('content')
<div class="o-project_title">
    <div style="width: 60%;">
        <h1>{{$project->title}}</h1>
    </div>
    <div class="actions">
        <a href="{{route('generatePDF', $project->id)}}"><button class="btn btn-success" type="submit">Download
                PDF</button></a>
        @if(Auth::check())
        @if($project->user_id == $user->id || $user->role == 'admin' )

        <a href="{{route('projects.edit', $project->id)}}"><button class="btn btn-primary" type="submit">Edit
                Project</button></a>

        <a href="{{route('projects.delete', $project->id)}}"><button class="btn btn-danger" type="submit">Delete
            </button></a>
        @endif
        @endif
    </div>

</div>
@if (Session::has('message'))
<div class="alert alert-danger">{{ Session::get('message') }}</div>
@endif
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

<!-- Progress Bar start -->


<div class="">
    <div>
        <h4>Goal: {{$project->target_amount}} F's</h4>
    </div>
    <div>
        <h5>End Date: {{$project->end_date}}</h5>
    </div>
</div>

<div class="progress">
    <div class="progress-bar bg-success" role="progressbar" style="width: {{$funded_perc}}%"
        aria-valuenow="{{$funded_perc}}" aria-valuemin="0" aria-valuemax="100">{{$funded_perc}}%</div>
    <div class="progress-bar bg-error" role="progressbar" style="width: {{$not_funded_perc}}%"
        aria-valuenow="{{$not_funded_perc}}" aria-valuemin="0" aria-valuemax="100">{{$not_funded_perc}}%</div>
</div>
<!-- Progress Bar End -->

<!-- Pledges card info -->
<div class="pledges-container">

    @if (Session::has('message'))
    <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
    <div class="card-deck mb-3 text-center">

        @foreach($pledges as $pledge)
        <div class="card mb-4 box-shadow">
            <form action="{{route('backers.save')}}" method="post">
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
<div class="container">
    <!-- intro -->
    <h2>Intro</h2>
    <hr class="featurette-divider">
    <div class="row featurette">

        <div class="col-md-7">
            <p> {{$project->intro}}</p>
        </div>
    </div>

    <h2>Description</h2>
    <hr class="featurette-divider">
    <div class="row featurette">

        <div class="col-md-12">
            <p> {!!$project->description!!}</p>
        </div>

    </div>
</div>

<!-- Project Information End -->

<!-- Project Heros list -->

<div class="container">
    <h2>Our Backers</h2>
    <div class="row featurette">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Amount Of F's </th>

                </tr>
            </thead>
            <tbody>
                @php ($i = 1)
                @foreach($backers as $backer)
                @if($backer->project_id == $project->id)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$backer->name}}</td>
                    <td>{{$backer->price}}</td>
                </tr>
                @php ($i += 1)
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Project Heros list end -->



<div class="container">
    <h2>Comments</h2>
    @if(Auth::check())
    <form action="{{ route('comments.save') }}" method="post" style="width:100%;">
        @csrf
        <input type="hidden" name="project_id" value="{{ $project->id }}" />

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Message</label>
            <textarea
                class="form-control {{$errors->any() ? $errors->has('message') ? 'is-invalid': 'is-valid' : ''}} col-sm-12 col-md-8"
                rows="4" maxlength="400" name="message"> {{old('message',$comment->message) }}</textarea>

            @if ($errors->has('message'))
            <div class="invalid-feedback">
                Please provide a message.
            </div>
            @else
            <div class="valid-feedback">
                Amazing!
            </div>
            @endif
        </div>

        <button class="btn btn-primary" type="submit">send comment</button>
    </form>
    @endif
    <div class="comment row">
        <div class="col-sm-12 col-md-8 mt-3">
            @foreach($comments as $comment)
            <div class="card">
                <div class="o-card-horizontal">
                    <div class="card-body bg-g-teal">
                        <h4 class="card-title ">From: {{$comment->name}}</h4>
                        <p class="card-text">"{{$comment->message}}"</p>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">{{$comment->created_at}}</small>
                </div>
            </div>

            <br>
            @endforeach
            {{$comments->links()}}
        </div>

    </div>
</div>
@endsection