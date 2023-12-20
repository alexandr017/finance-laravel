<nav class="org">
    <ul>
    @if(Request::path() == 'banki/'.$bank->alias)
        <li><span class="fa-icon fa-bank">О банке</span></li>
    @else
        <li><a href="/banki/{{$bank->alias}}" class="fa-icon fa-bank">О банке</a></li>
    @endif
    @if(Request::path() == 'banki/'.$bank->alias.'/gorjachaja-linija')
        <li><span class="fa-icon fa-life-bouy">Служба поддержки</span></li>
    @else
        <li><a href="/banki/{{$bank->alias}}/gorjachaja-linija" class="fa-icon fa-life-bouy">Служба поддержки</a></li>
    @endif
    @if(Request::path() == 'banki/'.$bank->alias.'/lichnyj-kabinet')
        <li><span class="fa-icon fa-user">Личный кабинет</span></li>
    @else
        <li><a href="/banki/{{$bank->alias}}/lichnyj-kabinet" class="fa-icon fa-user">Личный кабинет</a></li>
    @endif
    @if(Request::path() == 'banki/'.$bank->alias.'/rekvizity')
        <li><span class="fa-icon fa-file-text-o">Реквизиты</span></li>
    @else
        <li><a href="/banki/{{$bank->alias}}/rekvizity" class="fa-icon fa-file-text-o">Реквизиты</a></li>
    @endif
    @if(Request::path() == 'banki/'.$bank->alias.'/otzyvy')
        <li><span class="fa-icon fa-comments-o">Отзывы</span></li>
    @else
        <li><a href="/banki/{{$bank->alias}}/otzyvy" class="fa-icon fa-comments-o">Отзывы</a></li>
    @endif

    </ul>
</nav>