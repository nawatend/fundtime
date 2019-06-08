<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body {
        font-family: "Montserrat", sans-serif;
    }

    :root {
        --blue: #085f63;
        --indigo: #6574cd;
        --purple: #9561e2;
        --pink: #f66D9b;
        --red: #ff5959;
        --orange: #f6993f;
        --yellow: #facf5a;
        --green: #38c172;
        --teal: #20c997;
        --cyan: #6cb2eb;
        --white: #fff;
        --gray: #6c757d;
        --gray-dark: #343a40;
        --primary: #085f63;
        --secondary: #6c757d;
        --success: #38c172;
        --info: #6cb2eb;
        --warning: #facf5a;
        --danger: #ff5959;
        --light: #f8f9fa;
        --dark: #343a40;
        --breakpoint-xs: 0;
        --breakpoint-sm: 576px;
        --breakpoint-md: 768px;
        --breakpoint-lg: 992px;
        --breakpoint-xl: 1200px;
        --font-family-sans-serif: "Montserrat", sans-serif;
        --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    }

    h1,
    h2,
    h3 {
        font-family: "Montserrat", sans-serif;
        text-transform: capitalize;
        width: 100%;
    }




    .container {
        width: 100%;
    }

    .progress {
        margin-top: 20px;

        width: 100%;
    }

    .progress-bar {
        height: 30px;

    }

    .bg-success {
        background-color: var(--green);
    }

    .bg-error {
        background-color: var(--red);
    }


    .project_title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .pledges-container {
        margin-top: 20px;
        width: 100%;
    }

    .card-deck {
        display: flex;
        justify-content: space-between;

    }

    .card {
        width: 30%;
    }

    .bg-legendary {
        background-color: #ffc15e !important;
        color: white;
    }

    .bg-epic {
        background-color: #8158fc !important;
        color: white;
    }

    .bg-rare {
        background-color: #207dff !important;
        color: white;
    }


    .body__content {
        margin-top: 80px !important;
        display: flex !important;
        flex-wrap: wrap !important;
        justify-content: space-between !important;
        padding: 30px !important;
    }

    .table {
        margin-left: 20px !important;
    }

    p {
        word-break: break-all !important;
        white-space: normal !important;
    }

    .bg-success {
        background-color: #2BBBAD !important;
    }

    .bg-error {
        background-color: #ff5959 !important;
    }

    .bg-teal {
        background-color: #2BBBAD !important;
    }

    .bg-g-teal {
        background-image: linear-gradient(to bottom right, #2BBBAD, #108178) !important;
        color: white;
    }

    .bg-g-legendary {
        background-image: linear-gradient(to right, #FFB75E, #ffc15e) !important;
        color: white;
    }

    .bg-g-epic {
        background-image: linear-gradient(to right, #8158fc, #926ffa) !important;
        color: white;
    }

    .bg-g-rare {
        background-image: linear-gradient(to right, #207dff, #2948ff) !important;
        color: white;
    }

    .bg-legendary {
        background-color: #ffc15e !important;
        color: white;
    }

    .bg-epic {
        background-color: #8158fc !important;
        color: white;
    }

    .bg-rare {
        background-color: #207dff !important;
        color: white;
    }

    .card-img-top {
        max-height: 350px;
        -o-object-fit: cover;
        object-fit: cover;
    }

    .myCard {
        padding-top: 10px;
        padding-bottom: 10px;
        border-radius: 3px;
        margin-top: 10px;
        padding: 10px;
    }

    .slide-image {
        -o-object-fit: cover !important;
        object-fit: cover !important;
        width: 100%;
        height: 550px;
    }

    .project_title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .pledges-container {
        margin-top: 20px;
        width: 100%;
    }

    .card-deck {
        width: 100%;
    }

    .card-deck .card {
        min-width: 220px;
    }

    .card-horizontal {
        display: flex;
        flex: 1 1 auto;
    }

    .card-horizontal img {
        height: 180px;
    }

    .text-bold {
        font-weight: bold;
    }


    .images {
        margin-top: 100px;

    }

    .images img {

        height: 200px;
        margin: 2px;

    }
</style>

<body>
    <div id="app" class="container body__content">
        <div style="width:100%;">
            <div class="project_title">
                <div style="width: 60%;">
                    <h1>{{$project->title}}</h1>
                </div>

            </div>


            <div class="">
                <div>
                    <h4>Goal: {{$project->target_amount}} F's</h4>
                    <h4>We Have: {{$project->funded_amount}} F's</h4>
                </div>
                <div>
                    <h5>End Date: {{$project->end_date}}</h5>
                </div>
            </div>

            <div>
                <h2>Images</h2>
            </div>
            <div class="images">

                @foreach ($images as $image)
                <img src="{{public_path('images/' . $image->image_path)}}" alt="">
                @endforeach
            </div>



            <!-- Pledges card info -->

            <div class="pledges-container">
                <h2>Pledges</h2>
                @foreach($pledges as $pledge)
                <div class="card-deck mb-3 text-center ">

                    <div class="card mb-4 box-shadow bg-{{$pledge->slug}}">
                        <form action="{{route('backers.save')}}" method="post">
                            @csrf
                            <div class="card-header bg-{{$pledge->slug}}">
                                <h4 class="my-0 font-weight-normal">{{$pledge->title}}</h4>
                            </div>
                            <div class="card-body ">
                                <h1 class="card-title pricing-card-title">{{$pledge->price}} F's</h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>{{$pledge->description}}</li>
                                </ul>
                            </div>
                        </form>
                    </div>

                </div>
                @endforeach
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
        </div>
    </div>


</body>

</html>