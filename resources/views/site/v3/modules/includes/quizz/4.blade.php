{{--credits--}}
<div class="quiz-adv-search-first-block d-flex">
     <span class="quiz-div-label">
         <label class="quiz-label" for="quiz-perc-per-year">Процент в год</label>
         <input type="number" id="quiz-perc-per-year" pattern="[0-9]" min="0">
     </span>
     <span class="quiz-div-label">
         <label class="quiz-label" for="quiz-age">Возраст</label>
         <input type="number" id="quiz-age" pattern="[0-9]" min="0">
     </span>
</div>
<div class="quiz-bordered-block">
<div class="quiz-blocks-border-bottom d-flex">
    <div class="quiz-left">
        <p class="quiz-subtitle">Способ выплаты</p>
        <div>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-nalichnimi" value="online-credit/nal">
                <label class="quiz-label" for="quiz-nalichnimi">Наличными</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-na-kartu" value="online-credit/card">
                <label class="quiz-label" for="quiz-na-kartu">На карту</label>
            </span>
        </div>
    </div>
    <div class="quiz-right">
        <p class="quiz-subtitle">Цели</p>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-pokupka-jilya" value="online-credit/pokupka-zhilya">
            <label class="quiz-label" for="quiz-pokupka-jilya">Покупка жиля</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-potrebiltelskiy" value="online-credit/potrebitelskij">
            <label class="quiz-label" for="quiz-potrebiltelskiy">Потребительский</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-refinansirovanie" value="online-credit/refinansirovanie">
            <label class="quiz-label" for="quiz-refinansirovanie">Рефинансирование</label>
        </span>
    </div>
</div>
<div class="quiz-docs">
    <p class="quiz-subtitle">Документы</p>
    <div class="quiz-checkboxes-and-labels d-flex">
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-passport" value="online-credit/pasport" checked disabled="true">
            <label class="quiz-label" for="quiz-passport">Паспорт</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-bez-spravki-o-doxodax" value="online-credit/bez-2-ndfl">
            <label class="quiz-label" for="quiz-bez-spravki-o-doxodax">Без справки о доходах</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-two-docs" value="online-credit/dva-dokumenta">
            <label class="quiz-label" for="quiz-two-docs">2 документа</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-bez-trudovoy" value="online-credit/bez-trudovoj-knizhki">
            <label class="quiz-label" for="quiz-bez-trudovoy">Без трудовой</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-bez-poruchitelya" value="online-credit/bez-spravok-poruchitelej">
            <label class="quiz-label" for="quiz-bez-poruchitelya">Без поручителя</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-temp-register" value="online-credit/s-vremennoj-registraciej">
            <label class="quiz-label" for="quiz-temp-register">Временная регистрация</label>
        </span>
    </div>
</div>
<div class="quiz-loan">
        <p class="quiz-title">Заемщик</p>
        <div class="quiz-checkboxes-and-labels d-flex">
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-pensioner" value="online-credit/pensioneram">
                <label class="quiz-label" for="quiz-pensioner">Пенсионер</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-voennosluj" value="online-credit/voennosluzhaschim">
                <label class="quiz-label" for="quiz-voennosluj">Военнослужащий</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-ip" value="online-credit/ip">
                <label class="quiz-label" for="quiz-ip">ИП</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-yurlicam" value="online-credit/yuridicheskim-licam">
                <label class="quiz-label" for="quiz-yurlicam">Юрлицо</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-bezrabotniy" value="online-credit/bezrabotnym">
                <label class="quiz-label" for="quiz-bezrabotniy">Безработный</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-student" value="online-credit/studentam">
                <label class="quiz-label" for="quiz-student">Студент</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-jenshvdekrete" value="online-credit/v-dekrete">
                <label class="quiz-label" for="quiz-jenshvdekrete">Женщина в декрете</label>
            </span>
        </div>
    </div>
<div class="quiz-other">
        <p class="quiz-subtitle">Другие условия</p>
        <div class="quiz-checkboxes-and-labels d-flex">
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-bez-vizita" value="online-credit/bez-posesheniya-banka">
                <label class="quiz-label" for="quiz-bez-vizita">Без визита в банк</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-diff-plateji" value="online-credit/differencirovannye-platezhi">
                <label class="quiz-label" for="quiz-diff-plateji">Дифференциальные платежи</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-nizkiy-procent" value="online-credit/nizkij-procent">
                <label class="quiz-label" for="quiz-nizkiy-procent">Никий % ?????</label>
            </span>
            <span class="quiz-checkbox-margin">
                <label class="quiz-label" for="quiz-city">Город</label>
                <select name="city" id="quiz-city">
                <option value="">Любой</option>
                @foreach($cities as $city)
                    <option value="{{$city->alias}}">{!! $city->breadcrumb !!}</option>
                @endforeach
                </select>
            </span>
            <span class="quiz-checkbox-margin">
                <label class="quiz-label" for="quiz-speed">Скорость</label>
                <select name="speed" id="quiz-speed">
                    <option value="">Любая</option>
                    <option value="momentalnie">Моментально</option>
                    <option value="za-minutu">За минуту</option>
                    <option value="5-minut">За 5 минут</option>
                    <option value="10-minut">За 10 минут</option>
                    <option value="za-chas">За 1 час</option>
                    <option value="den-obrashheniya">В день обращения</option>
                </select>
            </span>
        </div>
    </div>
</div>
</div>
