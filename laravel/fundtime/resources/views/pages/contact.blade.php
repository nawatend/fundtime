@extends('layout')


@section("title",'Mail')

@section('content')

<form action="{{ route('mails.send')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="emailAddress">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            placeholder="Your E-mail Address" name="email_address">

    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Message</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"
            placeholder="Your Message"></textarea>
    </div>

    <button type="submit" class="btn btn-primary" name="send">Send mail</button>
</form>
@endsection