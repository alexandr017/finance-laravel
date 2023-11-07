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
@yield('additional-styles2')
</head>
<body>
<header class="second_header">
    @if(is_mobile_device())
        @include('site.v3.modules.includes.header-mob')
    @else
        @include('site.v3.modules.includes.header-pc')
    @endif
</header>
<div class="search-form-js">
    <div class="container search-wrap-form">
        <div class="wrapper">
            <form action="/search" method="POST">
                <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                <input id="searchInputBySiteJs" type="text" name="s" placeholder="Введите запрос, например Тинькофф" value="" autocomplete="off">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <ul id="search-hint"></ul>
    </div>
</div>

@if(Request::is('/'))
@include('site.v3.modules.includes.first-section')
@endif
@yield('cities-first-section')


@yield('content')

<footer class="container">

    @if(!is_mobile_device())
    @if(Request::url() != 'https://finance.ru/contacts' && Request::url() != 'https://finance.ru/loans')
    <div class="row contacts-l-wrap contacts-content">
        <div class="col-sm-12">
            <span class="clw-title">Служба поддержки</span>
            <p>Есть вопрос по выбору микрозайма, займа под залог или другого финансового продукта? Наши консультанты окажут быструю и квалифицированную помощь по удобному для вас способу связи.</p>
            <div class="row">
                <div class="col-sm-6">
                    <span class="fcg">Способы связи:</span>
                    <p class="itcs"><i class="fa fa-clock-o"></i><button data-toggle="modal" data-target="#callMe">Заказать обратный звонок</button></p>
                    <p class="itcs"><i class="fa fa-envelope-o"></i><a rel="nofollow" href="mailto:vzo@vsezaimyonline.ru">vzo@vsezaimyonline.ru</a></p>
                    <p class="itcs"><i class="fa fa-telegram"></i> <a href="https://t.me/vsezaimyonline" target="_blank" rel="nofollow">@vsezaimyonline</a></p>
                    <p class="itcs"><i class="fa fa-whatsapp"></i> <a href="https://wa.me/79951016228" target="_blank" rel="nofollow">8 (995) 101-62-28</a></p>
                </div>
                <div class="col-sm-6">
                    <span  class="fcg">Горячая линия</span>
                    <p>Бесплатный номер телефона по России:</p>
                    <p class="phone"><i class="fa fa-phone"></i> <a href="tel:88007073397">8 (800) 707-33-97</a></p>
                </div>
            </div>
        </div>
        <?php /*
        <div class="col-sm-4">
            <div class="img-wrap">
                <img loading="lazy" src="/images/natalja-potemkina.png" alt="Специалист службы поддержки ВЗО">
                <span class="wcx5">Наталья<br>специалист службы поддержки</span>
            </div>
        </div>
        */ ?>
    </div>
    @endif


        @include('site.v3.modules.includes.menu.pc-footer-group-menu')
    @endif

    <div class="contacts-content">
        <div class="footer-flex-block fbl row">

            <div class="social-media-icon">
                <label class="footer-social-media-label">Соцсети:</label>
                <div class="icons">
                    <a href="https://vk.com/vsezaimyonline" rel="nofollow" target="_blank"><img loading="lazy" width="34" height="34" src="/old_theme/img/social_icon/vk.png" alt="VK"></a>
                    <a href="https://www.facebook.com/vsezaimyonline/" rel="nofollow" target="_blank"><img loading="lazy" width="34" height="34" src="/old_theme/img/social_icon/fb.png" alt="FB"></a>
                    <a href="https://ok.ru/vsezaimyonline" rel="nofollow" target="_blank"><img loading="lazy" width="34" height="34" src="/old_theme/img/social_icon/ok.png" alt="OK"></a>
                    <a href="https://t.me/vzoru" rel="nofollow" target="_blank"><img loading="lazy" width="34" height="34" src="/old_theme/img/social_icon/telegram.png" alt="telegram"></a>
                    <a href="https://twitter.com/vsezaimyonline" rel="nofollow" target="_blank"><img loading="lazy" width="34" height="34" src="/old_theme/img/social_icon/twitter.png" alt="twitter"></a>
                    <a href="https://www.pinterest.ru/vsezaimyonline" rel="nofollow" target="_blank"><img loading="lazy" width="34" height="34" src="/old_theme/img/social_icon/pinterest.png" alt="pinterest"></a>
                    <a href="https://zen.yandex.ru/vsezaimyonline" rel="nofollow" target="_blank"><img class="new-footer-sm-img" loading="lazy" width="34" height="34" src="/old_theme/img/social_icon/new-zen.png" alt="yandex zen"></a>
                    <a href="https://www.youtube.com/channel/UCaEfgVCVioDGWdbmLnKC3Qg" rel="nofollow" target="_blank"><img class="new-footer-sm-img" loading="lazy" width="34" height="34" src="/old_theme/img/social_icon/youtube.png" alt="youtube"></a>
                </div>
            </div>

            <div class="new-footer-form-unisender">
                <p class="new-footer-unisender-text">Подпишитесь на нашу рассылку и вы бесплатно получите 8 лайфхаков о кредитах и займах от нашего эксперта. Как выбирать, как отказаться от навязываемых услуг и другая полезная информация!</p>
                <form id="subscription_form" class="text-center align-items-center" method="POST" action="#">
                    <div class="form-line form-group">
                        <span class="relative"><input name="subscription_email" id="subscription_email" type="email" placeholder="Email" required></span> <button id="ajax_form_btn" type="submit" class="form-btn1">Подписаться</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="last-menu">
        <div class="row">
            <div class="col-md-12 d-md-block">
                @include('site.v3.modules.includes.menu.footer-last')
            </div>
        </div>
    </div>




    @if(!is_mobile_device())
    <div class="copyright">
        <p>Предложение не является офертой. Конечные условия уточняйте при прямом общении с кредиторами.
            Содержание информационных статей основано на субъективном мнении редакции нашего сайта.
            Мы не несем ответственность за полноту и достоверность содержащейся в них информации.
            Сайт не принадлежит финансовой организации и на нем не оказываются финансовые услуги.
            Финансовые услуги будут оказываться непосредственно организациями,
            имеющими разрешение Центрального Банка Российской Федерации.<br>
            Сайт является составным произведением и представляет собой в том числе каталог товарных знаков
            (знаков обслуживания), опубликованных в открытых реестрах ФИПС (Роспатент).
            Исключительное право на товарные знаки (знаки обслуживания) принадлежат их правообладателям.
        </p>
    </div>
    @endif

