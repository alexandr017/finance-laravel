<div class="container">
    <div class="logo-head-wrap">
        @if(Request::is('/'))
            <img width="180" height="60" src="/old_theme/img/logo.svg" alt="Finance.ru" title="#Finance.ru">
        @else
            <a href="/"><img width="180" height="60" src="/old_theme/img/logo.svg" alt="Finance.ru" title="#Finance.ru"></a>
        @endif
    </div>

    @if(is_mobile_device())
        @include('site.v3.modules.includes.menu.mob-header')
    @endif
</div>
