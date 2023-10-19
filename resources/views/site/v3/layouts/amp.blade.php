<?php
header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
header("Content-Security-Policy: frame-ancestors 'none'");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: SAMEORIGIN");
header("Permissions-Policy: geolocation=(self \"https://finance.ru\"), microphone=()");
header("Referrer-Policy: ");
?>
<!doctype html>
<html ⚡>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="@yield('meta_description'))"/>
    <?php
        $canonical = str_replace('/amp', '', Request::url());
        $canonical = preg_replace('/\/$/', '', $canonical);
        $canonical = str_replace('//', '/', $canonical);
        $canonical = str_replace(':/', '://', $canonical);
    ?>
    <link rel="canonical" href="{{$canonical}}" />
    <meta property="og:locale" content="ru_RU" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('h1')" />
    <meta property="og:description" content="@yield('meta_description')" />
    <meta property="og:url" content="{{Request::url()}}" />
    <meta property="og:site_name" content="#FinanceRU" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="@yield('meta_description')" />
    <meta name="twitter:title" content="@yield('h1')" />
    <link rel="icon" type="image/png" href="/old_theme/img/logo_finance.png" />

    <script src="https://cdn.ampproject.org/v0.js" async></script>
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
    <script async custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js"></script>
    <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.2.js"></script>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <style amp-custom>
        <?php
        ob_start("compress_css");
        include(public_path() . '/amp_theme/css/vzo.css');
        ob_end_flush();
        ?>
        <?php
        foreach ($GLOBALS['short_code_css'] as $short_code_style) {
            $short_style = public_path().'/old_theme/css/short_codes/'.$short_code_style.'/amp.css';
            if(file_exists($short_style)){
                include ($short_style);
            }
        }
        ?>
    </style>
   </head>
<body>
<header>
    <div class="container">
                <div class="logo-head-wrap">
                    <a href="/"><amp-img width="46" height="42" layout="fixed" src="/old_theme/img/logo.png" alt=""></amp-img><span>#FinanceRu</span></a>
                </div>
                <input type="checkbox" id="menu-checkbox" />
    <nav role="navigation"><!-- навигация -->
      <label for="menu-checkbox" class="toggle-button" data-open="Меню" data-close="Свернуть"></label>
        <?php
            /*
            $menu = response::getMenu(9);
            if($menu != null){
                $menu = json_decode($menu->code);

                echo "<ul class=\"main-menu\">";
                foreach ($menu as $key => $value) {
                    echo "<li>";
                    //dd($value);
                    if($value->target != 'default'){
                        if($value->title == 'javascript'){
                            echo "<a rel=\"".$value->target."\" href=\"javascript:window.location.href='".$value->href."'\">".$value->text."</a>";
                        } else {
                            echo "<a rel=\"".$value->target."\" href=\"".$value->href."\">".$value->text."</a>";
                        }
                    } else {
                        echo "<a href=\"".$value->href."\">".$value->text."</a>";
                    }
                    echo "<ul>";
                    if(isset($value->children)){
                    foreach ($value->children as $key2 => $value2) {
                        echo "<li>";
                        $children_menu_text = trim($value2->text);
                        if($children_menu_text == 'На карту' || $children_menu_text == 'Все МФО') $children_menu_text = '<span class="menu-green-background">' . $children_menu_text . '</span>';
                        if($value2->target != 'default'){
                            if($value2->title == 'javascript'){
                                echo "<a rel=\"".$value2->target."\" href=\"javascript:window.location.href='".$value2->href."'\">".$children_menu_text."</a>";
                            } else {
                                echo "<a rel=\"".$value2->target."\" href=\"".$value2->href."\">".$children_menu_text."</a>";
                            }
                        } else {
                            echo "<a href=\"".$value2->href."\">".$children_menu_text."</a>";
                        }
                        echo "</li>";
                    }
                    }
                    echo "</ul>";
                    echo "</li>";
                }
                echo "</ul>";
            }
            */
        ?>
        </nav>

    

    </div>

</header>

@yield('content')


