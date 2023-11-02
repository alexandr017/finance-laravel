<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-info">
    <div class="panel-heading" role="tab" id="heading1">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">Опции</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
        <div class="panel-body">
            {options}
        </div>
    </div>
  </div>
  <!--
  <div class="panel panel-info">
    <div class="panel-heading" role="tab" id="heading2">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">Шапка карточки</a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
        <div class="panel-body">

            <div class="form-group">
                <label for="header_1">Сумма:</label>
                <input class="form-control" type="text" value="{header_1}" name="header_1" id="header_1">
            </div>
            <div class="form-group">
                <label for="header_2">Срок:</label>
                <input class="form-control" type="text" value="{header_2}" name="header_2" id="header_2">
            </div>
            <div class="form-group">
                <label for="header_3">Процент:</label>
                <input class="form-control" type="text" value="{header_3}" name="header_3" id="header_3">
            </div>

        </div>
    </div>
  </div>  -->
  <!--
  <div class="panel panel-info">
    <div class="panel-heading" role="tab" id="heading3">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">Левая часть</a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
        <div class="panel-body">
            <div class="form-group">
                <label for="approval_indicator">Индикатор одобрения:</label>
                <input class="form-control" min="0" max="100" type="number" value="{approval_indicator}" name="approval_indicator" id="approval_indicator">
            </div>
            <div class="form-group">
                <label for="informer_scale">Шкала информера:</label>
                <select class="form-control" name="informer_scale" id="informer_scale">
                    {informer_scale}
                </select>
            </div>

        </div>
    </div>
  </div> -->

  <div class="panel panel-info">
    <div class="panel-heading" role="tab" id="heading4">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4">Правая часть</a>
      </h4>
    </div>
    <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
        <div class="panel-body">

            <div class="form-group">
                <label for="">Иконки:</label>
            </div>
            {icon_after_name}


            <div class="form-group">
                <label for="opened">Открытие (руб):</label>
                <input class="form-control" type="number" value="{opened}" name="opened" id="opened">
            </div>
            <div class="form-group">
                <label for="maintenance">Обслуживание (руб):</label>
                <input class="form-control" type="number" value="{maintenance}" name="maintenance" id="maintenance">
            </div>
            <div class="form-group">
                <label for="count_payment">Платежка:</label>
                <input class="form-control" type="number" value="{count_payment}" name="count_payment" id="count_payment">
            </div>
            <hr>
            <div class="form-group">
                <label for="speed_opened">Скорость открытия:</label>
                <input class="form-control" type="text" value="{speed_opened}" name="speed_opened" id="speed_opened">
            </div>
            <div class="form-group">
                <label for="transfers_to_individuals">Переводы физическим лицам:</label>
                <input class="form-control" type="text" value="{transfers_to_individuals}" name="transfers_to_individuals" id="transfers_to_individuals">
            </div>
            <div class="form-group">
                <label for="interest_on_balance">Процент на остаток:</label>
                <input class="form-control" type="number" value="{interest_on_balance}" name="interest_on_balance" id="interest_on_balance">
            </div>
            <div class="form-group">
                <label for="spread">Спред:</label>
                <input class="form-control" type="number" value="{spread}" name="spread" id="spread">
            </div>

            <div class="form-group">
                <label for="licency">Лицензия:</label>
                <input class="form-control" type="text" value="{licency}" name="licency" id="licency">
            </div>
            <div class="form-group">
                <label for="internet_bank">Интернет-банк:</label>
                <input class="form-control" type="text" value="{internet_bank}" name="internet_bank" id="internet_bank">
            </div>
            <div class="form-group">
                <label for="mobile_bank">Мобильный банк:</label>
                <input class="form-control" type="text" value="{mobile_bank}" name="mobile_bank" id="mobile_bank">
            </div>
            <div class="form-group">
                <label for="sms_info">СМС-информирование:</label>
                <input class="form-control" type="text" value="{sms_info}" name="sms_info" id="sms_info">
            </div>
            <div class="form-group">
                <label for="docs">Документы:</label>
                <input class="form-control" type="text" value="{docs}" name="docs" id="docs">
            </div>
            <div class="form-group">
                <label for="set_payment">Прием наличных:</label>
                <input class="form-control" type="text" value="{set_payment}" name="set_payment" id="set_payment">
            </div>            
            <div class="form-group">
                <label for="get_payment">Выдача наличных:</label>
                <input class="form-control" type="text" value="{get_payment}" name="get_payment" id="get_payment">
            </div> 
            <div class="form-group">
                <label for="additional">Дополнительно:</label>
                <input class="form-control" type="text" value="{additional_field}" name="additional" id="additional">
            </div>
            <div class="form-group">
                <label for="corporate_cards">Корпоративные карты:</label>
                <input class="form-control" type="text" value="{corporate_cards}" name="corporate_cards" id="corporate_cards">
            </div>  
            <div class="form-group">
                <label for="intenernet_acquiring">Эквайринг:</label>
                <input class="form-control" type="text" value="{intenernet_acquiring}" name="intenernet_acquiring" id="intenernet_acquiring">
            </div>   
            <div class="form-group">
                <label for="acquiring_terms_connect">Эквайринг (сроки подключения):</label>
                <input class="form-control" type="text" value="{acquiring_terms_connect}" name="acquiring_terms_connect" id="acquiring_terms_connect">
            </div>
       
            <div class="form-group">
                <label for="acquiring_support">Эквайринг (поддержка):</label>
                <input class="form-control" type="text" value="{acquiring_support}" name="acquiring_support" id="acquiring_support">
            </div> 
            <div class="form-group">
                <label for="support_module_for_shop">Эквайринг (модули оплаты для интернет-магазинов):</label>
                <input class="form-control" type="text" value="{support_module_for_shop}" name="support_module_for_shop" id="support_module_for_shop">
            </div>
     		<div class="form-group">
                <label for="acquiring_terms_enlistment">Эквайринг (сроки зачисления):</label>
                <input class="form-control" type="text" value="{acquiring_terms_enlistment}" name="acquiring_terms_enlistment" id="acquiring_terms_enlistment">
            </div> 
            <div class="form-group">
                <label for="acquiring_additional_services">Эквайринг (дополнительные услуги):</label>
                <input class="form-control" type="text" value="{acquiring_additional_services}" name="acquiring_additional_services" id="acquiring_additional_services">
            </div>
            <div class="form-group">
                <label for="salary_project">Зарплатный проект:</label>
                <input class="form-control" type="text" value="{salary_project}" name="salary_project" id="salary_project">
            </div> 
            <div class="form-group">
                <label for="salary_project_speed">Зарплатный проект (скорость подключения):</label>
                <input class="form-control" type="text" value="{salary_project_speed}" name="salary_project_speed" id="salary_project_speed">
            </div>
            <div class="form-group">
                <label for="salary_project_additional_services">Зарплатный проект (дополнительные услуги):</label>
                <input class="form-control" type="text" value="{salary_project_additional_services}" name="salary_project_additional_services" id="salary_project_additional_services">
            </div> 
            <div class="form-group">
                <label for="currency_control">Валютный контроль:</label>
                <input class="form-control" type="text" value="{currency_control}" name="currency_control" id="currency_control">
            </div>
            <div class="form-group">
                <label for="exchange_control_opened">Валютный контроль (открытие счета в ин. валюте):</label>
                <input class="form-control" type="text" value="{exchange_control_opened}" name="exchange_control_opened" id="exchange_control_opened">
            </div> 
            <div class="form-group">
                <label for="exchange_control_account">Валютный контроль (ведение счета):</label>
                <input class="form-control" type="text" value="{exchange_control_account}" name="exchange_control_account" id="exchange_control_account">
            </div>
            <div class="form-group">
                <label for="salary_project_agent">Валютный контроль (агент по операциям резидентов):</label>
                <input class="form-control" type="text" value="{salary_project_agent}" name="salary_project_agent" id="salary_project_agent">
            </div> 
            <div class="form-group">
                <label for="exchange_control_passport">Валютный контроль (постановка контракта на учет):</label>
                <input class="form-control" type="text" value="{exchange_control_passport}" name="exchange_control_passport" id="exchange_control_passport">
            </div>
            <div class="form-group">
                <label for="exchange_control_charge">Валютный контроль (платежка):</label>
                <input class="form-control" type="text" value="{exchange_control_charge}" name="exchange_control_charge" id="exchange_control_charge">
            </div> 
            <div class="form-group">
                <label for="exchange_control_reference">Валютный контроль (выдача справок):</label>
                <input class="form-control" type="text" value="{exchange_control_reference}" name="exchange_control_reference" id="exchange_control_reference">
            </div>
            <div class="form-group">
                <label for="exchange_control_additional_services">Валютный контроль (дополнительные услуги):</label>
                <input class="form-control" type="text" value="{exchange_control_additional_services}" name="exchange_control_additional_services" id="exchange_control_additional_services">
            </div> 
            <div class="form-group">
                <label for="onep_bonus">Бонусы при открытии счета:</label>
                <textarea class="form-control" name="onep_bonus" id="onep_bonus">{onep_bonus}</textarea>
            </div>

            <div class="form-group">
                <label for="guarantee_types">Гарантии (Виды):</label>
                <input type="text" class="form-control" name="guarantee_types" id="guarantee_types" value="{guarantee_types}">
            </div>
            <div class="form-group">
                <label for="guarantee_sum">Гарантии (Сумма):</label>
                <input type="text" class="form-control" name="guarantee_sum" id="guarantee_sum" value="{guarantee_sum}">
            </div>
            <div class="form-group">
                <label for="guarantee_commission">Гарантии (Комиссия):</label>
                <input type="text" class="form-control" name="guarantee_commission" id="guarantee_commission" value="{guarantee_commission}">
            </div>
            <div class="form-group">
                <label for="guarantee_secure">Гарантии (Обеспечение):</label>
                <input type="text" class="form-control" name="guarantee_secure" id="guarantee_secure" value="{guarantee_secure}">
            </div>
            <div class="form-group">
                <label for="guarantee_project_speed">Гарантии (Скорость выдачи):</label>
                <input type="text" class="form-control" name="guarantee_project_speed" id="guarantee_project_speed" value="{guarantee_project_speed}">
            </div>
            <div class="form-group">
                <label for="guarantee_spec_account_speed">Гарантии (Спецсчет для 44-ФЗ):</label>
                <input type="text" class="form-control" name="guarantee_spec_account_speed" id="guarantee_spec_account_speed" value="{guarantee_spec_account_speed}">
            </div>
            <div class="form-group">
                <label for="guarantee_project_additional_services">Гарантии (Дополнительно):</label>
                <input type="text" class="form-control" name="guarantee_project_additional_services" id="guarantee_project_additional_services" value="{guarantee_project_additional_services}">
            </div>

        </div>

    </div>
  </div>


    <div class="panel panel-info">
    <div class="panel-heading" role="tab" id="heading5">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="collapse5">Преимущества</a>
      </h4>
    </div>
    <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
        <div class="panel-body">
            <div class="form-group">
                <label for="advantages">Преимущества (Каждый пункт с новой строки):</label>
                <textarea class="form-control" name="advantages" id="advantages" rows="8">{advantages}</textarea>
            </div>
        </div>
    </div>
    </div>


    <div class="panel panel-info">
    <div class="panel-heading" role="tab" id="heading6">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="false" aria-controls="collapse6">Скрытая часть</a>
      </h4>
    </div>
    <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading6">
        <div class="panel-body">
            <div class="form-group">
                <label for="text">Текст после шкал:</label>
                <textarea class="form-control" name="text" id="text" rows="8">{text}</textarea>
            </div>
        </div>
    </div>
    </div>    


</div>







<script type="text/javascript">

$('#addItem').on('click',function(e){
    e.preventDefault();
    var code = '<div class="row">'+
        '<div class="col-md-5"><input type="text" class="form-control idt"></div>'+
        '<div class="col-md-5"><input type="text" class="form-control lab"></div>'+
        '<div class="col-md-2"><button class="removeItem btn btn-danger"><i class="fa fa-remove"></i></button></div>'+
    '<br><br></div>';
    $('#fileds').append(code);
});

$(document).on('click','.removeItem',function(e){
    e.preventDefault();
    $(this).parent().parent().remove();
});

$('form').on('submit',function(){
    var idTitles = [];
    $('.idt').each(function(){
        idTitles.push($(this).val());
    });
    var LabelArr = [];
    $('.lab').each(function(){
        LabelArr.push($(this).val());
    });

    var res = [];
    var tmp = {};
    var count = idTitles.length;
    for(var i=0; i<count; i++){
        tmp ['id_title'] = idTitles[i];
        tmp ['label'] = LabelArr[i];
        res.push(tmp);
        tmp = {};
    }
    var json = JSON.stringify(res);
    $('#options_json').val(json);
});

</script>