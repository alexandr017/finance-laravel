<i id="menu-mob-button"><u></u><u></u><u></u></i>
<div class="mob-menu-wrap">
    <div class="menu-line-top">
        <label class="mob-close mob-close-js">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 40 40"><path fill="currentColor" d="M 10,10 L 30,30 M 30,10 L 10,30"></path></svg>
        </label>

        <div class="logo-head-wrap">
            @if(Request::is('/'))
                <img width="180" height="60" src="/old_theme/img/logo.svg" alt="Finance.ru" title="#Finance.ru">
            @else
                <a href="/"><img width="180" height="60" src="/old_theme/img/logo.svg" alt="Finance.ru" title="#Finance.ru"></a>
            @endif
        </div>

    </div>



    <div id="sub-menu">
        <div id="sub-menu-title">
            <ul class="mobl-menu main-menu">
                <li><a href="/">Главная</a></li>
                <li>
                    <ul>
                        <li><a href="/mfo">Все МФО</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>

</div>
