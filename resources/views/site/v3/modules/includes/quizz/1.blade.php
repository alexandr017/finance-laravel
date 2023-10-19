@if($_SERVER['REQUEST_URI'] == '/loans')
    <div class="d-flex quiz-adv-search-block">
        <div class="quiz-adv-search-first-row quiz-blocks-border-bottom">
            <div class="quiz-div-label">
                <label class="quiz-label" for="quiz-perc-per-day">Процент в день</label>
                <input type="number" id="quiz-perc-per-day">
            </div>
            <div class="quiz-div-label">
                <label class="quiz-label" for="quiz-age">Возраст</label>
                <input type="number" id="quiz-age" pattern="[0-9]" min="0">
            </div>
            <div class="quiz-div-label">
                <label class="quiz-label" for="quiz-city">Город</label>
                <select name="city" id="quiz-city">
                    <option value="">Любой</option>
                    @foreach($cities as $city)
                        <option value="{{$city->transliteration}}">{!! $city->imenitelny !!}</option>
                    @endforeach
                </select>
            </div>
            <div class="quiz-div-label">
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
            </div>
        </div>
    <div class="quiz-payment">
        <p class="quiz-title">Способ выплаты</p>
        <p class="loans-quiz-subtitle">Выбирайте удобный вам способ получения займа, после чего нажмите кнопку Обновить результаты. После этого вы увидите все подходящие вам компании.</p>
        <button type="text" class="loans-quiz-multiselect-value"><span>Выбрать</span> <i class="fa fa-chevron-down"></i></button>
        <div class="quiz-checkboxes-and-labels d-flex quiz-payment-methods checkboxes-multiselect">
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-nal" value="nal">
                <label class="quiz-label" for="quiz-nal">Наличными</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-card" value="card">
                <label class="quiz-label" for="quiz-card">На карту</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-tinkoff" value="zaim-tinkoff">
                <label class="quiz-label" for="quiz-tinkoff">Тинькофф</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-sberbank" value="karta-sberbanka">
                <label class="quiz-label" for="quiz-sberbank">Сбербанк</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-visa" value="viza">
                <label class="quiz-label" for="quiz-visa">Visa</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-mir" value="karta-mir">
                <label class="quiz-label" for="quiz-mir">МИР</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-maestro" value="maestro">
                <label class="quiz-label" for="quiz-maestro">Maestro</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-qiwi" value="qiwi">
                <label class="quiz-label" for="quiz-qiwi">QIWI</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-yandex-wallet" value="yandex-money">
                <label class="quiz-label" for="quiz-yandex-wallet">Яндекс-кошелек</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-el-wallet" value="elektronnyj-koshelyok">
                <label class="quiz-label" for="quiz-el-wallet">Электронный кошелек</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-kukuruza" value="kukuruza">
                <label class="quiz-label" for="quiz-kukuruza">Кукуруза</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-contact" value="contact">
                <label class="quiz-label" for="quiz-contact">Contact</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-bank-account" value="bankovskij-schet">
                <label class="quiz-label" for="quiz-bank-account">Счет в банке</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-unistream" value="unistream">
                <label class="quiz-label" for="quiz-unistream">Unistream</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-gold-crown" value="zolotaya-korona">
                <label class="quiz-label" for="quiz-gold-crown">Золотая Корона</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-money-transfer" value="denezhnyj-perevod">
                <label class="quiz-label" for="quiz-money-transfer">Денежный перевод</label>
            </span>
        </div>
    </div>
    <div class="quiz-borrower quiz-blocks-border-bottom">
        {{--        <div class="quiz-left">--}}
        <p class="quiz-title">Заемщик</p>
        <p class="loans-quiz-subtitle">Здесь вы можете выбрать, к какой группе заемщиков относитесь. Это позволит подобрать компанию точнее.</p>
        <button type="text" class="loans-quiz-multiselect-value"><span>Выбрать</span> <i class="fa fa-chevron-down"></i></button>
        <div class="quiz-checkboxes-and-labels d-flex checkboxes-multiselect">
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-pensioner" value="pensioneram">
                <label class="quiz-label" for="quiz-pensioner">Пенсионер</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-bezrabotniy" value="bezrabotnym">
                <label class="quiz-label" for="quiz-bezrabotniy">Безработный</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-student" value="studentam">
                <label class="quiz-label" for="quiz-student">Студент</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-ip" value="ip">
                <label class="quiz-label" for="quiz-ip">ИП</label>
            </span>
        </div>
    </div>
    <div class="quiz-history quiz-blocks-border-bottom">
        <p class="quiz-title">Кредитная история</p>
        <p class="loans-quiz-subtitle">Если вы не знаете свою кредитную историю - не выбирайте ничего. Если вы никогда не брали займы или кредиты - выберите пункт Нет</p>
        <button type="text" class="loans-quiz-multiselect-value"><span>Выбрать</span> <i class="fa fa-chevron-down"></i></button>
        <div class="quiz-checkboxes-and-labels d-flex checkboxes-multiselect">
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-no-cr-history" value="bez-kreditnoj-istorii">
                <label class="quiz-label" for="quiz-no-cr-history">Нет</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-bad-cr-history" value="history">
                <label class="quiz-label" for="quiz-bad-cr-history">Плохая</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-delay-cr-history" value="s-otkritoy-prosrochkoi">
                <label class="quiz-label" for="quiz-delay-cr-history">Открытые просрочки</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-without-check-history" value="bez-proverok">
                <label class="quiz-label" for="quiz-without-check-history">Без проверки</label>
            </span>
        </div>
    </div>
    <div class="quiz-docs quiz-blocks-border-bottom quiz-checkboxes-and-labels">
        <p class="quiz-title">Документы</p>
        <p class="loans-quiz-subtitle">При необходимости, вы можете указать дополнительную информацию по документам. Например, если у вас нет прописки - выбирайте пункт Без прописки. Так вы сможете подобрать компанию, которая скорее всего одобрит вам займ.</p>
        <button type="text" class="loans-quiz-multiselect-value"><span>Выбрать</span> <i class="fa fa-chevron-down"></i></button>
        <div class="quiz-checkboxes-and-labels d-flex checkboxes-multiselect">
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-passport" value="pasport">
            <label class="quiz-label" for="quiz-passport">Паспорт</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-no-passport" value="bez-pasporta">
            <label class="quiz-label" for="quiz-no-passport">Нет паспорта</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-snils" value="bez-snils">
            <label class="quiz-label" for="quiz-snils">Без СНИЛС</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-zalog" value="bez-zaloga">
            <label class="quiz-label" for="quiz-zalog">Без залог</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-const-register" value="bez-registracii">
            <label class="quiz-label" for="quiz-const-register">Без постоянная регистрация</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-temp-register" value="vremennaja-registracija">
            <label class="quiz-label" for="quiz-temp-register">Временная регистрация</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-registration" value="bez-propiski">
            <label class="quiz-label" for="quiz-registration">Без прописка</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-income-blank" value="bez-spravki-o-dohodah">
            <label class="quiz-label" for="quiz-income-blank">Без справки о доходах</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-official-employment" value="bez-oficialnogo-trudoustrojstva">
            <label class="quiz-label" for="quiz-official-employment-">Без официального трудоустройства</label>
        </span>
        </div>
    </div>
    <div class="quiz-other quiz-blocks-border-bottom quiz-checkboxes-and-labels">
        <p class="quiz-title">Другие условия</p>
        <p class="loans-quiz-subtitle">Здесь вы можете выбрать дополнительные условия, которые вас интересуют. Важно понимать, что чем больше условий вы укажете - тем выше вероятность не найти ни одной компании.
        </p>
        <button type="text" class="loans-quiz-multiselect-value"><span>Выбрать</span> <i class="fa fa-chevron-down"></i></button>
        <div class="quiz-checkboxes-and-labels d-flex checkboxes-multiselect">
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-kruglosutochno" value="kruglosutochnye">
            <label class="quiz-label" for="quiz-kruglosutochno">Круглосуточно</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-sprodleniem" value="prolongation" class="quiz-option">
            <label class="quiz-label" for="quiz-sprodleniem">С продлением</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-nizkiy-procent-otzivov" value="bez-otkaza">
            <label class="quiz-label" for="quiz-nizkiy-procent-otzivov">Низкий % отказов</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-new-mfo" value="novye-zajmy">
            <label class="quiz-label" for="quiz-new-mfo">Новые МФО</label>
        </span>
        </div>
    </div>
    </div>

