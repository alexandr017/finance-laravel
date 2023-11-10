<div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="logo-head-wrap">
                @if(Request::is('/'))
                    <img width="180" height="60" src="/old_theme/img/logo.svg" alt="Finance.ru" title="Finance.ru">
                @else
                    <a href="/"><img width="180" height="60" src="/old_theme/img/logo.svg" alt="Finance.ru" title="Finance.ru"></a>
                @endif
            </div>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12">
            @if(!is_mobile_device())
                @include('site.v3.modules.includes.menu.pc-header-1')
            @endif
            <div class="menu menu-top desktop pull-right">
                @if(!is_mobile_device())
                    @include('site.v3.modules.includes.menu.pc-header-2')
                @endif
            </div>
        </div>

    </div>
</div>
