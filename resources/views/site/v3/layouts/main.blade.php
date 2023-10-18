<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>@yield('title', 'kursi.ru')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="@yield('meta_description', 'kursi.ru')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/v3/css/style.css">
    @yield('style')
    @stack('styles')
</head>
<body>
@include('site.v3.modules.1-header.1-header')
@yield('content')
@include('site.v3.modules.2-footer.2-footer')

@yield('additional-scripts')

@include('site.structured-data')
@yield('custom-structured-data')

@stack('scripts')
</body>
</html>
