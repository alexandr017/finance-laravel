{{--credit cards--}}
<div class="quiz-adv-search-first-block d-flex">
    <span class="quiz-div-label">
       <label class="quiz-label" for="quiz-perc-per-year">Процент в год</label>
       <input type="number" pattern="[0-9]" min="0" id="quiz-perc-per-year">
    </span>
    <span class="quiz-div-label">
        <label class="quiz-label" for="quiz-age">Возраст</label>
        <input type="number" pattern="[0-9]" min="0" id="quiz-age">
    </span>
</div>
<div class="quiz-adv-search-second-block d-flex">
    <span class="quiz-div-label">
        <label class="quiz-label" for="quiz-payment-for-open">Стоимость открытия до</label>
        <input type="number" pattern="[0-9]" min="0" id="quiz-payment-for-open">
    </span>
    <span class="quiz-div-label">
        <label class="quiz-label" for="quiz-service-payment">Стоимость обслуживания до</label>
        <input type="number" pattern="[0-9]" min="0" id="quiz-service-payment">
    </span>
</div>
</div>
<div class="quiz-bordered-block">
    <div class="quiz-docs">
    <p class="quiz-subtitle">Документы</p>
    <div class="quiz-checkboxes-and-labels d-flex">
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-passport" value="passport" checked disabled="true">
            <label class="quiz-label" for="quiz-passport">Паспорт</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-bez-spravok" value="credit-cards/bez-spravok">
            <label class="quiz-label" for="quiz-bez-spravok">Без справки о доходах</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-two-docs" value="credit-cards/po-dvum-documentam">
            <label class="quiz-label" for="quiz-two-docs">2 документа</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-bez-registracii" value="credit-cards/bez-registracii">
            <label class="quiz-label" for="quiz-bez-registracii">Без регистрации</label>
        </span>
    </div>
</div>
    <div class="quiz-payment">
    <p class="quiz-title">Тип Карты</p>
        <div class="quiz-checkboxes-and-labels d-flex">
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-viza" value="credit-cards/viza">
            <label class="quiz-label" for="quiz-viza">Visa</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-master-card" value="credit-cards/mastercard">
            <label class="quiz-label" for="quiz-master-card">MasterCard</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-karta-mir" value="credit-cards/karta-mir">
            <label class="quiz-label" for="quiz-karta-mir">Мир</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-sberbank" value="credit-cards/platinum">
            <label class="quiz-label" for="quiz-sberbank">Platinum</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-visa" value="credit-cards/premium">
            <label class="quiz-label" for="quiz-visa">Premium</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-virtualnaya" value="credit-cards/virtualnye">
            <label class="quiz-label" for="quiz-virtualnaya">виртуальная</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-black" value="credit-cards/black">
            <label class="quiz-label" for="quiz-black">черная</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-elektronnaya" value="credit-cards/elektronnye">
            <label class="quiz-label" for="quiz-elektronnaya">Электронная</label>
        </span>
    </div>
</div>
    <div class="quiz-loan">
        <p class="quiz-title">для кого</p>
        <div class="quiz-checkboxes-and-labels d-flex">
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-pensioner" value="credit-cards/dlya-pensionerov">
                <label class="quiz-label" for="quiz-pensioner">Пенсионер</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-bezrabotniy" value="credit-cards/dlya-bezrabotnyh">
                <label class="quiz-label" for="quiz-bezrabotniy">безработный</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-molodyoj" value="credit-cards/molodejnie-karty">
                <label class="quiz-label" for="quiz-molodyoj">молодежь</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-v-dekrete" value="credit-cards/v-dekrete">
                <label class="quiz-label" for="quiz-v-dekrete">женщина в декрете</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-invalid" value="credit-cards/dlja-invalidov">
                <label class="quiz-label" for="quiz-invalid">инвалид</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-puteshestvennik" value="credit-cards/dlya-puteshestviy">
                <label class="quiz-label" for="quiz-puteshestvennik">путешественник</label>
            </span>
        </div>
    </div>
    <div class="quiz-div-history">
        <p class="quiz-subtitle">Кредитная история</p>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-bad-cr-history" value="credit-cards/plohaja-kreditnaja-istorija">
            <label class="quiz-label" for="quiz-bad-cr-history">Плохая</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-big-cr-history" value="credit-cards/bolshaya-nagruzka">
            <label class="quiz-label" for="quiz-big-cr-history">большая кредитная нагрузка</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-open-delays" value="credit-cards/s-prosrochkami">
            <label class="quiz-label" for="quiz-open-delays">Открытые просрочки</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-without-check" value="credit-cards/bez-proverok">
            <label class="quiz-label" for="quiz-without-check">Без проверки</label>
        </span>
    </div>
</div>
