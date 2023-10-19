<div class="container">
    <div class="logo-head-wrap">
        @if(Request::is('/'))
            <img loading="lazy" width="48" height="48" src="/src" alt="Finance.ru" title="#Finance.ru"><span>#Finance.ru</span>
        @else
            <a href="/"><img loading="lazy" width="48" height="48" src="/src" alt="Finance.ru" title="#Finance.ru"><span>#Finance.ru</span></a>
        @endif
    </div>

    @if(is_mobile_device())
        @include('site.v3.modules.includes.menu.mob-header')
    @endif
</div>
