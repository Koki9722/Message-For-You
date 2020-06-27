<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Message For You</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>
<body>

    @yield('content')
    <script type="text/javascript" src="{{ asset('js/jquery-3.5.0.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/script.js')}}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>