</footer>

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
@if(Auth::id() == 92879 || Auth::id() == 12467 || Auth::id() == 30154 || Auth::id() == 110510)
    <script src="/old_theme/js/modules/accordeonAndTabs/accordeonJs.js" defer></script>
    <script src="/old_theme/js/modules/accordeonAndTabs/horizontalTabs.js" defer></script>
@endif
<?php /*
@if(isset($GLOBALS['shortCodeSlider']))
    @include('short_codes.slick_slider.js')
@endif
 */ ?>

<?php /*
<script src="/old_theme/js/slick.js" defer></script>
 */
?>
<script src="/old_theme/js/card-beta.js?v=5"></script>





<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "url": "https://finance.ru",
  "logo": "https://finance.ru/old_theme/img/logo_vzo.png",
  "name": "ФинансРу",
  "contactPoint": [{
    "@type": "ContactPoint",
    "telephone": "+8-800-707-33-97",
    "contactType": "customer service"
  }]
  @if( !isset($GLOBALS['issetStructuredProduct']))
  ,"aggregateRating": {
    "@type": "AggregateRating",
    "bestRating" : 5,
    "ratingValue": "1",
    "reviewCount": "1"
  }
  @endif
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "#ФинансыРу",
  "url": "https://finance.ru",
  "sameAs": [
    "https://vk.com/vsezaimyonline",
    "https://ok.ru/vsezaimyonline",
    "https://www.youtube.com/channel/UCaEfgVCVioDGWdbmLnKC3Qg",
    "https://zen.yandex.ru/vsezaimyonline"
  ]
}
</script>
@if(Request::is('/'))
<script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "VideoObject",
"name": "Что такое микрозайм?",
"description": "В этом обучающем видео мы рассмотрим вопрос в целом, поговорим о том, как правильно говорить - 'займ' или 'заем', рассмотрим статистику целей микрокредитов и другие вопросы.",
"thumbnailUrl": [
"https://i.ytimg.com/vi/2RK3vQZPwoI/hqdefault.jpg"
],
"uploadDate": "2017-03-15T08:23:10.000Z",
"duration": "PT5M12S",
"contentUrl": "https://youtube.googleapis.com/v/2RK3vQZPwoI",
"embedUrl": "https://youtube.googleapis.com/v/2RK3vQZPwoI",
"interactionCount": "2729"
}
</script>
@endif


@if(isset($breadcrumbs))
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
    <?php $breadcrumbCounter = 1; ?>
        @foreach($breadcrumbs as $key => $breadcrumb)
        @if($breadcrumbCounter != 1)
        @if (count($breadcrumbs)-1),@endif
        @endif
        {
            "@type": "ListItem",
            "position": {{$breadcrumbCounter}},
            "name": @if(isset($breadcrumb['h1'])) "{{$breadcrumb['h1']}}" @else "" @endif,
            @if ($key != (count($breadcrumbs)-1))
                "item": @if(isset($breadcrumb['link'])) "https://finance.ru{{$breadcrumb['link']}}" @else "" @endif
            @else
                "item": "{{Request::url()}}"
            @endif
        }
        <?php $breadcrumbCounter++; ?>
        @endforeach
    ]
}
</script>
@endif


<?php $FAQPageCounter = 1; ?>
@if(isset($GLOBALS['FAQPage']))
<script type="application/ld+json">
{
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
        @foreach($GLOBALS['FAQPage'] as $FAQPageItem)
            <?php
                $FAQcontent = str_replace('<p>','',$FAQPageItem['text']);
                $FAQcontent = str_replace('</p>','',$FAQcontent);
                $FAQcontent = str_replace('<ul>','',$FAQcontent);
                $FAQcontent = str_replace('</ul>','',$FAQcontent);
                $FAQcontent = str_replace('<li>','',$FAQcontent);
                $FAQcontent = str_replace('</li>','. ',$FAQcontent);
                $FAQcontent = str_replace(["\r\n", "\r", "\n"],'',$FAQcontent);
                $FAQcontent = trim($FAQcontent);
            ?>
        {
            "@type": "Question",
            "name": "{{str_replace('?','',$FAQPageItem['name'])}}",
           "acceptedAnswer": {
            "@type": "Answer",
            "text": "{{$FAQcontent}}"
           }
        }
        @if($FAQPageCounter!= count($GLOBALS['FAQPage'])) , @endif
            <?php $FAQPageCounter++; ?>
        @endforeach
        ]
}
</script>
@endif



@if(Auth::id() != null)
    <script>
        window.isAuth = true;
    </script>
@endif


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