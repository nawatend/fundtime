@extends('layout')


@section("title",'Shop')

@section('content')
<h2>Be The Contributor Of Better Future</h2>
<div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Well done!</h4>
    <p>Aww yeah, you successfully puschased <span class='text-bold'>{{$total_f}}</span> F's. Now you have
        <span class='text-bold'>{{$total_user_f}} </span>F's.</p>
    <hr>
    <p class="mb-0">Now lets make the difference together.</p>
    <br>
    <a href="{{route('projects.index')}}"><button class="btn btn-success" type="submit">Explore Innovations</button></a>

</div>
<div style="max-height: 100px;">


</div>
@endsection