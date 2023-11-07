<nav class="org">
    <ul>
        @if(Request::path() == 'mfo/' . $company->alias)
        <li><span><i class="fa fa-bank" style="margin-right: 10px;"></i> О компании</span></li>
        @else
        <li><a href="/mfo/{{$company->alias}}"><i class="fa fa-bank" style="margin-right: 10px;"></i> О компании</a></li>
        @endif

        @if(Request::path() == 'mfo/' . $company->alias . '/gorjachaja-linija')
                <li><span><i class="fa fa-life-bouy" style="margin-right: 10px;"></i>Служба поддержки</span></li>
        @else
            <li><a href="/mfo/{{$company->alias}}/gorjachaja-linija"><i class="fa fa-life-bouy"></i>Служба поддержки</a></li>
        @endif

        @if(Request::path() == 'mfo/' . $company->alias . '/lichnyj-kabinet')
                <li><span><i class="fa fa-user" style="margin-right: 10px;"></i>Личный кабинет</span></li>
        @else
            <li><a href="/mfo/{{$company->alias}}/lichnyj-kabinet"><i class="fa fa-user"></i>Личный кабинет</a></li>
        @endif

        @if(Request::path() == 'mfo/' . $company->alias . '/otzyvy')
                <li><span><i class="fa fa-comments-o" style="margin-right: 10px;"></i>Отзывы <span class="vdde">({{count($reviews)}})</span></span></li>
        @else
            <li><a href="/mfo/{{$company->alias}}/otzyvy"><i class="fa fa-comments-o"></i>Отзывы <span class="vdde">({{count($reviews)}})</span></a></li>
        @endif
    </ul>
</nav>
