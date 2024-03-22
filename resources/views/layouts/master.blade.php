<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="humo market">
    <meta name="robots" content="noindex">
    <meta name="googlebot-news" content="noindex">
    <meta property="og:title" content="Humo market" />
    <meta property="og:description" content="Humo market ulgurji savdo" />
    <meta name="author" content="Ro`ziqulov Baxtiyor">
    <meta
        name="keywords"
        content="Ulgurji qulay savdo, hamyon bop narxlar, premium mijozlar istaklari asosida ishlab chiqarilgan online savdo platformasi, zamonaviy ayollar va erkaklar uchun eng yaxshi brendlarning kolleksiyalar to`plami"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title') | HUMO MARKET</title>

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
