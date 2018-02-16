<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Maniak - Oh Yeah!</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=VT323" rel="stylesheet">
    <link href="{{asset('css/site.css')}}" rel="stylesheet" type="text/css">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#1c202a">
    <meta name="msapplication-TileColor" content="#b91d47">
    <meta name="theme-color" content="#1c202a">

    @include('partials.analytics')

</head>
<body>

    @yield('content')



    <script type="text/javascript" src="{{asset('js/site.js')}}"></script>
</body>
</html>
