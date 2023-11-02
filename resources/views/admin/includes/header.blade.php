<header class="main-header">

    <a href="/" target="_blank" class="logo">
        <span class="logo-lg">vsezaimyonline.ru</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('labels.general.toggle_navigation') }}</span>
        </a>

        <div class="navbar-custom-menu">
{{--            <ul class="nav navbar-nav">--}}

{{--                @if($b_controller->checkByRoles(['SUPER_ADMINS','ADMINS']))--}}
{{--                    --}}
{{--                <?php $formCompanyAdd = response::getFormCompanyAdd(); ?>--}}
{{--                <li class="dropdown notifications-menu">--}}
{{--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Добавить организацию">--}}
{{--                        <i class="fa fa-window-maximize"></i>--}}
{{--                        <span class="label label-default" @if($formCompanyAdd>0) style="background:#f39c12" @endif>{{$formCompanyAdd}}</span>--}}
{{--                    </a>--}}

{{--                    <ul class="dropdown-menu">--}}
{{--                        <li class="header">@if($formCompanyAdd>0) Есть новые сообщения @else Новых сообщений нет @endif</li>--}}
{{--                        <li class="footer">--}}
{{--                            {{ link_to('/admin/forms/form_company_add', 'Перейти') }}--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li><!-- /.notifications-menu -->--}}

{{--                <?php $formAdvertising = response::getFormAdvertising(); ?>--}}
{{--                <li class="dropdown tasks-menu">--}}
{{--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Рекламное сотрудничество">--}}
{{--                        <i class="fa fa-window-restore"></i>--}}
{{--                        <span class="label label-default" @if($formAdvertising>0) style="background:#f39c12" @endif>{{$formAdvertising}}</span>--}}
{{--                    </a>--}}

{{--                    <ul class="dropdown-menu">--}}
{{--                        <li class="header">@if($formAdvertising>0) Есть новые сообщения @else Новых сообщений нет @endif</li>--}}
{{--                        <li class="footer">--}}
{{--                            {{ link_to('/admin/forms/form_advertising', 'Перейти') }}--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li><!-- /.tasks-menu -->--}}


{{--                <li class="tasks-menu"> <a>|</a> </li><!-- /.tasks-menu -->--}}
{{--                    <?php $mr = response::managersReviews(); ?>--}}
{{--                    <li class="dropdown tasks-menu">--}}
{{--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Отзывы представителей">--}}
{{--                            <i class="fa fa-comments-o"></i>--}}
{{--                            <span class="label label-default" @if($mr>0) style="background:#f39c12" @endif>{{$mr}}</span>--}}
{{--                        </a>--}}

{{--                        <ul class="dropdown-menu">--}}
{{--                            <li class="header">@if($mr>0) Есть новые сообщения @else Новых сообщений нет @endif</li>--}}
{{--                            <li class="footer">--}}
{{--                                {{ link_to('/admin/managers/reviews', 'Перейти') }}--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li><!-- /.tasks-menu -->--}}

{{--                    <?php $mt = response::managersTickets(); ?>--}}
{{--                    <li class="dropdown tasks-menu">--}}
{{--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Сообщения представителей">--}}
{{--                            <i class="fa fa-support"></i>--}}
{{--                            <span id="blink2" class="label label-default" @if($mt>0) style="background:#F44336;" @endif>{{$mt}}</span>--}}
{{--                        </a>--}}

{{--                        <ul class="dropdown-menu">--}}
{{--                            <li class="header">--}}
{{--                                @if($mt>0) Есть новые сообщения--}}
{{--                                <script>--}}
{{--                                    var audio = new Audio('/backend/speech_sleep.wav');--}}
{{--                                    audio.play();--}}
{{--                                </script>--}}
{{--                                @else Новых сообщений нет @endif--}}
{{--                            </li>--}}
{{--                            <li class="footer">--}}
{{--                                {{ link_to('/admin/managers/tickets', 'Перейти') }}--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li><!-- /.tasks-menu -->--}}


{{--                    <?php $mt = response::usersTickets(); ?>--}}
{{--                    <li class="dropdown tasks-menu">--}}
{{--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Сообщения пользователей">--}}
{{--                            <i class="fa fa-support"></i>--}}
{{--                            <span id="blink2" class="label label-default" @if($mt>0) style="background:#F44336;" @endif>{{$mt}}</span>--}}
{{--                        </a>--}}

{{--                        <ul class="dropdown-menu">--}}
{{--                            <li class="header">--}}
{{--                                @if($mt>0) Есть новые сообщения--}}
{{--                                <script>--}}
{{--                                    var audio = new Audio('/backend/speech_sleep.wav');--}}
{{--                                    audio.play();--}}
{{--                                </script>--}}
{{--                                @else Новых сообщений нет @endif--}}
{{--                            </li>--}}
{{--                            <li class="footer">--}}
{{--                                {{ link_to('/admin/users/appeals', 'Перейти') }}--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li><!-- /.tasks-menu -->--}}

{{--                    <?php $mt = response::guestTickets(); ?>--}}
{{--                    <li class="dropdown tasks-menu">--}}
{{--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Сообщения посетителей">--}}
{{--                            <i class="fa fa-envelope-open-o" ></i>--}}
{{--                            <span id="blink2" class="label label-default" @if($mt>0) style="background:#F44336;" @endif>{{$mt}}</span>--}}
{{--                        </a>--}}

{{--                        <ul class="dropdown-menu">--}}
{{--                            <li class="header">--}}
{{--                                @if($mt>0) Есть новые сообщения--}}
{{--                                <script>--}}
{{--                                    var audio = new Audio('/backend/speech_sleep.wav');--}}
{{--                                    audio.play();--}}
{{--                                </script>--}}
{{--                                @else Новых сообщний нет @endif--}}
{{--                            </li>--}}
{{--                            <li class="footer">--}}
{{--                                {{ link_to('/admin/users/guest-appeals', 'Перейти') }}--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

{{--                @endif--}}

{{--                <li class="dropdown user user-menu">--}}
{{--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--                        <span class="hidden-xs">{{ access()->user()->name }}</span>--}}
{{--                    </a>--}}

{{--                    <ul class="dropdown-menu">--}}
{{--                        <li class="user-header">--}}
{{--                            <p>--}}
{{--                                --}}{{-- access()->user()->name }} - {{ implode(", ", access()->user()->roles->lists('name')->toArray()) --}}
{{--                                <small>На #ВЗО с {{ access()->user()->created_at->format("m/d/Y") }}</small>--}}
{{--                            </p>--}}
{{--                        </li>--}}



{{--                        <li class="user-footer">--}}
{{--                            <div class="pull-left">--}}
{{--                                <a href="{!! route('frontend.index') !!}" class="btn btn-default btn-flat">--}}
{{--                                    <i class="fa fa-home"></i>--}}
{{--                                    Главная--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="pull-right">--}}
{{--                                <a href="{!! route('frontend.auth.logout') !!}" class="btn btn-danger btn-flat">--}}
{{--                                    <i class="fa fa-sign-out"></i>--}}
{{--                                    Выход--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            </ul>--}}
        </div><!-- /.navbar-custom-menu -->
    </nav>
</header>
