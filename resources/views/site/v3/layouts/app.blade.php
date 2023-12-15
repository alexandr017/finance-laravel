<!DOCTYPE html>
<html prefix="og: https://ogp.me/ns#" lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="@yield('meta_description')"/>
    @if(isset($pagesCount) && $pagesCount != 1 && str_contains(Request::url(), '/page/'))
        <link rel="prev" href="{{getCanonicalPrev()}}">
    @endif
    <link rel="canonical" href="{{getCanonical()}}">
    @if(isset($pagesCount) && $pagesCount != 1)
        <link rel="next" href="{{getCanonicalNext($pagesCount)}}">
    @endif
    <meta property="og:locale" content="ru_RU" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('h1')" />
    <meta property="og:description" content="@yield('meta_description')" />
    <meta property="og:url" content="{{Request::url()}}" />
    <meta name="format-detection" content="telephone=no">
    <meta property="og:image" content="@yield('og_image', 'https://finance.ru/old_theme/img/logo_192x192.png')" />
    <meta property="og:site_name" content="#FinanceRU" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="@yield('meta_description')" />
    <meta name="twitter:title" content="@yield('h1')" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preload" href="/old_theme/fonts/ProximaNova/ProximaNova-Bold.woff" as="font" crossorigin="anonymous">
    <link rel="preload" href="/old_theme/fonts/FuturaPT/FuturaPT-Medium.woff" as="font" crossorigin="anonymous">
    <link rel="preload" href="/old_theme/fonts/ProximaNova/ProximaNova-Regular.woff" as="font" crossorigin="anonymous">
    <link rel="preload" href="/old_theme/fonts/ProximaNova/ProximaNova-RegularIt.woff" as="font" crossorigin="anonymous">
    <link rel="preload" href="/old_theme/fonts/FuturaPT/FuturaPT-Bold.woff" as="font" crossorigin="anonymous">
    <link rel="preload" href="/old_theme/font-awesome-4.7.0/fonts/fontawesome-webfont.woff2?v=4.7.0" as="font" crossorigin="anonymous">
    <style><?php
        ob_start("compress_css");
        include (public_path(). '/old_theme/css/vzo-bootstrap.css');
        include (public_path(). "/old_theme/css/style.css");
        if(!is_mobile_device()) {
            include (public_path(). "/old_theme/css/style-desc.css");
        } else {
            include (public_path(). "/old_theme/css/style-mob.css");
        }
        include (public_path(). '/old_theme/fonts/FuturaPT/FuturaPT.css');
        include (public_path(). '/old_theme/fonts/ProximaNova/ProximaNova.css');
        include (public_path(). '/old_theme/font-awesome-4.7.0/css/font-awesome.min.css');

        include(public_path() . '/old_theme/css/card-beta.css');
        include(public_path() . '/old_theme/css/modules/menu/menuJs.css');
        include(public_path() . '/old_theme/css/modules/search/search.css');
        include(public_path() . '/old_theme/css/modules/slider/js-slider.css');

        foreach ($GLOBALS['short_code_css'] as $short_code_style) {
            if(isset($GLOBALS['template'])) {
                $short_style = public_path().'/old_theme/css/short_codes/'.$short_code_style.'/'.$GLOBALS['template'].'.css';
                if(file_exists($short_style)){
                    include_once ($short_style);
                }
            }

        }
        ob_end_flush();
        ?></style>
    <style><?php
        ob_start("compress_css"); ?>
        @yield('compress-styles')
        <?php ob_end_flush(); ?></style>

    <link rel="icon" type="image/png" href="/old_theme/img/logo.svg" />
    <link rel="alternate" hreflang="ru" href="{{Request::url()}}">
@yield('additional-styles')
</head>
<body>
<header class="second_header">
    @if(is_mobile_device())
        @include('site.v3.modules.includes.header-mob')
    @else
        @include('site.v3.modules.includes.header-pc')
    @endif
</header>

@yield('content')

@include('site.v3.modules.includes.footer')

<img loading="lazy" style="width: 40px; height: 40px" src="/old_theme/img/button-top.png" id="toTop" alt="Вверх">
<script src="/old_theme/js/modules/slider/js-slider.min.js"></script>
<script src="/old_theme/js/js-for-sliders.js" defer></script>
<script src="/old_theme/js/jquery-3.2.1.min.js"></script>
<script defer src="/old_theme/js/scripts.js"></script>


    @yield('additional-scripts')
    @yield('listings-scripts')
    @include('site.v3.modules.includes.modal')

    <?php
    foreach ($GLOBALS['short_code_js'] as $short_code_script) {
        if(isset($GLOBALS['template'])) {
            $short_script = 'old_theme/js/short_codes/' . $short_code_script . '/' . $GLOBALS['template'] . '.js';
            if (file_exists($short_script)) {
                echo "<script src='/" . $short_script . "' async></script>";
            }
        }
    }
    ?>


<script src="/old_theme/js/modules/menu/menuJs.js" defer></script>
<script src="/old_theme/js/modules/search/search.js?v=1" defer></script>

<script src="/old_theme/js/card-beta.js?v=5"></script>

@include('site.structured-data.index')

<script>
    function dynamicallyLoadScript(url) {
        console.log(url);
        let script = document.createElement("script");
        script.src = url;
        document.head.appendChild(script);
    }
</script>

</body>
</html>