<footer class="container text-center">
    <div class="f-support">
        <div class="f-support-label h5">Поддержка</div>
        <a href="tel:88007073397" class="f-support-phone">8 (800) 707-33-97</a>
        <span class="f-support-text small-font">Бесплатно по России</span>
    </div>
    <div class="f-icons-wrap">
        <a href="https://vk.com/vsezaimyonline" rel="nofollow" target="_blank" class="f-icon">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="39" height="39" rx="19.5" stroke="#EBEBEB"/>
                <path d="M27.07 20.8811C26.7374 20.4611 26.8326 20.2743 27.07 19.8989C27.0743 19.8946 29.8197 16.1009 30.1026 14.8143L30.1043 14.8134C30.2449 14.3446 30.1043 14 29.4246 14H27.1754C26.6029 14 26.3389 14.2957 26.1974 14.6266C26.1974 14.6266 25.0523 17.3677 23.4323 19.1446C22.9094 19.658 22.6677 19.8226 22.3823 19.8226C22.2417 19.8226 22.0231 19.658 22.0231 19.1891V14.8134C22.0231 14.2511 21.8629 14 21.3889 14H17.8523C17.4931 14 17.2797 14.2623 17.2797 14.5066C17.2797 15.0397 18.0897 15.1623 18.1737 16.6623V19.9169C18.1737 20.63 18.0443 20.7611 17.7571 20.7611C16.9926 20.7611 15.1369 18.0089 14.0371 14.8589C13.8151 14.2477 13.5983 14.0009 13.0214 14.0009H10.7714C10.1294 14.0009 10 14.2966 10 14.6274C10 15.212 10.7646 18.1186 13.5554 21.9586C15.4154 24.5797 18.0349 26 20.4177 26C21.85 26 22.0249 25.6846 22.0249 25.142C22.0249 22.6374 21.8954 22.4009 22.6129 22.4009C22.9454 22.4009 23.518 22.5654 24.8551 23.8297C26.3834 25.3289 26.6346 26 27.49 26H29.7391C30.3803 26 30.7051 25.6846 30.5183 25.0623C30.0906 23.7534 27.2003 21.0611 27.07 20.8811Z" fill="#87919F"/>
            </svg>
        </a>
        <a href="https://www.facebook.com/vsezaimyonline/" rel="nofollow" target="_blank" class="f-icon">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="39" height="39" rx="19.5" stroke="#EBEBEB"/>
                <path d="M22.54 14.6567H24.0007V12.1127C23.7487 12.078 22.882 12 21.8727 12C19.7667 12 18.324 13.3247 18.324 15.7593V18H16V20.844H18.324V28H21.1733V20.8447H23.4033L23.7573 18.0007H21.1727V16.0413C21.1733 15.2193 21.3947 14.6567 22.54 14.6567Z" fill="#87919F"/>
            </svg>
        </a>
        <a href="https://www.youtube.com/channel/UCaEfgVCVioDGWdbmLnKC3Qg" rel="nofollow" target="_blank" class="f-icon">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="39" height="39" rx="19.5" stroke="#EBEBEB"/>
                <path d="M29.5835 15.1907C29.353 14.334 28.6777 13.6588 27.8212 13.4281C26.2564 13 19.9975 13 19.9975 13C19.9975 13 13.7388 13 12.1741 13.4119C11.334 13.6423 10.6422 14.3342 10.4118 15.1907C10 16.7553 10 20 10 20C10 20 10 23.2611 10.4118 24.8093C10.6424 25.6658 11.3176 26.3411 12.1742 26.5718C13.7553 27 19.9977 27 19.9977 27C19.9977 27 26.2564 27 27.8212 26.5881C28.6778 26.3576 29.353 25.6823 29.5837 24.8258C29.9953 23.2611 29.9953 20.0165 29.9953 20.0165C29.9953 20.0165 30.0118 16.7553 29.5835 15.1907ZM18.0048 22.9976V17.0024L23.2094 20L18.0048 22.9976Z" fill="#87919F"/>
            </svg>
        </a>
        <a href="https://t.me/vzoru" rel="nofollow" target="_blank" class="f-icon">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="39" height="39" rx="19.5" stroke="#EBEBEB"/>
                <path d="M17.5337 22.5451L17.2161 27.0122C17.6705 27.0122 17.8673 26.817 18.1033 26.5827L20.2337 24.5467L24.6481 27.7794C25.4577 28.2306 26.0281 27.993 26.2465 27.0346L29.144 13.4571L29.1448 13.4563C29.4016 12.2595 28.712 11.7915 27.9232 12.0851L10.8913 18.6059C9.72894 19.0571 9.74654 19.7051 10.6937 19.9987L15.0481 21.3531L25.1625 15.0243C25.6385 14.7091 26.0713 14.8835 25.7153 15.1987L17.5337 22.5451Z" fill="#87919F"/>
            </svg>
        </a>

        <a href="https://zen.yandex.ru/vsezaimyonline" rel="nofollow" target="_blank" class="f-icon">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="39" height="39" rx="19.5" stroke="#EBEBEB"/>
                <path d="M23.5845 12H16.4153C13.9807 12 12 13.9808 12 16.4154V23.5846C12 26.0193 13.9807 28 16.4153 28H23.5845C26.0193 28 28 26.0192 28 23.5846V16.4154C28.0001 13.9808 26.0193 12 23.5845 12ZM26.5805 23.5846C26.5805 25.2365 25.2365 26.5804 23.5846 26.5804H16.4153C14.7635 26.5805 13.4196 25.2365 13.4196 23.5846V16.4154C13.4196 14.7636 14.7635 13.4196 16.4153 13.4196H23.5845C25.2364 13.4196 26.5804 14.7636 26.5804 16.4154V23.5846H26.5805Z" fill="#87919F"/>
                <path d="M19.9997 15.877C17.7264 15.877 15.877 17.7264 15.877 19.9997C15.877 22.273 17.7264 24.1224 19.9997 24.1224C22.2731 24.1224 24.1225 22.273 24.1225 19.9997C24.1225 17.7264 22.2731 15.877 19.9997 15.877ZM19.9997 22.7027C18.5093 22.7027 17.2966 21.4901 17.2966 19.9997C17.2966 18.5091 18.5092 17.2965 19.9997 17.2965C21.4903 17.2965 22.7029 18.5091 22.7029 19.9997C22.7029 21.4901 21.4902 22.7027 19.9997 22.7027Z" fill="#87919F"/>
                <path d="M24.2949 14.6738C24.0214 14.6738 23.7528 14.7846 23.5596 14.9786C23.3655 15.1716 23.2539 15.4404 23.2539 15.7149C23.2539 15.9885 23.3656 16.2572 23.5596 16.4512C23.7527 16.6442 24.0214 16.7559 24.2949 16.7559C24.5694 16.7559 24.8372 16.6442 25.0312 16.4512C25.2253 16.2572 25.336 15.9884 25.336 15.7149C25.336 15.4404 25.2253 15.1716 25.0312 14.9786C24.8382 14.7846 24.5694 14.6738 24.2949 14.6738Z" fill="#87919F"/>
            </svg>
        </a>
        <a href="https://ok.ru/vsezaimyonline" rel="nofollow" target="_blank" class="f-icon">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="39" height="39" rx="19.5" stroke="#EBEBEB"/>
                <path d="M19.9953 20.6586C22.3863 20.6586 24.3246 18.7203 24.3246 16.3293C24.3246 13.9383 22.3863 12 19.9953 12C17.6043 12 15.666 13.9383 15.666 16.3293C15.669 18.7191 17.6055 20.6556 19.9953 20.6586ZM19.9953 13.9981C21.2827 13.9981 22.3264 15.0418 22.3264 16.3293C22.3264 17.6168 21.2828 18.6605 19.9953 18.6605C18.7078 18.6605 17.6641 17.6168 17.6641 16.3293C17.6641 15.0418 18.7078 13.9981 19.9953 13.9981Z" fill="#87919F"/>
                <path d="M24.2361 22.7106C24.7066 22.4007 24.9901 21.8753 24.9908 21.3119C24.9973 20.8443 24.7335 20.415 24.3134 20.2096C23.8818 19.994 23.3652 20.0425 22.9813 20.3348C21.2022 21.6318 18.7893 21.6318 17.0102 20.3348C16.6258 20.0441 16.11 19.9956 15.6781 20.2096C15.2582 20.4149 14.9943 20.8438 15.0001 21.3112C15.0011 21.8745 15.2845 22.3997 15.7547 22.7099C16.358 23.1111 17.0151 23.425 17.7063 23.6424C17.8235 23.6788 17.9445 23.7125 18.0693 23.7436L16.0565 25.7118C15.5285 26.2241 15.5157 27.0674 16.028 27.5954C16.5403 28.1234 17.3836 28.1362 17.9117 27.6239C17.9226 27.6132 17.9334 27.6024 17.9441 27.5913L19.9955 25.468L22.0509 27.5953C22.5628 28.1237 23.4061 28.1372 23.9345 27.6253C24.4629 27.1134 24.4764 26.2701 23.9645 25.7417C23.9538 25.7306 23.9429 25.7198 23.9318 25.7091L21.9223 23.7429C22.0471 23.7109 22.1686 23.677 22.2867 23.641C22.9771 23.4245 23.6335 23.1113 24.2361 22.7106Z" fill="#87919F"/>
            </svg>

        </a>
        <a href="https://twitter.com/vsezaimyonline" rel="nofollow" target="_blank" class="f-icon">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="39" height="39" rx="19.5" stroke="#EBEBEB"/>
                <path d="M29.6923 13.8942C28.96 14.2154 28.1797 14.4283 27.3662 14.5317C28.2031 14.032 28.8418 13.2468 29.1422 12.3003C28.3618 12.7655 27.5003 13.0942 26.5822 13.2775C25.8412 12.4886 24.7852 12 23.6332 12C21.3982 12 19.5988 13.8142 19.5988 16.0382C19.5988 16.3582 19.6258 16.6658 19.6923 16.9588C16.336 16.7951 13.3662 15.1865 11.3711 12.736C11.0228 13.3403 10.8185 14.032 10.8185 14.7766C10.8185 16.1748 11.5385 17.4142 12.6117 18.1317C11.9631 18.1194 11.3268 17.9311 10.7877 17.6345C10.7877 17.6468 10.7877 17.6628 10.7877 17.6788C10.7877 19.6406 12.1871 21.2702 14.0222 21.6455C13.6935 21.7354 13.3354 21.7785 12.9637 21.7785C12.7052 21.7785 12.4443 21.7637 12.1994 21.7095C12.7225 23.3083 14.2068 24.4837 15.9717 24.5218C14.5982 25.5963 12.8542 26.2437 10.9662 26.2437C10.6351 26.2437 10.3175 26.2289 10 26.1883C11.7883 27.3415 13.9077 28 16.1932 28C23.6222 28 27.6837 21.8462 27.6837 16.512C27.6837 16.3335 27.6775 16.1612 27.6689 15.9902C28.4702 15.4215 29.1434 14.7114 29.6923 13.8942Z" fill="#87919F"/>
            </svg>
        </a>
        <a href="https://www.pinterest.ru/vsezaimyonline" rel="nofollow" target="_blank" class="f-icon">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="39" height="39" rx="19.5" stroke="#EBEBEB"/>
                <path d="M20.7174 12C16.3314 12.0007 14 14.8107 14 17.8748C14 19.2954 14.794 21.0681 16.0654 21.6301C16.428 21.7935 16.38 21.5941 16.692 20.4008C16.7167 20.3015 16.704 20.2154 16.624 20.1228C14.8067 18.0208 16.2694 13.6994 20.4581 13.6994C26.5202 13.6994 25.3875 22.0875 21.5128 22.0875C20.5141 22.0875 19.7701 21.3035 20.0054 20.3335C20.2908 19.1781 20.8494 17.9361 20.8494 17.1034C20.8494 15.0047 17.7227 15.316 17.7227 18.0968C17.7227 18.9561 18.0267 19.5361 18.0267 19.5361C18.0267 19.5361 17.0207 23.6002 16.834 24.3595C16.518 25.6449 16.8767 27.7256 16.908 27.9049C16.9274 28.0036 17.038 28.0349 17.1 27.9536C17.1994 27.8236 18.4154 26.0889 18.7561 24.8348C18.8801 24.3782 19.3887 22.5248 19.3887 22.5248C19.7241 23.1302 20.6908 23.6368 21.7208 23.6368C24.7848 23.6368 26.9995 20.9435 26.9995 17.6014C26.9889 14.3974 24.2468 12 20.7174 12V12Z" fill="#87919F"/>
            </svg>
        </a>
    </div>
    <p class="small-font">© ООО “Финансовые технологии”, 2016-2021</p>
