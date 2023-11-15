
        @if(isset($card->opened)) @if(($card->opened!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Открытие:</b>
                {{$card->opened}} ₽
            </p>
        @endif @endif
        @if(isset($card->maintenance)) @if(($card->maintenance!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Обслуживание:</b>
                {{$card->maintenance}} ₽
            </p>
        @endif @endif
        @if(isset($card->count_payment)) @if(($card->count_payment!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Платежка:</b>
                {{$card->count_payment}} ₽
            </p>
        @endif @endif
        @if(isset($card->speed_opened)) @if(($card->speed_opened!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Скорость открытия:</b>
                {{$card->speed_opened}}
            </p>
        @endif @endif
        @if(isset($card->licency)) @if(($card->licency!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Лицензия:</b>
                {{$card->licency}}
            </p>
        @endif @endif
        @if(isset($card->internet_bank)) @if(($card->internet_bank!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Интернет-банк:</b>
                {{$card->internet_bank}}
            </p>
        @endif @endif
        @if(isset($card->mobile_bank)) @if(($card->mobile_bank!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Мобильный банк:</b>
                {{$card->mobile_bank}}
            </p>
        @endif @endif
        @if(isset($card->sms_info)) @if(($card->sms_info!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">СМС-информирование:</b>
                {{$card->sms_info}}
            </p>
        @endif @endif
        @if(isset($card->docs)) @if(($card->docs!==null))
            <p class="border-left border-right bg-grey">
              <b class="label">Документы:</b>
                {{$card->docs}}
            </p>
        @endif @endif
        @if(isset($card->set_payment)) @if(($card->set_payment!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Прием наличных:</b>
                {{$card->set_payment}}
            </p>
        @endif @endif
        @if(isset($card->get_payment)) @if(($card->get_payment!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Выдача наличных:</b>
                {{$card->get_payment}}
            </p>
        @endif @endif
        @if(isset($card->additional_field)) @if(($card->additional_field!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Дополнительно:</b>
                {{$card->additional_field}}
            </p>
        @endif @endif
        @if(isset($card->corporate_cards)) @if(($card->corporate_cards!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Корпоративные карты:</b>
                {{$card->corporate_cards}}
            </p>
        @endif @endif
        @if(isset($card->intenernet_acquiring)) @if(($card->intenernet_acquiring!==null))
            <p class="border-left border-right bg-grey">
              <b class="label">Эквайринг:</b>
                {{$card->intenernet_acquiring}}
            </p>
        @endif @endif
        @if(isset($card->acquiring_terms_connect)) @if(($card->acquiring_terms_connect!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Эквайринг (сроки подключения):</b>
                {{$card->acquiring_terms_connect}}
            </p>
        @endif @endif
        @if(isset($card->acquiring_support)) @if(($card->acquiring_support!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Эквайринг (поддержка):</b>
                {{$card->acquiring_support}}
            </p>
        @endif @endif
        @if(isset($card->support_module_for_shop)) @if(($card->support_module_for_shop!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Эквайринг (модули оплаты для интернет-магазинов):</b>
                {{$card->support_module_for_shop}}
            </p>
        @endif @endif
        @if(isset($card->acquiring_terms_enlistment)) @if(($card->acquiring_terms_enlistment!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Эквайринг (сроки зачисления):</b>
                {{$card->acquiring_terms_enlistment}}
            </p>
        @endif @endif
        @if(isset($card->acquiring_additional_services)) @if(($card->acquiring_additional_services!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Эквайринг (дополнительные услуги):</b>
                {{$card->acquiring_additional_services}}
            </p>
        @endif @endif
        @if(isset($card->salary_project)) @if(($card->salary_project!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Зарплатный проект:</b>
                {{$card->salary_project}}
            </p>
        @endif @endif
        @if(isset($card->salary_project_speed)) @if(($card->salary_project_speed!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Зарплатный проект (скорость подключения):</b>
                {{$card->salary_project_speed}}
            </p>
        @endif @endif
        @if(isset($card->salary_project_additional_services)) @if(($card->salary_project_additional_services!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Зарплатный проект:</b>
                {{$card->salary_project_additional_services}}
            </p>
        @endif @endif
        @if(isset($card->currency_control)) @if(($card->currency_control!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Валютный контроль:</b>
                {{$card->currency_control}}
            </p>
        @endif @endif
        @if(isset($card->exchange_control_opened)) @if(($card->exchange_control_opened!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Валютный контроль (открытие счета в ин. валюте):</b>
                {{$card->exchange_control_opened}}
            </p>
        @endif @endif
        @if(isset($card->exchange_control_account)) @if(($card->exchange_control_account!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Валютный контроль (ведение счета)</b>
                {{$card->exchange_control_account}}
            </p>
        @endif @endif
        @if(isset($card->salary_project_agent)) @if(($card->salary_project_agent!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Валютный контроль (агент по операциям резидентов):</b>
                {{$card->salary_project_agent}}
            </p>
        @endif @endif
        @if(isset($card->exchange_control_passport)) @if(($card->exchange_control_passport!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Валютный контроль (постановка контракта на учет):</b>
                {{$card->exchange_control_passport}}
            </p>
        @endif @endif
        @if(isset($card->exchange_control_charge)) @if(($card->exchange_control_charge!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Валютный контроль (платежка):</b>
                {{$card->exchange_control_charge}}
            </p>
        @endif @endif
        @if(isset($card->exchange_control_reference)) @if(($card->exchange_control_reference!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Валютный контроль (выдача справок):</b>
                {{$card->exchange_control_reference}}
            </p>
        @endif @endif
        @if(isset($card->exchange_control_additional_services)) @if(($card->exchange_control_additional_services!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Валютный контроль:</b>
                {{$card->exchange_control_additional_services}}
            </p>
        @endif @endif
        @if(isset($card->onep_bonus)) @if(($card->onep_bonus!==null))
            <p class="border-left border-right bg-grey">
                <b class="label">Бонусы при открытии счета:</b>
                {!!$card->onep_bonus!!}
            </p>
        @endif @endif