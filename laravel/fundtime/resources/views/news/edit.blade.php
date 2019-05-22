@extends('layout')


@section("title",'News')

@section('content')

<h1>Create New News</h1>
<form action="{{ route('news.save') }}" method="post" style="width:100%;" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="col-md-4 mb-3">
            <label for="validationServer01">News Title</label>
            <input type="text" class="form-control is-valid" id="validationServer01" placeholder="News Title"
                value="Mark 55" required name="news_title">
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">News Description</label>
        <textarea class="form-control is-invalid" id="exampleFormControlTextarea1" rows="6"
            name="news_description"> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis nam at pariatur expedita, aspernatur aliquid. Perspiciatis suscipit tempore quaerat ducimus error tenetur vel quidem. Nihil esse consequatur sit quo temporibus?</textarea>
        <div class="invalid-feedback">
            Please provide a description.
        </div>
    </div>

    <div class="custom-file">
        <input type="file" id="customFile" name="news_image" multiple value="Upload Images">
        <br>
        *only file format: png, jpg, jpeg
    </div>

    <button class="btn btn-primary" type="submit">Submit News</button>
</form>



@endsection