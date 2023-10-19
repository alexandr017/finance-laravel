{!! $form_error !!}  {!! $form_info !!}

<div class="form_get_rating_wrap">

    <h1 class="fgrw_h1">Кредитный рейтинг онлайн -<br> бесплатная проверка физических лиц</h1>
    <p class="text-center">С помощью сервиса #ВЗО вы можете бесплатно узнать свой кредитный рейтинг</p>

    <form class="form" action="/get-rating-register" method="POST" id="creditRating">
        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
        <div class="form-title">Заполните форму и узнайте свой кредитный рейтинг</div>
        <div class="form-vzo-group">
            <span class="form-vzo-group-title">Личные данные</span>
            <p class="form-vzo-group-desc">Чтобы мы смогли найти вас в Центральном каталоге кредитных историй, нам нужно знать ваше полное имя</p>
            <div class="form-group">
                <label for="last_name">Фамилия:</label>
                <input type="text" name="last_name" class="form-control" id="last_name" value="{{$last_name}}" placeholder="Иванов" required="true">
            </div>
            <div class="form-group">
                <label for="first_name">Имя:</label>
                <input type="text" name="first_name" value="{{$first_name}}" class="form-control" id="first_name" placeholder="Иван" required="true">
            </div>
            <div class="form-group">
                <label for="middle_name">Отчество:</label>
                <input type="text" name="middle_name" value="{{$middle_name}}" class="form-control" id="middle_name" placeholder="Иванович">
            </div>
            <div class="form-group">
                <label for="birthday">Дата рождения:</label>
                <input type="date" name="birthday" class="form-control" value="{{$birthday}}" id="birthday" required="true">
            </div>
        </div>
        <div class="text-center"><span id="show_full_form" class="form-btn1">Показать полностью <i class="fa fa-arrow-down"></i></span></div>
        <div class="form-vzo-group display_none">
            <span class="form-vzo-group-title">Паспортные данные</span>
            <p class="form-vzo-group-desc">Номер и серия вашего паспорта необходимы для подтверждения личности того, кто отправляет заявку</p>
            <div class="form-group">
                <label for="passport">Серия и номер паспорта (без пробелов):</label>
                <input type="text" name="passport" value="{{$passport}}" class="form-control" id="passport" placeholder="4002093230" required="true">
            </div>
            <div class="form-group display_none">
                <label for="passport_date">Дата выдачи паспорта:</label>
                <input type="date" name="passport_date"  value="{{$passport_date}}" class="form-control" id="passport_date" required="true">
            </div>
        </div>
        <div class="form-vzo-group display_none">
            <span class="form-vzo-group-title">Контактные данные</span>
            <p class="form-vzo-group-desc">На Email мы пришлем сообщение о результатах запроса</p>
            <div class="form-group display_none">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" value="{{$email}}" id="email" placeholder="ivanov@mail.ru" required="true">
            </div>
        </div>
        <div class="form-group display_none">
            <div class="g-recaptcha" data-sitekey="6LdYqz0UAAAAAPKI1karX0-Gr35D7_MVfO8IN2TD"></div>
        </div>
        <div class="form-group display_none">
            <label for="checkbox1"><input type="checkbox" checked="true"  name="checkbox1" id="checkbox1" required="true"> Я согласен на обработку моих персональных данных</label>
        </div>
        <div class="form-group display_none">
            <label for="checkbox2"><input type="checkbox" checked="true" name="checkbox2" id="checkbox2" required="true"> Я согласен с <a href="/rules" target="_blank">условиями</a> предоставления услуг</label>
        </div>
        <div class="form-group display_none">
            <label for="checkbox3"><input type="checkbox" checked="true" name="checkbox3" id="checkbox3" required="true"> Я согласен на получение информационно-рекламных материалов</label>
        </div>
        <div class="form-group display_none">
            <label for="checkbox4"><input type="checkbox" checked="true" name="checkbox4" id="checkbox4" required="true"> Я согласен, что данный запрос может повлиять на мой кредитный рейтинг</label>
        </div>
        <div class="form-group display_none">
            <button type="submit" class="form-btn1 width-100">Отправить</button>
        </div>
    </form>

    <div class="how_get_rating_wrap">
        <span>Как это работет?</span>
        <div class="how_get_rating_inner">
            <div class="item"><img loading="lazy" src="/vzo_theme/img/gr1.png"><span><i>1</i>Заполните <br> форму</span></div>
            <div class="item">
                <img loading="lazy" class="vcenter" src="/vzo_theme/img/rk-arrow.png">
                <img loading="lazy" class="mob" src="/vzo_theme/img/rk-arrow-mob.png">
            </div>
            <div class="item"><img loading="lazy" src="/vzo_theme/img/gr2.png"><span><i>2</i>Получите доступ<br> в личный кабинет</span></div>
            <div class="item">
                <img loading="lazy" class="vcenter" src="/vzo_theme/img/rk-arrow.png">
                <img loading="lazy" class="mob" src="/vzo_theme/img/rk-arrow-mob.png">
            </div>
            <div class="item"><img loading="lazy" src="/vzo_theme/img/gr3.png"><span><i>3</i>Скачайте подробный отчет</span></div>
        </div>
    </div>


    <div class="info-foot-form">
        <div class="row">
            <div class="col-sm-1">
                <img class="def_load" src="" data-src="/vzo_theme/img/warning.png" alt="">
            </div>
            <div class="col-sm-11">
                <p>После отправки заявки на вашу электронную почту придет письмо для подтверждения получения рассылки. Мы будем несколько раз в месяц присылать вам уведомления об изменении кредитного рейтинга, специальные предложения банков и полезные статьи.
                    <br><a href="#subscription_form" class="text-strong">Рекомендуем подписаться</a>.</p>
            </div>
        </div>
    </div>
</div>