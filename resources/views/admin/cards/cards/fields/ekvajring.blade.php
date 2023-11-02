
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="heading1">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">Условия</a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
            <div class="panel-body">
                <div class="form-group">
                    <label for="type_of_acquiring">Вид эквайринга:</label>
                    <select class="form-control" name="type_of_acquiring" id="type_of_acquiring">
                        {type_of_acquiring}
                    </select>
                </div>
                <div class="form-group">
                    <label for="maintenance_min">Обслуживание (min):</label>
                    <input class="form-control" type="text" value="{maintenance_min}" name="maintenance_min" id="maintenance_min">
                </div>
                <div class="form-group">
                    <label for="maintenance_max">Обслуживание (max):</label>
                    <input class="form-control" type="text" value="{maintenance_max}" name="maintenance_max" id="maintenance_max">
                </div>
                <div class="form-group">
                    <label for="commission_min">Комиссия (min):</label>
                    <input class="form-control" type="text" value="{commission_min}" name="commission_min" id="commission_min">
                </div>
                <div class="form-group">
                    <label for="commission_max">Комиссия (max):</label>
                    <input class="form-control" type="text" value="{commission_max}" name="commission_max" id="commission_max">
                </div>
                <div class="form-group">
                    <label for="field_of_activity">Сфера деятельности:</label>
                    <input class="form-control" type="text" value="{field_of_activity}" name="field_of_activity" id="field_of_activity">
                </div>
                <div class="form-group">
                    <label for="terminal_rental">Аренда терминала:</label>
                    <input class="form-control" type="text" value="{terminal_rental}" name="terminal_rental" id="terminal_rental">
                </div>
                <div class="form-group">
                    <label for="accepted_cards">Принимаемые карты:</label>
                    <input class="form-control" type="text" value="{accepted_cards}" name="accepted_cards" id="accepted_cards">
                </div>
                <div class="form-group">
                    <label for="types_of_payment_terminals">Виды платежный терминалов:</label>
                    <input class="form-control" type="text" value="{types_of_payment_terminals}" name="types_of_payment_terminals" id="types_of_payment_terminals">
                </div>
                <div class="form-group">
                    <label for="speed_of_enrollment">Скорость зачисления:</label>
                    <input class="form-control" type="text" value="{speed_of_enrollment}" name="speed_of_enrollment" id="speed_of_enrollment">
                </div>
                <div class="form-group">
                    <label for="support">Поддержка:</label>
                    <input class="form-control" type="text" value="{support}" name="support" id="support">
                </div>
                <div class="form-group">
                    <label for="connection_cost">Стоимость подключения:</label>
                    <input class="form-control" type="text" value="{connection_cost}" name="connection_cost" id="connection_cost">
                </div>
                <div class="form-group">
                    <label for="connection_terms">Сроки подключения:</label>
                    <input class="form-control" type="text" value="{connection_terms}" name="connection_terms" id="connection_terms">
                </div>
                <div class="form-group">
                    <label for="modules_for_online_stores">Модули оплаты для интернет-магазинов:</label>
                    <input class="form-control" type="text" value="{modules_for_online_stores}" name="modules_for_online_stores" id="modules_for_online_stores">
                </div>
                <div class="form-group">
                    <label for="additional_services">Дополнительные услуги:</label>
                    <input class="form-control" type="text" value="{additional_services}" name="additional_services" id="additional_services">
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="heading2">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">QR-эквайринг</a>
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
            <div class="panel-body">
                <div class="form-group">
                    <label for="rate_qr_code">Ставка при оплате по QR-коду:</label>
                    <input class="form-control" type="text" value="{rate_qr_code}" name="rate_qr_code" id="rate_qr_code">
                </div>
                <div class="form-group">
                    <label for="government_payments">Государственные платежи:</label>
                    <input class="form-control" type="text" value="{government_payments}" name="government_payments" id="government_payments">
                </div>
                <div class="form-group">
                    <label for="everyday_goods">Товары повседневного спроса, медицина, транспорт, ЖКХ:</label>
                    <input class="form-control" type="text" value="{everyday_goods}" name="everyday_goods" id="everyday_goods">
                </div>
                <div class="form-group">
                    <label for="for_all_other">Для всех остальных:</label>
                    <input class="form-control" type="text" value="{for_all_other}" name="for_all_other" id="for_all_other">
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="heading3">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapse3">Тарифы</a>
            </h4>
        </div>
        <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
            <div class="panel-body">
                <div class="form-group">
                    <label for="tariffs">Тарифы:</label>
                    <textarea class="form-control" name="tariffs" id="tariffs" rows="8">{tariffs}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="heading4">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse4">О продукте</a>
            </h4>
        </div>
        <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
            <div class="panel-body">
                <div class="form-group">
                    <label for="about_product">О продукте:</label>
                    <textarea class="form-control" name="about_product" id="about_product" rows="8">{about_product}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="heading5">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="true" aria-controls="collapse5">Преимущества</a>
            </h4>
        </div>
        <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
            <div class="panel-body">
                <div class="form-group">
                    <label for="advantages">Преимущества:</label>
                    <textarea class="form-control" name="advantages" id="advantages" rows="8">{advantages}</textarea>
                </div>
            </div>
        </div>
    </div>



</div>


