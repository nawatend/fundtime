@extends('layout')


@section("title",'Projects')

@section('content')

<h1>Create New Project</h1>
<form style="width:100%;">

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <label for="validationServer01">Project Title</label>
            <input type="text" class="form-control is-valid" id="validationServer01" placeholder="Project Title"
                value="Mark 47" required name="project_title">
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationServer02">Target amount(EUR)</label>
            <input type="number" class="form-control is-valid" min="0" id="validationServer02"
                placeholder="Target amount of money" value="" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>

        <div class="form-group col-md-4">
            <label for="inputState">Category</label>
            <select id="inputState" class="form-control">
                <option>Sport</option>
                <option>Technology</option>
                <option>Non-profit</option>
                <option>Games</option>
                <option>Medical</option>
                <option>Environmental</option>
                <option selected>... </option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-6">
            <label for="validationServer03">Start Date</label>
            <input type="text" class="form-control is-invalid datepicker" id="validationServer03" name="start_date"
                placeholder="Start Date" required>

            <div class="invalid-feedback">
                Please provide a start date.
            </div>
        </div>
        <div class="col-md-6 mb-6">
            <label for="validationServer04">End Date</label>
            <input type="text" class="form-control is-invalid datepicker" id="validationServer04" placeholder="End Date"
                name="end_date" required>
            <div class="invalid-feedback">
                Please provide a End Date.
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">Project Description</label>
        <textarea class="form-control is-invalid" id="exampleFormControlTextarea1" rows="6"
            name="project_description"></textarea>
        <div class="invalid-feedback">
            Please provide a description.
        </div>
    </div>

    <div class="custom-file">
        <input type="file" class="custom-file-input" id="customFile">
        <label class="custom-file-label" for="customFile">Choose Images</label>
    </div>

    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" required>
            <label class="form-check-label" for="invalidCheck3">
                Agree to terms and conditions
            </label>
            <div class="invalid-feedback">
                You must agree before submitting.
            </div>
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Submit form</button>
</form>



@endsection