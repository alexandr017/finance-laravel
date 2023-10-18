<nav class="org">
    <ul>
    @if(Request::path() == 'banks/'.$bank->alias)
        <li><span class="fa-icon fa-bank">О банке</span></li>
    @else
        <li><a href="/banks/{{$bank->alias}}" class="fa-icon fa-bank">О банке</a></li>
    @endif
    @if(Request::path() == 'banks/'.$bank->alias.'/hotline')
        <li><span class="fa-icon fa-life-bouy">Служба поддержки</span></li>
    @else
        <li><a href="/banks/{{$bank->alias}}/hotline" class="fa-icon fa-life-bouy">Служба поддержки</a></li>
    @endif
    @if(Request::path() == 'banks/'.$bank->alias.'/login')
        <li><span class="fa-icon fa-user">Личный кабинет</span></li>
    @else
        <li><a href="/banks/{{$bank->alias}}/login" class="fa-icon fa-user">Личный кабинет</a></li>
    @endif
    @if(Request::path() == 'banks/'.$bank->alias.'/reviews')
        <li><span class="fa-icon fa-comments-o">Отзывы</span></li>
    @else
        <li><a href="/banks/{{$bank->alias}}/reviews" class="fa-icon fa-comments-o">Отзывы</a></li>
    @endif
    @if(Request::path() == 'banks/'.$bank->alias.'/requisites')
        <li><span class="fa-icon fa-file-text-o">Реквизиты</span></li>
    @else
        <li><a href="/banks/{{$bank->alias}}/requisites" class="fa-icon fa-file-text-o">Реквизиты</a></li>
    @endif
    </ul>
</nav>