@extends('layout')


@section("title",'Project')

@section('content')
<div class="project_title">
    <div style="width: 80%;">
        <h1>{{$new->title}}</h1>
    </div>
    <a href="{{route('news.edit', $new->id)}}"><button class="btn btn-primary" type="submit">Edit
            News</button></a>
</div>

<!-- images  -->
<!-- images -->





<!-- Project Information -->
<div class="container">
    <!-- intro -->
    <h2>Intro</h2>
    <hr class="featurette-divider">
    <div class="row featurette">

        <div class="col-md-7">
            <p> {{$new->intro}}</p>
        </div>
    </div>

    <h2>Description</h2>
    <hr class="featurette-divider">
    <div class="row featurette">

        <div class="col-md-12">
            <p> {!!$new->description!!}</p>
        </div>

    </div>
</div>

<!-- Project Information End -->

@endsection