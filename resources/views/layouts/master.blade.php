<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="We are Maniak. Think of us as controlled kind of crazy with a deep passion for creative disruption." />

    <title>Maniak</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=VT323" rel="stylesheet">
    <link href="{{asset('css/site.css')}}" rel="stylesheet" type="text/css">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@maniakbtl">
    <meta name="twitter:title" content="Maniak">
    <meta name="twitter:description" content="We are Maniak. Think of us as controlled kind of crazy with a deep passion for creative interactions.">

    <!-- Twitter Summary card images must be at least 120x120px
    <meta name="twitter:image" content="http://www.example.com/image.jpg">-->

    <!-- Open Graph data -->
    <meta property="og:title" content="Maniak" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://www.maniak.co/" />
    <!-- <meta property="og:image" content="http://example.com/image.jpg" /> -->
    <meta property="og:description" content="We are Maniak. Think of us as controlled kind of crazy with a deep passion for creative interactions." />
    <meta property="og:site_name" content="Maniak" />
    <meta property="fb:admins" content="123698014336102" />

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
