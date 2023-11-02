
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
    </div>
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
                <!-- {{ Form::select('informer_scale',['400' => '400', '600' => '600','1000'=>'1000'],1,['class'=>'form-control','id'=>'informer_scale'])}} -->
                </div>

            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="heading4">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4">Правая часть</a>
            </h4>
        </div>
        <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
            <div class="panel-body">

                <div style="font-size: 1.7rem"><b>Общие условия:</b></div>
                <div class="form-group">
                    <label for="sum_min">Сумма min (руб):</label>
                    <input class="form-control" type="text" value="{sum_min}" name="sum_min" id="sum_min">
                </div>
                <div class="form-group">
                    <label for="sum_max">Сумма max (руб):</label>
                    <input class="form-control" type="text" value="{sum_max}" name="sum_max" id="sum_max">
                </div>
                <div class="form-group">
                    <label for="an_initial_fee_min">Первоначальный взнос min (%):</label>
                    <input class="form-control" type="text" value="{an_initial_fee_min}" name="an_initial_fee_min" id="an_initial_fee_min">
                </div>
                <div class="form-group">
                    <label for="an_initial_fee_max">Первоначальный взнос max (%):</label>
                    <input class="form-control" type="text" value="{an_initial_fee_max}" name="an_initial_fee_max" id="an_initial_fee_max">
                </div>
                <div class="form-group">
                    <label for="term_min">Срок min (лет):</label>
                    <input class="form-control" type="text" value="{term_min}" name="term_min" id="term_min">
                </div>
                <div class="form-group">
                    <label for="term_max">Срок max (лет):</label>
                    <input class="form-control" type="text" value="{term_max}" name="term_max" id="term_max">
                </div>
                <div class="form-group">
                    <label for="percent_min">Процентная ставка min (%):</label>
                    <input class="form-control" type="text" value="{percent_min}" name="percent_min" id="percent_min">
                </div>
                <div class="form-group">
                    <label for="percent_max">Процентная ставка max (%):</label>
                    <input class="form-control" type="text" value="{percent_max}" name="percent_max" id="percent_max">
                </div>
                <div class="form-group">
                    <label for="target">Цель:</label>
                    <input class="form-control" type="text" value="{target}" name="target" id="target">
                </div>
                <div class="form-group">
                    <label for="procuring">Обеспечение:</label>
                    <input class="form-control" type="text" value="{procuring}" name="procuring" id="procuring">
                </div>


                <div class="form-group">
                    <label for="property_type">Тип недвижимости:</label>
                    <input class="form-control" type="text" value="{property_type}" name="property_type" id="property_type">
                </div>
                <div class="form-group">
                    <label for="income_verification">Подтверждение дохода:</label>
                    <input class="form-control" type="text" value="{income_verification}" name="income_verification" id="income_verification">
                </div>
                <div class="form-group">
                    <label for="mortgage_program">Ипотечная программа:</label>
                    <input class="form-control" type="text" value="{mortgage_program}" name="mortgage_program" id="mortgage_program">
                </div>
                <div class="form-group">
                    <label for="maternal_capital">Материнский капитал:</label>
                    <input class="form-control" type="text" value="{maternal_capital}" name="maternal_capital" id="maternal_capital">
                </div>

                <hr>
                <div style="font-size: 1.7rem"><b>Заемщик:</b></div>
                <div class="form-group">
                    <label for="borrower">Заемщик:</label>
                    <input class="form-control" type="text" value="{borrower}" name="borrower" id="borrower">
                </div>
                <div class="form-group">
                    <label for="age_min">Возраст min (лет):</label>
                    <input class="form-control" type="text" value="{age_min}" name="age_min" id="age_min">
                </div>
                <div class="form-group">
                    <label for="age_max">Возраст max (лет):</label>
                    <input class="form-control" type="text" value="{age_max}" name="age_max" id="age_max">
                </div>
                <div class="form-group">
                    <label for="experience">Стаж:</label>
                    <input class="form-control" type="text" value="{experience}" name="experience" id="experience">
                </div>
                <div class="form-group">
                    <label for="income_min">Примерный доход min (руб):</label>
                    <input class="form-control" type="text" value="{income_min}" name="income_min" id="income_min">
                </div>
                <div class="form-group">
                    <label for="income_max">Примерный доход max (руб):</label>
                    <input class="form-control" type="text" value="{income_max}" name="income_max" id="income_max">
                </div>

                <hr>
                <div style="font-size: 1.7rem"><b>Оформление:</b></div>
                <div class="form-group">
                    <label for="docs">Документы:</label>
                    <textarea class="form-control" name="docs" id="docs" rows="8">{docs}</textarea>
                </div>
                <div class="form-group">
                    <label for="review_speed">Скорость рассмотрения заявки:</label>
                    <input class="form-control" type="text" value="{review_speed}" name="review_speed" id="review_speed">
                </div>
                <div class="form-group">
                    <label for="validity_of_a_positive_decision">Срок действия положительного решения:</label>
                    <input class="form-control" type="text" value="{validity_of_a_positive_decision}" name="validity_of_a_positive_decision" id="validity_of_a_positive_decision">
                </div>
                <div class="form-group">
                    <label for="additionally_field">Дополнительно:</label>
                    <textarea class="form-control" name="additionally_field" id="additionally_field" rows="8">{additionally_field}</textarea>
                </div>


                <hr>
                <div style="font-size: 1.7rem"><b>Погашение:</b></div>
                <div class="form-group">
                    <label for="repayment_methods">Способы погашения:</label>
                    <input class="form-control" type="text" value="{repayment_methods}" name="repayment_methods" id="repayment_methods">
                </div>
                <div class="form-group">
                    <label for="payments">Платежи:</label>
                    <input class="form-control" type="text" value="{payments}" name="payments" id="payments">
                </div>
                <div class="form-group">
                    <label for="early_repayment">Досрочное погашение:</label>
                    <input class="form-control" type="text" value="{early_repayment}" name="early_repayment" id="early_repayment">
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
                    <label for="additional">Преимущества (Каждый пункт с новой строки):</label>
                    <textarea class="form-control" name="additional" id="additional" rows="8">{additional}</textarea>
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