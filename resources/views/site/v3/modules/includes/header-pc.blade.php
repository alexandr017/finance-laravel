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
            <ul>
                <li class="jsMenuLi">
                    <a href="/zaimy">Займы</a>
                    <ul>
                        <li><a href="/zaimy/na-kartu">На карту</a></li>
                        <li><a href="/zaimy/bez-otkaza">Без отказа</a></li>
                        <li><a href="/zaimy/bez-karty">Без карты</a></li>
                        <li><a href="/zaimy/bez-protsentov">Без процентов</a></li>
                        <li><a href="/zaimy/bystryj">Быстрый займ</a></li>
                        <li><a href="/zaimy/100-protsentnoe-odobrenie">Со 100% одобрением</a></li>
                        <li><a href="/zaimy/kruglosutochno">Круглосуточно</a></li>
                        <li><a href="/zaimy/na-kivi-koshelek">На Киви кошелек</a></li>
                        <li><a href="/zaimy/bez-kreditnoj-istorii">Без кредитной истории</a></li>
                        <li><a href="/zaimy/bez-foto">Без фото</a></li>
                        <li><a href="/zaimy/na-mesyats">На месяц</a></li>
                    </ul>
                </li>
                <li class="jsMenuLi"><a href="/kredity">Кредиты</a>
                    <ul>
                        <li><a href="/avtokredity">Автокредиты</a></li>
                        <li><a href="/kredity/refinansirovanie">Рефинансирование</a></li>
                        <li><a href="/kredity/potrebitelskij">Потребительские</a></li>
                        <li><a href="/kredity/na-kartu">На карту</a></li>
                        <li><a href="/kredity/nalichnymi">Наличными</a></li>
                        <li><a href="/kredity/pod-zalog">Под залог</a></li>
                        <li><a href="/kredity/fizicheskim-litsam">Физическим лицам</a></li>
                        <li><a href="/kredity/s-plohoj-kreditnoj-istoriej">С плохой кредитной историей</a></li>
                        <li><a href="/kredity/pensioneram">Пенсионерам</a></li>
                        <li><a href="/kredity/bez-pervonachalnogo-vznosa">Без первоначального взноса</a></li>
                        <li><a href="/kredity/bez-kreditnoj-istorii">Без кредитной истории</a></li>
                    </ul>
                </li>
                <li class="jsMenuLi">Карты
                    <ul>
                        <li><a href="/kreditnye-karty">Кредитные карты</a></li>
                        <li><a href="/debetovye-karty">Дебетовые карты</a></li>
                        <li><a href="/kreditnye-karty/bez-otkaza">Без отказа</a></li>
                        <li><a href="/debetovye-karty/bez-komissii">Без комиссии</a></li>
                        <li><a href="/kreditnye-karty/s-plohoj-kreditnoj-istoriej">С плохой кредитной историей</a></li>
                        <li><a href="/debetovye-karty/besplatnoe-obsluzhivanie">С бесплатным обслуживанием</a></li>
                        <li><a href="/kreditnye-karty/bez-proverok">Без проверок</a></li>
                        <li><a href="/debetovye-karty/zarplatnaya">Зарплатная карта</a></li>
                        <li><a href="/kreditnye-karty/pensioneram">Для пенсионеров</a></li>
                        <li><a href="/debetovye-karty/s-protsentom-na-ostatok">С процентом на остаток</a></li>
                        <li><a href="/kreditnye-karty/s-prosrochkami">С просрочками</a></li>
                        <li><a href="/debetovye-karty/imennaya">Именная</a></li>
                    </ul>
                </li>
                <li class="jsMenuLi"><a href="/vklady">Вклады</a>
                    <ul>
                        <li><a href="/vklady/fizicheskim-litsam">Для физических лиц</a></li>
                        <li><a href="/vklady/s-vysokim-protsentom">С высоким процентом</a></li>
                        <li><a href="/vklady/vygodnye">Выгодные</a></li>
                        <li><a href="/vklady/dlya-pensionerov">Для пенсионеров</a></li>
                        <li><a href="/vklady/srochnye">Срочные</a></li>
                        <li><a href="/vklady/dlya-yuridicheskih-lits">Для юридических лиц</a></li>
                        <li><a href="/vklady/v-yuanyah">В юанях</a></li>
                        <li><a href="/vklady/na-1-mesyats">На 1 месяц</a></li>
                        <li><a href="/vklady/na-2-mesyatsa">На 2 месяца</a></li>
                    </ul>
                </li>
                <li class="jsMenuLi"><a href="/ipoteka">Ипотеки</a>
                    <ul>
                        <li><a href="/ipoteka/semejnaya">Семейная</a></li>
                        <li><a href="/ipoteka/lgotnaya">Льготная</a></li>
                        <li><a href="/ipoteka/s-gospodderzhkoj">С господдержкой</a></li>
                        <li><a href="/ipoteka/na-vtorichnoe-zhile">На вторичное жилье</a></li>
                        <li><a href="/ipoteka/na-stroitelstvo">На строительство</a></li>
                        <li><a href="/ipoteka/voennosluzhaschim">Военная</a></li>
                        <li><a href="/ipoteka/bez-pervonachalnogo-vznosa">Без первоначального взноса</a></li>
                        <li><a href="/ipoteka/dlya-molodyh-semej">Для молодых семей</a></li>
                        <li><a href="/ipoteka/s-materinskim-kapitalom">С материнским капиталом</a></li>
                        <li><a href="/ipoteka/refinansirovanie">Рефинансирование</a></li>
                        <li><a href="/ipoteka/na-novostrojki">На новостройки</a></li>
                    </ul>
                </li>
                <li class="jsMenuLi"><a href="/rko">РКО</a>
                    <ul>
                        <li><a href="/rko/dlya-ip">Для ИП</a></li>
                        <li><a href="/rko/dlya-ooo">Для ООО</a></li>
                        <li><a href="/rko/onlajn">Онлайн</a></li>
                        <li><a href="/rko/besplatnyj">Бесплатно</a></li>
                        <li><a href="/rko/za-den">За один день</a></li>
                        <li><a href="/rko/po-doverennosti">По доверенности</a></li>
                    </ul>
                </li>
            </ul>
            <div class="menu menu-top desktop pull-right">
                <ul>
                    <li><a href="/banki">Банки</a></li>
                    <li><a href="/mfo">МФО</a></li>
                    <li><a href="/news">Новости</a></li>
                    <li><a href="/articles">Журнал</a></li>
                </ul>
            </div>
        </div>

    </div>
</div>
