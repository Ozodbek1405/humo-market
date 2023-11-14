<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HUMO MARKET | @yield('title')</title>
    @include('layouts.head-css')
    @stack('styles')
</head>
<body>
@include('components.navbar')
@yield('content')
@include('components.footer')

@include('layouts.head-script')
@stack('scripts')
</body>
</html>
