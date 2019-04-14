<!DOCTYPE html>
<html data-whatinput="keyboard" data-whatintent="keyboard" class=" whatinput-types-initial whatinput-types-keyboard">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Fund Time')</title>
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/fundtime.css">
</head>

<body>

    @include('partials/header')

    <div id="app" class="container body__content">
        <div style="width:100%;">
            @yield('content')
        </div>

    </div>
    @include('partials/footer')


    
    @include('partials/scripts')
</body>


</html>