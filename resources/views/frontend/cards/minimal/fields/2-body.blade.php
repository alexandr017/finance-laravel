<ul class="nav">
    <li class="active" data-tab="card-mn-conditions">Общая информация</li>
    <li data-tab="card-mn-acquiring">Эквайринг</li>
    <li data-tab="card-mn-salary">Зарплатный проект</li>
    <li data-tab="card-mn-currency">Валютный контроль</li>
    <li data-tab="card-mn-corp-cards">Корпоративные карты</li>
    <li data-tab="card-mn-guarantee">Гарантии</li>
</ul>
<div class="card-mn-tab-content">
    <div class="active card-mn-conditions">
        @if(isset($card->opened) && $card->opened !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Открытие</span>
                <b class="card-mn-row-value">{{$card->opened}}</b>
            </div>
        @endif
        @if(isset($card->maintenance) && $card->maintenance!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Обслуживание</span>
                <b class="card-mn-row-value">{{$card->maintenance}} руб.</b>
            </div>
        @endif
        @if(isset($card->count_payment) && $card->count_payment!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Платежка</span>
                <b class="card-mn-row-value">{{$card->count_payment}}руб.</b>
            </div>
        @endif
        @if(isset($card->speed_opened) && $card->speed_opened!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Скорость открытия:</span>
                <b class="card-mn-row-value">{{$card->speed_opened}}</b>
            </div>
        @endif
        @if(isset($card->transfers_to_individuals) && $card->transfers_to_individuals!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Переводы физическим лицам:</span>
                <b class="card-mn-row-value">{{$card->transfers_to_individuals}}</b>
            </div>
        @endif
        @if(isset($card->interest_on_balance) && $card->interest_on_balance!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Процент на остаток:</span>
                <b class="card-mn-row-value">{{$card->interest_on_balance}}%</b>
            </div>
        @endif
        @if(isset($card->licency) && $card->licency!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Лицензия:</span>
                <b class="card-mn-row-value">{{$card->licency}}</b>
            </div>
        @endif
        @if(isset($card->internet_bank) && $card->internet_bank!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Интернет-банк:</span>
                <b class="card-mn-row-value">{{$card->internet_bank}}</b>
            </div>
        @endif
        @if(isset($card->mobile_bank) && $card->mobile_bank!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Мобильный банк</span>
                <b class="card-mn-row-value">{{$card->mobile_bank
}}</b>
            </div>
        @endif
        @if(isset($card->sms_info) && $card->sms_info!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">СМС-информирование</span>
                <b class="card-mn-row-value">{{$card->sms_info}}</b>
            </div>
        @endif
        @if(isset($card->docs) && $card->docs!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Документы</span>
                <b class="card-mn-row-value">{{$card->docs}}</b>
            </div>
        @endif
        @if(isset($card->set_payment) && $card->set_payment!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Прием наличных</span>
                <b class="card-mn-row-value">{{$card->set_payment}}</b>
            </div>
        @endif
        @if(isset($card->get_payment) && $card->get_payment!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Выдача наличных</span>
                <b class="card-mn-row-value">{{$card->get_payment}}</b>
            </div>
        @endif
        @if(isset($card->additional_field) && $card->additional_field!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Дополнительно</span>
                <b class="card-mn-row-value">{{$card->additional_field}}</b>
            </div>
        @endif

        @if(isset($card->onep_bonus) && $card->onep_bonus!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Бонусы при открытии счета:</span>
                <b class="card-mn-row-value">{!!$card->onep_bonus!!}</b>
            </div>
        @endif
    </div>
    <div class="card-mn-acquiring card-mn-tab-pane">
        @if(isset($card->intenernet_acquiring) && $card->intenernet_acquiring!==null)
        <div class="card-mn-row">
            <span class="card-mn-details">Эквайринг</span>
            <b class="card-mn-row-value">{{$card->intenernet_acquiring}}</b>
        </div>
        @endif
        @if(isset($card->acquiring_terms_connect) && $card->acquiring_terms_connect!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Сроки подключения</span>
                <b class="card-mn-row-value">{{$card->acquiring_terms_connect}}</b>
            </div>
        @endif
        @if(isset($card->acquiring_support) && $card->acquiring_support!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Поддержка</span>
                <b class="card-mn-row-value">{{$card->acquiring_support}}</b>
            </div>
        @endif
        @if(isset($card->support_module_for_shop) && $card->support_module_for_shop!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Модули оплаты для интернет-магазинов</span>
                <b class="card-mn-row-value">{{$card->support_module_for_shop}}</b>
            </div>
        @endif
        @if(isset($card->acquiring_terms_enlistment) && $card->acquiring_terms_enlistment!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Сроки зачисления</span>
                <b class="card-mn-row-value">{{$card->acquiring_terms_enlistment}}</b>
            </div>
        @endif
        @if(isset($card->acquiring_additional_services) && $card->acquiring_additional_services!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Дополнительные услуги</span>
                <b class="card-mn-row-value">{{$card->acquiring_additional_services}}</b>
            </div>
        @endif
    </div>
    <div class="card-mn-salary card-mn-tab-pane">
        @if(isset($card->salary_project) && $card->salary_project!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Зарплатный проект</span>
                <b class="card-mn-row-value">{{$card->salary_project}}</b>
            </div>
        @endif
        @if(isset($card->salary_project_speed) && $card->salary_project_speed!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Скорость подключения</span>
                <b class="card-mn-row-value">{{$card->salary_project_speed}}</b>
            </div>
        @endif
        @if(isset($card->salary_project_additional_services) && $card->salary_project_additional_services!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Дополнительные услуги</span>
                <b class="card-mn-row-value">{{$card->salary_project_additional_services}}</b>
            </div>
        @endif
    </div>
    <div class="card-mn-currency card-mn-tab-pane">
        @if(isset($card->currency_control) && $card->currency_control!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Валютный контроль</span>
                <b class="card-mn-row-value">{{$card->currency_control}}</b>
            </div>
        @endif
        @if(isset($card->exchange_control_opened) && $card->exchange_control_opened!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Открытие счета в ин. валюте</span>
                <b class="card-mn-row-value">{{$card->exchange_control_opened}}</b>
            </div>
        @endif
        @if(isset($card->exchange_control_account) && $card->exchange_control_account!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Ведение счета</span>
                <b class="card-mn-row-value">{{$card->exchange_control_account}}</b>
            </div>
        @endif
        @if(isset($card->salary_project_agent) && $card->salary_project_agent!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Агент по операциям резидентов</span>
                <b class="card-mn-row-value">{{$card->salary_project_agent}}</b>
            </div>
        @endif
        @if(isset($card->exchange_control_passport) && $card->exchange_control_passport!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Постановка контракта на учет</span>
                <b class="card-mn-row-value">{{$card->exchange_control_passport}}</b>
            </div>
        @endif
        @if(isset($card->exchange_control_charge) && $card->exchange_control_charge!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Платежка</span>
                <b class="card-mn-row-value">{{$card->exchange_control_charge}}</b>
            </div>
        @endif
        @if(isset($card->exchange_control_reference) && $card->exchange_control_reference!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Выдача справок</span>
                <b class="card-mn-row-value">{{$card->exchange_control_reference}}</b>
            </div>
        @endif
        @if(isset($card->exchange_control_additional_services) && $card->exchange_control_additional_services!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Дополнительные услуги</span>
                <b class="card-mn-row-value">{{$card->exchange_control_additional_services}}</b>
            </div>
        @endif
        @if(isset($card->spread) && $card->spread!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Спред</span>
                <b class="card-mn-row-value">{{$card->spread}}</b>
            </div>
        @endif
    </div>
    <div class="card-mn-corp-cards card-mn-tab-pane">
        @if(isset($card->corporate_cards) && $card->corporate_cards!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Корпоративные карты</span>
                <b class="card-mn-row-value">{{$card->corporate_cards}}</b>
            </div>
        @endif
    </div>
    <div class="card-mn-guarantee card-mn-tab-pane">
        @if(isset($card->guarantee_types) && $card->guarantee_types!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Виды</span>
                <b class="card-mn-row-value">{{$card->guarantee_types}}</b>
            </div>
        @endif
        @if(isset($card->guarantee_sum) && $card->guarantee_sum!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Сумма</span>
                <b class="card-mn-row-value">{{$card->guarantee_sum}}</b>
            </div>
        @endif
        @if(isset($card->guarantee_commission) && $card->guarantee_commission!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Комиссия</span>
                <b class="card-mn-row-value">{{$card->guarantee_commission}}</b>
            </div>
        @endif
        @if(isset($card->guarantee_secure) && $card->guarantee_secure!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Обеспечение</span>
                <b class="card-mn-row-value">{{$card->guarantee_secure}}</b>
            </div>
        @endif
        @if(isset($card->guarantee_project_speed) && $card->guarantee_project_speed!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Скорость выдачи</span>
                <b class="card-mn-row-value">{{$card->guarantee_project_speed}}</b>
            </div>
        @endif
        @if(isset($card->guarantee_spec_account_speed) && $card->guarantee_spec_account_speed!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Спецсчет для 44-ФЗ</span>
                <b class="card-mn-row-value">{{$card->guarantee_spec_account_speed}}</b>
            </div>
        @endif
        @if(isset($card->guarantee_project_additional_services) && $card->guarantee_project_additional_services!==null)
            <div class="card-mn-row">
                <span class="card-mn-details">Дополнительно</span>
                <b class="card-mn-row-value">{{$card->guarantee_project_additional_services}}</b>
            </div>
        @endif
    </div>
</div>