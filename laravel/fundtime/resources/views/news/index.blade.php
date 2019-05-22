@extends('layout')


@section("title",'News')

@section('content')
@if(Auth::check())
<a href="{{route('news.create')}}"><button class="btn btn-primary" type="submit">New News</button></a>
@endif
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-horizontal">
                <div class="img-square-wrapper">
                    <img class="" src="../images/skr.jpg" alt="Card image cap">
                </div>
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                        the
                        card's content.</p>
                </div>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
        <div class="card">
            <div class="card-horizontal">
                <div class="img-square-wrapper">
                    <img class="" src="../images/skr.jpg" alt="Card image cap">
                </div>
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                        the
                        card's content.</p>
                </div>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
    </div>
</div>
@endsection