<div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="logo-head-wrap">
                @if(Request::is('/'))
                    <img loading="lazy" width="48" height="48" src=/old_theme/img/logo.png" alt="Finance.ru" title="Finance.ru"><span>#Finance.ru</span>
                @else
                    <a href="/"><img loading="lazy" width="48" height="48" src="/old_theme/img/logo.png" alt="Finance.ru" title="Finance.ru"><span>#Finance.ru</span></a>
                @endif
            </div>
        </div>
        <div class="col-lg-5 col-md-7 col-sm-12">
            @if(!is_mobile_device())
                @include('site.v3.modules.includes.menu.pc-header-1')
            @endif
        </div>
        <div class="col-lg-5 col-md-3 col-sm-12">
            <div class="menu menu-top desktop">
                @if(!is_mobile_device())
                    @include('site.v3.modules.includes.menu.pc-header-2')
                @endif
            </div>


        </div>
    </div>
</div>
