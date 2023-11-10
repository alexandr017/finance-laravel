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
        <div id="sub-menu-title"></div>
        <ul></ul>
    </div>
    <ul class="mobl-menu main-menu">
        <li>
            <a data-text="Назад" class="a-sub-m" href="/zaimy"><b class="caret fa fa-angle-down"></b> Займы</a>
            <ul>
                <li><a href="/zaimy">Все займы</a></li>
                <li><a href="/zaimy/na-kartu">На карту</a></li>
                <li><a href="/zaimy/bez-otkaza">Без отказа</a></li>
                <li><a href="/zaimy/bez-karty">Без карты</a></li>
                <li><a href="/zaimy/bez-protsentov">Без процентов</a></li>
                <li><a href="/zaimy/bystryj">Быстрый займ</a></li>
                <li><a href="/zaimy/100-protsentnoe-odobrenie">Займы со 100% одобрением</a></li>
                <li><a href="/zaimy/kruglosutochno">Круглосуточно</a></li>
                <li><a href="/zaimy/na-kivi-koshelek">На Киви кошелек</a></li>
                <li><a href="/zaimy/bez-kreditnoj-istorii">Без кредитной истории</a></li>
                <li><a href="/zaimy/dlya-yurlitsa">Без фото</a></li>
                <li><a href="/zaimy/na-mesyats">На месяц</a></li>
            </ul>
        </li>
        <li>
            <a data-text="Назад" class="a-sub-m" href="/kredity"><b class="caret fa fa-angle-down"></b> Кредиты</a>
            <ul>
                <li><a href="/kredity">Все кредиты</a></li>
                <li><a href="/avtokredity">Автокредиты</a></li>
                <li><a href="/kredity/refinansirovanie">Рефинансирование кредитов</a></li>
                <li><a href="/kredity/potrebitelskij">Потребительские</a></li>
                <li><a href="/kredity/na-kartu">На карту</a></li>
                <li><a href="/kredity/nalichnymi">Наличными</a></li>
                <li><a href="/kredity/pod-zalog">Под залог</a></li>
                <li><a href="/kredity/fizicheskim-litsam">Физическим лицам</a></li>
                <li><a href="/kredity/s-plohoj-kreditnoj-istoriej">С плохой кредитной историей</a></li>
                <li><a href="/kredity/pensioneram">Пенсионерам</a></li>
                <li><a href="/kredity/vygodnyj">Выгодные</a></li>
                <li><a href="/kredity/bez-pervonachalnogo-vznosa">Без первоначального взноса</a></li>
                <li><a href="/kredity/bez-kreditnoj-istorii">Без кредитной истории</a></li>
            </ul>
        </li>
        <li>
            <a data-text="Назад" class="a-sub-m" href="/kreditnye-karty"><b class="caret fa fa-angle-down"></b> Кредитные карты</a>
            <ul>
                <li><a href="/kreditnye-karty">Все кредитные карты</a></li>
                <li><a href="/kreditnye-karty/bez-otkaza">Без отказа</a></li>
                <li><a href="/kreditnye-karty/s-plohoj-kreditnoj-istoriej">С плохой кредитной историей</a></li>
                <li><a href="/kreditnye-karty/bez-proverok">Без проверок</a></li>
                <li><a href="/kreditnye-karty/pensioneram">Кредитные карты для пенсионеров</a></li>
                <li><a href="/kreditnye-karty/s-prosrochkami">Кредитные карты с просрочками</a></li>
                <li><a href="/kreditnye-karty/120-dnej">Кредитные карты 120 дней</a></li>
                <li><a href="/kreditnye-karty/200-dnej">Кредитные карты 200 дней</a></li>
                <li><a href="/kreditnye-karty/luchshie">Лучшие кредитные карты</a></li>
                <li><a href="/kreditnye-karty/virtualnye">Виртуальные кредитные карты</a></li>
                <li><a href="/kreditnye-karty/momentalnye">Моментальные кредитные карты</a></li>
            </ul>
        </li>
        <li>
            <a data-text="Назад" class="a-sub-m" href="/vklady"><b class="caret fa fa-angle-down"></b> Вклады</a>
            <ul>
                <li><a href="/vklady">все вклады</a></li>
                <li><a href="/vklady/fizicheskim-litsam">Для физических лиц</a></li>
                <li><a href="/vklady/s-vysokim-protsentom">С высоким процентом</a></li>
                <li><a href="/vklady/luchshie">Лучшие</a></li>
                <li><a href="/vklady/vygodnye">Выгодные</a></li>
                <li><a href="/vklady/dlya-pensionerov">Для пенсионеров</a></li>
                <li><a href="/vklady/srochnye">Срочные</a></li>
                <li><a href="/vklady/dlya-yuridicheskih-lits">Для юридических лиц</a></li>
                <li><a href="/vklady/v-yuanyah">Вклады в юанях</a></li>
                <li><a href="/vklady/na-1-mesyats">Вклады на 1 месяц</a></li>
                <li><a href="/vklady/na-2-mesyatsa">Вклады на 2 месяца</a></li>
            </ul>
        </li>
        <li>
            <a data-text="Назад" class="a-sub-m" href="/ipoteka"><b class="caret fa fa-angle-down"></b> Ипотеки</a>
            <ul>
                <li><a href="/ipoteka">Все ипотеки</a></li>
                <li><a href="/ipoteka/semejnaya">Семейная ипотека</a></li>
                <li><a href="/ipoteka/lgotnaya">Льготная ипотека</a></li>
                <li><a href="/ipoteka/s-gospodderzhkoj">Ипотека с господдержкой</a></li>
                <li><a href="/ipoteka/onlajn">Ипотека онлайн</a></li>
                <li><a href="/ipoteka/na-vtorichnoe-zhile">Ипотека на вторичное жилье</a></li>
                <li><a href="/ipoteka/na-stroitelstvo">Ипотека на строительство</a></li>
                <li><a href="/ipoteka/voennaya">Военная ипотека</a></li>
                <li><a href="/ipoteka/bez-pervonachalnogo-vznosa">Ипотека без первоначального взноса</a></li>
                <li><a href="/ipoteka/dlya-molodyh-semej">Ипотека для молодых семей</a></li>
                <li><a href="/ipoteka/s-materinskim-kapitalom">Ипотека с материнским капиталом</a></li>
                <li><a href="/ipoteka/refinansirovanie">Рефинансирование ипотеки</a></li>
                <li><a href="/ipoteka/na-novostrojki">Ипотека на новостройки</a></li>
            </ul>
        </li>
        <li>
            <a data-text="Назад" class="a-sub-m" href="/rko"><b class="caret fa fa-angle-down"></b> РКО</a>
            <ul>
                <li><a href="/rko">Все РКО</a></li>
                <li><a href="/rko/ip">Для ИП</a></li>
                <li><a href="/rko/ooo">Для ООО</a></li>
                <li><a href="/rko/onlajn">Онлайн</a></li>
                <li><a href="/rko/besplatnyj">Бесплатно</a></li>
                <li><a href="/rko/za-den">За один день</a></li>
                <li><a href="/rko/po-doverennosti">По доверенности</a></li>
            </ul>
        </li>
        <li><a href="/banki">Банки</a></li>
        <li><a href="/mfo">МФО</a></li>
        <li><a href="/news">Новости</a></li>
        <li><a href="/articles">Журнал</a></li>
    </ul>
</div>