</footer>


<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "url": "https://finance.ru",
  "logo": "https://finance.ru/old_theme/img/logo_vzo.png",
  "contactPoint": [{
    "@type": "ContactPoint",
    "telephone": "+8-800-707-33-97",
    "contactType": "customer service"
  }]
}
</script>

<amp-analytics type="googleanalytics">
<script type="application/json">
{
  "vars": {
    "account": "UA-61942078-36"
  },
  "triggers": {
    "trackPageview": {
      "on": "visible",
      "request": "pageview"
    }
  }
}
</script>
</amp-analytics>

<amp-analytics type="metrika">
<script type="application/json">
    {
        "vars": {
            "counterId": "38176370"
        },
        "triggers": {
            "someGoalReach": {
                "on": "click",
                "selector": ".offer",
                "request": "reachGoal",
                "vars": {
                    "goalId": "offer"
                }
            },
            "someGoalReach2": {
                "on": "click",
                "selector": ".rko",
                "request": "reachGoal",
                "vars": {
                    "goalId": "rko"
                }
            },
            "someGoalReach3": {
                "on": "click",
                "selector": ".zalogi",
                "request": "reachGoal",
                "vars": {
                    "goalId": "zalogi"
                }
            },
            "someGoalReach4": {
                "on": "click",
                "selector": ".creditonline",
                "request": "reachGoal",
                "vars": {
                    "goalId": "creditonline"
                }
            },
            "someGoalReach5": {
                "on": "click",
                "selector": ".credit",
                "request": "reachGoal",
                "vars": {
                    "goalId": "credit"
                }
            },
            "someGoalReach6": {
                "on": "click",
                "selector": ".debit",
                "request": "reachGoal",
                "vars": {
                    "goalId": "debit"
                }
            },
            "someGoalReach7": {
                "on": "click",
                "selector": ".company_link",
                "request": "reachGoal",
                "vars": {
                    "goalId": "offer"
                }
            },
            "someGoalReach8": {
                "on": "click",
                "selector": ".zaim-hub",
                "request": "reachGoal",
                "vars": {
                    "goalId": "zaim-hub"
                }
            },
            "someGoalReach9": {
                "on": "click",
                "selector": ".offer-in-rating",
                "request": "reachGoal",
                "vars": {
                    "goalId": "offer-in-rating"
                }
            },
            "someGoalReach10": {
                "on": "click",
                "selector": ".clickrew",
                "request": "reachGoal",
                "vars": {
                    "goalId": "clickrew"
                }
            },
            "someGoalReach11": {
                "on": "click",
                "selector": ".clickrewooo",
                "request": "reachGoal",
                "vars": {
                    "goalId": "clickrewooo"
                }
            },
            "someGoalReach12": {
                "on": "click",
                "selector": ".zaim-reviews",
                "request": "reachGoal",
                "vars": {
                    "goalId": "zaim-reviews"
                }
            },
            "someGoalReach13": {
                "on": "click",
                "selector": ".long-offer",
                "request": "reachGoal",
                "vars": {
                    "goalId": "long-offer"
                }
            },
            "someGoalReach14": {
                "on": "click",
                "selector": ".avtocredit",
                "request": "reachGoal",
                "vars": {
                    "goalId": "avtocredit"
                }
            },
            "someGoalReach15": {
                "on": "click",
                "selector": ".vc",
                "request": "reachGoal",
                "vars": {
                    "goalId": "vc"
                }
            },
            "someGoalReach16": {
                "on": "click",
                "selector": ".ipoteka",
                "request": "reachGoal",
                "vars": {
                    "goalId": "ipoteka"
                }
            }


        }
    }



</script>
</amp-analytics>

</body>
</html>
