<!DOCTYPE html>
<html data-whatinput="keyboard" data-whatintent="keyboard" class=" whatinput-types-initial whatinput-types-keyboard">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <title>@yield('title', 'Fund Time')</title>
    <link rel="stylesheet" href="../css/app.css">
    <!-- <script src="js/app.js"></script> -->
</head>

<body>

    <!-- Start Top Bar -->
    <div class="top-bar">
        <div class="row">
            <div class="top-bar-left">
                <ul class="dropdown menu" data-dropdown-menu="tckp8q-dropdown-menu" role="menubar">
                    <li role="menuitem"><a href="/">Home</a></li>
                    <li role="menuitem"><a href="/clients">Projects</a></li>
                    <li role="menuitem"><a href="/reservations">Profile</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Top Bar -->

    <br>


    @yield('content')

    <div class="row column">
        <hr>
        <ul class="menu">
            <li class="float-right">Copyright 2019</li>
        </ul>
    </div>

</body>

</html>