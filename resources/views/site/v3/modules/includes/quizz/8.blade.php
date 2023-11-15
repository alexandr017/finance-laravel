<div class="quiz-adv-search-first-block">
     <span class="quiz-div-label">
         <label class="quiz-label" for="quiz-perc-per-year">Процент в год</label>
         <input type="number" pattern="[0-9]" min="0" id="quiz-perc-per-year">
     </span>
     <span class="quiz-div-label">
         <label class="quiz-label" for="quiz-age">Возраст</label>
         <input type="number" pattern="[0-9]" min="0" id="quiz-age">
     </span>
     <span class="quiz-div-label">
         <label class="quiz-label" for="quiz-autocredit-first-pay">Первоначальный взнос</label>
         <input type="number" pattern="[0-9]" min="0" id="quiz-autocredit-first-pay" disabled>
         <label class="quiz-label" for="quiz-autocredit-first-pay">₽</label>
     </span>
</div>
<div class="quiz-adv-search-second-block d-flex quiz-bordered-block">
    <div class="quiz-left">
        <p class="quiz-subtitle">Документы</p>
        <div class="quiz-checkboxes-and-labels d-flex">
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-passport" value="autocredit/po-pasportu" checked disabled="true">
                <label class="quiz-label" for="quiz-passport">Паспорт</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-bez-spravki" value="autocredit/bez-spravok">
                <label class="quiz-label" for="quiz-bez-spravki">Без справки о доходах</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-two-docs" value="autocredit/po-2-dokumentam">
                <label class="quiz-label" for="quiz-two-docs">2 документа</label>
            </span>
            <span class="quiz-checkbox-margin">
                <input type="checkbox" id="quiz-bez-prav" value="autocredit/bez-prav">
                <label class="quiz-label" for="quiz-bez-prav">Без прав</label>
            </span>
        </div>
    </div>
    <div class="quiz-right">
        <p class="quiz-subtitle">Заемщик</p>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-pensioner" value="autocredit/pensioneram">
            <label class="quiz-label" for="quiz-pensioner">Пенсионер</label>
        </span>
        <span class="quiz-checkbox-margin">
            <input type="checkbox" id="quiz-bezrabotniy" value="autocredit/bezrabotnym">
            <label class="quiz-label" for="quiz-bezrabotniy">Безработный</label>
        </span>
    </div>
</div>
</div>
<br class="clearfix">