@else
    <div class="quiz-bordered-block">
        <div class="quiz-payment">
            <p class="quiz-title">Способ выплаты</p>
            <p>Выбирайте удобный вам способ получения займа, после чего нажмите кнопку Обновить результаты. После этого вы увидите все подходящие вам компании.</p>
            <div class="quiz-checkboxes-and-labels d-flex quiz-payment-methods">
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-nal" value="nal">
                <label class="quiz-label" for="quiz-nal">Наличными</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-card" value="card">
                <label class="quiz-label" for="quiz-card">На карту</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-tinkoff" value="zaim-tinkoff">
                <label class="quiz-label" for="quiz-tinkoff">Тинькофф</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-sberbank" value="karta-sberbanka">
                <label class="quiz-label" for="quiz-sberbank">Сбербанк</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-visa" value="viza">
                <label class="quiz-label" for="quiz-visa">Visa</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-mir" value="karta-mir">
                <label class="quiz-label" for="quiz-mir">МИР</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-maestro" value="maestro">
                <label class="quiz-label" for="quiz-maestro">Maestro</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-qiwi" value="qiwi">
                <label class="quiz-label" for="quiz-qiwi">QIWI</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-yandex-wallet" value="yandex-money">
                <label class="quiz-label" for="quiz-yandex-wallet">Яндекс-кошелек</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-el-wallet" value="elektronnyj-koshelyok">
                <label class="quiz-label" for="quiz-el-wallet">Электронный кошелек</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-kukuruza" value="kukuruza">
                <label class="quiz-label" for="quiz-kukuruza">Кукуруза</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-contact" value="contact">
                <label class="quiz-label" for="quiz-contact">Contact</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-bank-account" value="bankovskij-schet">
                <label class="quiz-label" for="quiz-bank-account">Счет в банке</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-unistream" value="unistream">
                <label class="quiz-label" for="quiz-unistream">Unistream</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-gold-crown" value="zolotaya-korona">
                <label class="quiz-label" for="quiz-gold-crown">Золотая Корона</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-money-transfer" value="denezhnyj-perevod">
                <label class="quiz-label" for="quiz-money-transfer">Денежный перевод</label>
            </span>
            </div>
        </div>
        <div class="quiz-borrower-history-block d-flex">
            <div class="quiz-left">
                <p class="quiz-subtitle">Заемщик</p>
                <p>Здесь вы можете выбрать, к какой группе заемщиков относитесь. Это позволит подобрать компанию точнее.</p>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-pensioner" value="pensioneram">
                <label class="quiz-label" for="quiz-pensioner">Пенсионер</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-bezrabotniy" value="bezrabotnym">
                <label class="quiz-label" for="quiz-bezrabotniy">Безработный</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-student" value="studentam">
                <label class="quiz-label" for="quiz-student">Студент</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-ip" value="ip">
                <label class="quiz-label" for="quiz-ip">ИП</label>
            </span>
            </div>
            <div class="quiz-right">
                <p class="quiz-subtitle">Кредитная история</p>
                <p>Если вы не знаете свою кредитную историю - не выбирайте ничего. Если вы никогда не брали займы или кредиты - выберите пункт Нет</p>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-no-cr-history" value="bez-kreditnoj-istorii">
                <label class="quiz-label" for="quiz-no-cr-history">Нет</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-bad-cr-history" value="history">
                <label class="quiz-label" for="quiz-bad-cr-history">Плохая</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-delay-cr-history" value="s-otkritoy-prosrochkoi">
                <label class="quiz-label" for="quiz-delay-cr-history">Открытые просрочки</label>
            </span>
                <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-without-check-history" value="bez-proverok">
                <label class="quiz-label" for="quiz-without-check-history">Без проверки</label>
            </span>
            </div>
        </div>
        <div class="quiz-docs quiz-checkboxes-and-labels d-flex">
            <p class="quiz-subtitle">Документы</p>
            <p>При необходимости, вы можете указать дополнительную информацию по документам. Например, если у вас нет прописки - выбирайте пункт Без прописки. Так вы сможете подобрать компанию, которая скорее всего одобрит вам займ.</p>
            <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-passport" value="pasport">
            <label class="quiz-label" for="quiz-passport">Паспорт</label>
        </span>
            <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-no-passport" value="bez-pasporta">
            <label class="quiz-label" for="quiz-no-passport">Нет паспорта</label>
        </span>
            <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-snils" value="bez-snils">
            <label class="quiz-label" for="quiz-snils">Без СНИЛС</label>
        </span>
            <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-zalog" value="bez-zaloga">
            <label class="quiz-label" for="quiz-zalog">Без залог</label>
        </span>
            <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-const-register" value="bez-registracii">
            <label class="quiz-label" for="quiz-const-register">Без постоянная регистрация</label>
        </span>
            <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-temp-register" value="vremennaja-registracija">
            <label class="quiz-label" for="quiz-temp-register">Временная регистрация</label>
        </span>
            <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-registration" value="bez-propiski">
            <label class="quiz-label" for="quiz-registration">Без прописка</label>
        </span>
            <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-income-blank" value="bez-spravki-o-dohodah">
            <label class="quiz-label" for="quiz-income-blank">Без справки о доходах</label>
        </span>
            <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-official-employment" value="bez-oficialnogo-trudoustrojstva">
            <label class="quiz-label" for="quiz-official-employment-">Без официального трудоустройства</label>
        </span>
        </div>
        <div class="quiz-other quiz-checkboxes-and-labels d-flex">
            <p class="quiz-subtitle">Другие условия</p>
            <p>Здесь вы можете выбрать дополнительные условия, которые вас интересуют. Важно понимать, что чем больше условий вы укажете - тем выше вероятность не найти ни одной компании.
            </p>
            <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-kruglosutochno" value="kruglosutochnye">
            <label class="quiz-label" for="quiz-kruglosutochno">Круглосуточно</label>
        </span>
            <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-sprodleniem" value="prolongation" class="quiz-option">
            <label class="quiz-label" for="quiz-sprodleniem">С продлением</label>
        </span>
            <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-nizkiy-procent-otzivov" value="bez-otkaza">
            <label class="quiz-label" for="quiz-nizkiy-procent-otzivov">Низкий % отказов</label>
        </span>
            <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-new-mfo" value="novye-zajmy">
            <label class="quiz-label" for="quiz-new-mfo">Новые МФО</label>
        </span>
            <span class="quiz-checkbox-margin">
            <label class="quiz-label" for="quiz-city">Город</label>
            <select name="city" id="quiz-city">
                <option value="">Любой</option>
                @foreach($cities as $city)
                    <option value="{{$city->transliteration}}">{!! $city->imenitelny !!}</option>
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
@endif