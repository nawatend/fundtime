@extends('layout')


@section("title",'Projects')

@section('content')

<h1>Create New Project</h1>
<form action="{{ route('projects.save') }}" method="post" style="width:100%;" enctype="multipart/form-data">
    @csrf

    @if($errors->any())
    <div class="alert alert-danger">
        <strong>Son</strong>, Something went wrong.
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <label for="validationServer01">Project Title</label>
            <input type="text"
                class="form-control {{$errors->any() ? $errors->has('project_title') ? 'is-invalid': 'is-valid' : ''}}"
                id="validationServer01" placeholder="Type Project Title" name="project_title"
                value="{{old('project_title',$project->title)}}">

            @if ($errors->has('project_title'))
            <div class="invalid-feedback">
                Please provide a project title.
            </div>
            @else
            <div class="valid-feedback">
                Amazing!
            </div>
            @endif
        </div>

        <div class="col-md-4 mb-3">
            <label for="validationServer02">Target amount(EUR)</label>
            <input type="number"
                class="form-control {{$errors->any() ? $errors->has('project_target_amount') ? 'is-invalid': 'is-valid' : ''}}"
                min="0" id="validationServer02" placeholder="Target amount of money" name="project_target_amount"
                value="{{old('project_target_amount')}}">

            @if ($errors->has('project_target_amount'))
            <div class="invalid-feedback">
                Please provide a target amount.
            </div>
            @else
            <div class="valid-feedback">
                Amazing!
            </div>
            @endif
        </div>

        <div class="form-group col-md-4">
            <label for="inputState">Category</label>
            <select id="inputState" class="form-control" name='project_category'>
                <option value='1'>Sport</option>
                <option value='2'>Technology</option>
                <option value='3'>Non-profit</option>
                <option value='4'>Games</option>
                <option value='5'>Medical</option>
                <option value='6'>Environmental</option>
                <option value='7' selected>others</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-6">
            <label for="validationServer03">Start Date</label>
            <input type="text"
                class="form-control datepicker {{$errors->any() ? $errors->has('start_date') ? 'is-invalid': 'is-valid' : ''}}"
                id="validationServer03" name="start_date" placeholder="Start Date" value="{{old('start_date')}}">

            @if ($errors->has('start_date'))
            <div class="invalid-feedback">
                Please provide a start date.
            </div>
            @else
            <div class="valid-feedback">
                Amazing!
            </div>
            @endif
        </div>
        <div class="col-md-6 mb-6">
            <label for="validationServer04">End Date</label>
            <input type="text"
                class="form-control datepicker {{$errors->any() ? $errors->has('end_date') ? 'is-invalid': 'is-valid' : ''}}"
                id="validationServer04" placeholder="End Date" name="end_date" value="{{old('end_date')}}">

            @if ($errors->has('end_date'))
            <div class="invalid-feedback">
                Please provide a end date.
            </div>
            @else
            <div class="valid-feedback">
                Amazing!
            </div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">Project Description</label>
        <textarea
            class="form-control {{$errors->any() ? $errors->has('project_description') ? 'is-invalid': 'is-valid' : ''}}"
            id="exampleFormControlTextarea1" rows="6" name="project_description"
            value="{{old('project_description')}}">{{old('project_description')}}</textarea>
        @if ($errors->has('project_description'))
        <div class="invalid-feedback">
            Please provide a project description.
        </div>
        @else
        <div class="valid-feedback">
            Amazing!
        </div>
        @endif
    </div>

    <div class="custom-file ">
        <label for="validationServer41">
            <h3>Images</h3>
        </label>
        <div class="alert alert-info">
            <strong>Only file format: PNG, JPG, JPEG </strong>
        </div>
        <input type="file" id="customFile" name="images[]" multiple value="Upload Images"
            class="form-control {{$errors->any() ? $errors->has('images') ? 'is-invalid': 'is-valid' : ''}}">

        @if ($errors->has('images'))
        <div class="invalid-feedback">
            Please provide a image.
        </div>
        @else
        <div class="valid-feedback">
            Amazing!
        </div>
        @endif
        <br>
    </div>

    <div class="form-group pledges">
        <h3>Pledges</h3>
        <hr class="featurette-divider">
        <ul class="list-unstyled mt-3 mb-4">
            <li class="alert alert-info"> 1 euro = 10 F's</li>
        </ul>
        <div class="input-group bg-legendary myCard">
            <h6>Pledge Legendary</h6>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">F.</span>
                </div>
                <input type="number"
                    class="form-control  {{$errors->any() ? $errors->has('legendary_price') ? 'is-invalid': 'is-valid' : ''}}"
                    aria-label="Amount (to the nearest euro)" name="legendary_price" value="{{old('legendary_price')}}">
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
                @if ($errors->has('legendary_price'))
                <div class="invalid-feedback">
                    Please provide information about Legendary Price.
                </div>
                @else
                <div class="valid-feedback">
                    Amazing!
                </div>
                @endif
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Pledge Info</span>
                </div>
                <textarea
                    class="form-control {{$errors->any() ? $errors->has('legendary_info') ? 'is-invalid': 'is-valid' : ''}}"
                    name="legendary_info" value="{{old('legendary_info')}}">Free Gold</textarea>
                @if ($errors->has('legendary_info'))
                <div class="invalid-feedback">
                    Please provide information about Legendary Pledge.
                </div>
                @else
                <div class="valid-feedback">
                    Amazing!
                </div>
                @endif
            </div>
        </div>

        <div class="input-group bg-epic myCard">
            <h6>Pledge Epic</h6>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">F.</span>
                </div>
                <input type="number"
                    class="form-control {{$errors->any() ? $errors->has('epic_price') ? 'is-invalid': 'is-valid' : ''}}"
                    aria-label="Amount (to the nearest euro)" name="epic_price" value="{{old('epic_price')}}">
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
                @if ($errors->has('epic_price'))
                <div class="invalid-feedback">
                    Please provide information about Epic Price.
                </div>
                @else
                <div class="valid-feedback">
                    Amazing!
                </div>
                @endif
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Pledge Info</span>
                </div>
                <textarea
                    class="form-control {{$errors->any() ? $errors->has('epic_info') ? 'is-invalid': 'is-valid' : ''}}"
                    aria-label="With textarea" name="epic_info" value="{{old('epic_info')}}">Free Silver</textarea>
                @if ($errors->has('epic_info'))
                <div class="invalid-feedback">
                    Please provide information about Epic Pledge.
                </div>
                @else
                <div class="valid-feedback">
                    Amazing!
                </div>
                @endif
            </div>
        </div>

        <div class="input-group bg-rare myCard">
            <h6>Pledge Rare</h6>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">F.</span>
                </div>
                <input type="number"
                    class="form-control {{$errors->any() ? $errors->has('rare_price') ? 'is-invalid': 'is-valid' : ''}}"
                    aria-label="Amount (to the nearest euro)" name="rare_price" value="{{old('rare_price')}}">
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
                @if ($errors->has('rare_price'))
                <div class="invalid-feedback">
                    Please provide information about Rare Price.
                </div>
                @else
                <div class="valid-feedback">
                    Amazing!
                </div>
                @endif
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Pledge Info</span>
                </div>
                <textarea
                    class="form-control {{$errors->any() ? $errors->has('rare_info') ? 'is-invalid': 'is-valid' : ''}}"
                    aria-label="With textarea" name="rare_info" value="{{old('rare_info')}}">Free Bronse</textarea>
                @if ($errors->has('rare_info'))
                <div class="invalid-feedback">
                    Please provide information about Rare Pledge.
                </div>
                @else
                <div class="valid-feedback">
                    Amazing!
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck3" required>
            <label class="form-check-label " for="invalidCheck3">
                Agree to terms and conditions
            </label>

        </div>

    </div>



    <button class="btn btn-primary" type="submit">Submit form</button>
</form>

@endsection