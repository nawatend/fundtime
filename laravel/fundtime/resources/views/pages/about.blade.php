@extends('layout')


@section("title",'About')

@section('content')

<main role="main">

    <!-- Marketing messaging and featurettes
================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">
        <!-- START THE FEATURETTES -->
        <h1>About Fund Time</h1>
        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">Our community <span class="text-muted">It'll blow your
                        mind.</span></h2>
                <p>FundTime is an enormous global community built around creativity and creative
                    projects. Over 10 million people, from every continent on earth, have backed a FundTime project.
                    <br>
                    <br>
                    Some of those projects come from influential artists like De La Soul or Marina Abramović. Most come
                    from amazing creative people you probably haven’t heard of — from Grandma Pearl to indie filmmakers
                    to the band down the street.
                    <br>
                    <br>
                    Every artist, filmmaker, designer, developer, and creator on FundTime has complete creative
                    control over their work — and the opportunity to share it with a vibrant community of backers.</p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500"
                    style="width: 500px; height: 500px; object-fit: cover;" src="../images/about_community.jpg"
                    data-holder-rendered="true">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading">Our mission <span class="text-muted">See for
                        yourself.</span></h2>
                <p>We built FundTime to help bring creative projects to life. We measure our success as
                    a company by how well we achieve that mission, not by the size of our profits. That’s why, in 2015,
                    we became a Benefit Corporation. Benefit Corporations are for-profit companies that are obligated to
                    consider the impact of their decisions on society, not only shareholders. Radically, positive impact
                    on society becomes part of a Benefit Corporation’s legally defined goals.</p>
                <p>
                    When we became a Benefit Corporation, we amended our corporate charter to lay out specific goals and
                    commitments to arts and culture, making our values core to our operations, fighting inequality, and
                    helping creative projects come to life. You can read our commitments in full below.</p>
            </div>
            <div class="col-md-5 order-md-1">
                <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500"
                    src="../images/about_mission.jpg" data-holder-rendered="true"
                    style="width: 500px; height: 500px;object-fit: cover;">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Our team.</span></h2>
                <p>We're an independent, founder-controlled company of 154 people working together in an
                    old pencil factory in New York City. We spend our time designing and building FundTime,
                    connecting people around inspiring creative projects, and having a lot of fun doing it.
                    <br> <br>
                    We’re developers, designers, support specialists, writers, musicians, painters, poets, gamers,
                    robot-builders — you name it. Between us, we’ve backed more than 34,000 projects (and launched
                    plenty of our own).</p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500"
                    src="../images/about_team.jpg" data-holder-rendered="true"
                    style="width: 500px; height: 500px; object-fit: cover;">
            </div>
        </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->


    <!-- FOOTER -->
    <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>

    </footer>
</main>

@endsection