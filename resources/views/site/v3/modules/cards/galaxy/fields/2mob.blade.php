<?php /*
@if($card->icon_after_name != null)
    <div class="pay-icons rko_cards">
        <?php
        $icons = $card->icon_after_name;
        $iconsArr = explode(',',$icons);
        foreach ($iconsArr as $key => $value) {
            echo "<span data-icon=\"$value\" class=\"rko-pic pic$value\"></span>";
        }
        ?>
    </div>
@endif

*/ ?>

<span class="rko-card-btn active">Общая информация <i class="fa fa-angle-up"></i></span>
<div class="rko-card-wrap active">

            @if(isset($card->opened)) @if(($card->opened!==null))
                <div class="lvc fa-clock-o">Открытие: <div class="value">{{$card->opened}} ₽</div></div>
            @endif @endif
            @if(isset($card->maintenance)) @if(($card->maintenance!==null))
                <div class="lvc fa-spinner">Обслуживание: <div class="value">{{$card->maintenance}} ₽</div></div>
            @endif @endif
            @if(isset($card->count_payment)) @if(($card->count_payment!==null))
                <div class="lvc fa-calculator">Платежка: <div class="value">{{$card->count_payment}} ₽</div></div>
            @endif @endif
            @if(isset($card->speed_opened)) @if(($card->speed_opened!==null))
                <div class="lvc fa-hourglass-o">Скорость открытия: <div class="value">{{$card->speed_opened}}</div></div>
            @endif @endif
            @if(isset($card->transfers_to_individuals)) @if(($card->transfers_to_individuals!==null))
                <div class="lvc fa-file-pdf-o">Переводы физическим лицам: <div class="value">{{$card->transfers_to_individuals}}</div></div>
            @endif @endif
            @if(isset($card->interest_on_balance)) @if(($card->interest_on_balance!==null))
                <div class="lvc fa-file-pdf-o">Процент на остаток: <div class="value">{{$card->interest_on_balance}}%</div></div>
            @endif @endif
            @if(isset($card->licency)) @if(($card->licency!==null))
                <div class="lvc fa-file-pdf-o">Лицензия: <div class="value">{{$card->licency}}</div></div>
            @endif @endif
            @if(isset($card->internet_bank)) @if(($card->internet_bank!==null))
                <div class="lvc fa-university">Интернет-банк: <div class="value">{{$card->internet_bank}}</div></div>
            @endif @endif
            @if(isset($card->mobile_bank)) @if(($card->mobile_bank!==null))
                <div class="lvc fa-mobile">Мобильный банк: <div class="value">{{$card->mobile_bank}}</div></div>
            @endif @endif
            @if(isset($card->sms_info)) @if(($card->sms_info!==null))
                <div class="lvc fa-envelope">СМС-информирование: <div class="value">{{$card->sms_info}}</div></div>
            @endif @endif

            @if(isset($card->docs)) @if(($card->docs!==null))
                <div class="lvc fa-address-card">Документы: <div class="value">{{$card->docs}}</div></div>
            @endif @endif
            @if(isset($card->set_payment)) @if(($card->set_payment!==null))
                <div class="lvc fa-money">Прием наличных: <div class="value">{{$card->set_payment}}</div></div>
            @endif @endif
            @if(isset($card->get_payment)) @if(($card->get_payment!==null))
                <div class="lvc fa-sign-language">Выдача наличных: <div class="value">{{$card->get_payment}}</div></div>
            @endif @endif
            @if(isset($card->additional_field)) @if(($card->additional_field!==null))
                <div class="lvc fa-newspaper-o">Дополнительно: <div class="value">{{$card->additional_field}}</div></div>
            @endif @endif

            @if(isset($card->onep_bonus)) @if(($card->onep_bonus!==null))
                <div class="lvc fa-hand-peace-o">Бонусы при открытии счета: <div class="value">{!!$card->onep_bonus!!}</div></div>
            @endif @endif

</div>


<span class="rko-card-btn">Эквайринг <i class="fa fa-angle-down"></i></span>
<div class="rko-card-wrap">
    @if(isset($card->intenernet_acquiring)) @if(($card->intenernet_acquiring!==null))
        <div class="lvc fa-credit-card-alt">Эквайринг: <div class="value">{{$card->intenernet_acquiring}}</div></div>
    @endif @endif
    @if(isset($card->acquiring_terms_connect)) @if(($card->acquiring_terms_connect!==null))
        <div class="lvc fa-clock-o">Сроки подключения: <div class="value">{{$card->acquiring_terms_connect}}</div></div>
    @endif @endif

    @if(isset($card->acquiring_support)) @if(($card->acquiring_support!==null))
        <div class="lvc fa-life-ring">Поддержка: <div class="value">{{$card->acquiring_support}}</div></div>
    @endif @endif
    @if(isset($card->support_module_for_shop)) @if(($card->support_module_for_shop!==null))
        <div class="lvc fa-cc-visa">Модули оплаты для интернет-магазинов: <div class="value">{{$card->support_module_for_shop}}</div></div>
    @endif @endif

    @if(isset($card->acquiring_terms_enlistment)) @if(($card->acquiring_terms_enlistment!==null))
        <div class="lvc fa-history">Сроки зачисления: <div class="value">{{$card->acquiring_terms_enlistment}}</div></div>
    @endif @endif
    @if(isset($card->acquiring_additional_services)) @if(($card->acquiring_additional_services!==null))
        <div class="lvc fa-user-plus">Дополнительные услуги: <div class="value">{{$card->acquiring_additional_services}}</div></div>
    @endif @endif
