<?php $isGEOPage = false; if(isset($category_id)) if($category_id == 1) $isGEOPage = true; if(Request::is('/')) $isGEOPage = true; ?>
<?php
//header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
//header("Content-Security-Policy: frame-ancestors 'none'");
//header("X-Content-Type-Options: nosniff");
//header("X-Frame-Options: SAMEORIGIN");
//header("Permissions-Policy: geolocation=(self \"https://finance.ru\"), microphone=()");
//header("Referrer-Policy: ");
?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="@yield('meta_description')"/>
{{--<?php--}}
{{--    if(isset($section_type)){--}}
{{--        $prevCanonical = response::getCanonicalPrev($section_type);--}}
{{--        if($prevCanonical!=null) {--}}
{{--?>--}}
{{--    <link rel="prev" href="{{$prevCanonical}}" />--}}
{{--    <?php }}?>--}}
{{--    <link rel="canonical" href="{{response::getCanonical()}}" />--}}
{{--<?php--}}
{{--    if(isset($section_type) && isset($pages)){--}}
{{--        $nextCanonical = response::getCanonicalNext($section_type,$pages);--}}
{{--        if($nextCanonical!=null) { ?>--}}
{{--<link rel="next" href="{{$nextCanonical}}" />--}}
{{--    <?php }}--}}
{{--?>--}}
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
        //include (public_path(). "/old_theme/css/modules/dark_mode_btn.css");
        if(!is_mobile_device()) {
            include (public_path(). "/old_theme/css/style-desc.css");
        } else {
            include (public_path(). "/old_theme/css/style-mob.css");
        }
        include (public_path(). '/old_theme/fonts/FuturaPT/FuturaPT.css');
        include (public_path(). '/old_theme/fonts/ProximaNova/ProximaNova.css');
        include (public_path(). '/old_theme/font-awesome-4.7.0/css/font-awesome.min.css');
        if (strstr($_SERVER['REQUEST_URI'],'insurance')) {
            include (public_path(). '/old_theme/css/insurance.css');
        }
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

<img loading="lazy" width="40" height="40" src="/old_theme/img/button-top.png" id="toTop" alt="Вверх">
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
        var script = document.createElement("script");
        script.src = url;
        document.head.appendChild(script);
    }
</script>

</body>
</html>