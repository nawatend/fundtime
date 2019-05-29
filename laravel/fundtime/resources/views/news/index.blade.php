@extends('layout')


@section("title",'News')

@section('content')
@if(Auth::check() && $currentUser->role == "admin")

<a href="{{route('news.create')}}"><button class="btn btn-primary" type="submit">New News</button></a>
@endif
<div class="row">
    <div class="col-12 mt-3">
        @foreach($news as $new)

        <a href="{{route('news.detail', $new->id)}}">
            <div class="card">
                <div class="card-horizontal">
                    <div class="img-square-wrapper">
                        <img class="" src="{{$new->image_path}}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{$new->title}}</h4>
                        <p class="card-text">{{$new->intro}}</p>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">{{$new->created_at}}</small>
                </div>
            </div>
        </a>
        <br>
        @endforeach

        {{$news->links()}}
    </div>
</div>
@endsection