</div>

<span class="rko-card-btn">Зарплатный <br>проект <i class="fa fa-angle-down"></i></span>
<div class="rko-card-wrap">
    @if(isset($card->salary_project)) @if(($card->salary_project!==null))
        <div class="lvc fa-suitcase">Зарплатный проект: <div class="value">{{$card->salary_project}}</div></div>
    @endif @endif
    @if(isset($card->salary_project_speed)) @if(($card->salary_project_speed!==null))
        <div class="lvc fa-tachometer">Скорость подключения: <div class="value">{{$card->salary_project_speed}}</div></div>
    @endif @endif
    @if(isset($card->salary_project_additional_services)) @if(($card->salary_project_additional_services!==null))
        <div class="lvc fa-file-text-o">Дополнительные услуги: <div class="value">{{$card->salary_project_additional_services}}</div></div>
    @endif @endif
</div>

<span class="rko-card-btn" data-tab="4">Валютный <br>контроль <i class="fa fa-angle-down"></i></span>
<div class="rko-card-wrap rko-card-wrap-4" data-tab="4">
    @if(isset($card->currency_control)) @if(($card->currency_control!==null))
        <div class="lvc fa-usd">Валютный контроль: <div class="value">{{$card->currency_control}}</div></div>
    @endif @endif
    @if(isset($card->exchange_control_opened)) @if(($card->exchange_control_opened!==null))
        <div class="lvc fa-usd">Открытие счета в ин. валюте: <div class="value">{{$card->exchange_control_opened}}</div></div>
    @endif @endif
    @if(isset($card->exchange_control_account)) @if(($card->exchange_control_account!==null))
        <div class="lvc fa-rub">Ведение счета <div class="value">{{$card->exchange_control_account}}</div></div>
    @endif @endif
    @if(isset($card->salary_project_agent)) @if(($card->salary_project_agent!==null))
        <div class="lvc fa-percent">Агент по операциям резидентов: <div class="value">{{$card->salary_project_agent}}</div></div>
    @endif @endif
    @if(isset($card->exchange_control_passport)) @if(($card->exchange_control_passport!==null))
        <div class="lvc fa-credit-card-alt"><span style="display: flex">Постановка контракта на учет:</span> <div class="value">{{$card->exchange_control_passport}}</div></div>
    @endif @endif
    @if(isset($card->exchange_control_charge)) @if(($card->exchange_control_charge!==null))
        <div class="lvc fa-pencil-square-o">Платежка: <div class="value">{{$card->exchange_control_charge}}</div></div>
    @endif @endif
    @if(isset($card->exchange_control_reference)) @if(($card->exchange_control_reference!==null))
        <div class="lvc fa-id-card">Выдача справок: <div class="value">{{$card->exchange_control_reference}}</div></div>
    @endif @endif
    @if(isset($card->exchange_control_additional_services)) @if(($card->exchange_control_additional_services!==null))
        <div class="lvc fa-usd">Дополнительные услуги: <div class="value">{{$card->exchange_control_additional_services}}</div></div>
    @endif @endif
    @if(isset($card->spread)) @if(($card->spread!==null))
        <div class="lvc fa-file-pdf-o">Спред: <div class="value">{{$card->spread}}</div></div>
    @endif @endif
</div>


<span class="rko-card-btn">Корпоративные <br>карты <i class="fa fa-angle-down"></i></span>
<div class="rko-card-wrap">
    @if(isset($card->corporate_cards)) @if(($card->corporate_cards!==null))
        <div class="lvc fa-credit-card">Корпоративные карты: <div class="value">{{$card->corporate_cards}}</div></div>
    @endif @endif
</div>



<span class="rko-card-btn">Гарантии <i class="fa fa-angle-down"></i></span>
<div class="rko-card-wrap">
    @if(isset($card->guarantee_types)) @if(($card->guarantee_types!==null))
        <div class="lvc fa-id-badge">Виды: <div class="value">{{$card->guarantee_types}}</div></div>
    @endif @endif
    @if(isset($card->guarantee_sum)) @if(($card->guarantee_sum!==null))
        <div class="lvc fa-money">Сумма: <div class="value">{{$card->guarantee_sum}}</div></div>
    @endif @endif
    @if(isset($card->guarantee_commission)) @if(($card->guarantee_commission!==null))
        <div class="lvc fa-percent">Комиссия: <div class="value">{{$card->guarantee_commission}}</div></div>
    @endif @endif
    @if(isset($card->guarantee_secure)) @if(($card->guarantee_secure!==null))
        <div class="lvc fa-cubes">Обеспечение: <div class="value">{{$card->guarantee_secure}}</div></div>
    @endif @endif
    @if(isset($card->guarantee_project_speed)) @if(($card->guarantee_project_speed!==null))
        <div class="lvc fa-tachometer">Скорость выдачи: <div class="value">{{$card->guarantee_project_speed}}</div></div>
    @endif @endif
    @if(isset($card->guarantee_spec_account_speed)) @if(($card->guarantee_spec_account_speed!==null))
        <div class="lvc fa-id-card-o">Спецсчет для 44-ФЗ: <div class="value">{{$card->guarantee_spec_account_speed}}</div></div>
    @endif @endif
    @if(isset($card->guarantee_project_additional_services)) @if(($card->guarantee_project_additional_services!==null))
        <div class="lvc fa-newspaper-o">Дополнительно: <div class="value">{{$card->guarantee_project_additional_services}}</div></div>
    @endif @endif

</div>
