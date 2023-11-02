
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

                <div class="form-group">
                    <label for="">Иконки:</label>
                </div>
                {icon_after_name}








                <div class="form-group">
                    <label for="sum_min">Сумма min (руб):</label>
                    <input class="form-control" type="number" value="{sum_min}" name="sum_min" id="sum_min">
                </div>
                <div class="form-group">
                    <label for="sum_max">Сумма max (руб):</label>
                    <input class="form-control" type="number" value="{sum_max}" name="sum_max" id="sum_max">
                </div>
                <div class="form-group">
                    <label for="term_min">Срок min (месяцев):</label>
                    <input class="form-control" type="number" value="{term_min}" name="term_min" id="term_min">
                </div>
                <div class="form-group">
                    <label for="term_max">Срок max (месяцев):</label>
                    <input class="form-control" type="number" value="{term_max}" name="term_max" id="term_max">
                </div>
                <div class="form-group">
                    <label for="percent_min">Процентная ставка min (%):</label>
                    <input class="form-control" type="number" value="{percent_min}" name="percent_min" id="percent_min" min="0" max="100" step="0.1">
                </div>
                <div class="form-group">
                    <label for="percent_max">Процентная ставка max (%):</label>
                    <input class="form-control" type="number" value="{percent_max}" name="percent_max" id="percent_max" min="0" max="100" step="0.1">
                </div>
                <div class="form-group">
                    <label for="age_min">Возраст min (лет):</label>
                    <input class="form-control" type="number" value="{age_min}" name="age_min" id="age_min">
                </div>
                <div class="form-group">
                    <label for="age_max">Возраст max (лет):</label>
                    <input class="form-control" type="number" value="{age_max}" name="age_max" id="age_max">
                </div>

                <div class="form-group">
                    <label for="licency">Лицензия:</label>
                    <input class="form-control" type="text" value="{licency}" name="licency" id="licency">
                </div>

                <div class="form-group">
                    <label for="security">Обеспечение:</label>
                    <input class="form-control" type="text" value="{security}" name="security" id="security">
                </div>

                <div class="form-group">
                    <label for="an_initial_fee">Первоначальный взнос:</label>
                    <input class="form-control" type="text" value="{an_initial_fee}" name="an_initial_fee" id="an_initial_fee">
                </div>

                <div class="form-group">
                    <label for="docs">Документы:</label>
                    <input class="form-control" type="text" value="{docs}" name="docs" id="docs">
                </div>
                <div class="form-group">
                    <label for="speed_see">Скорость рассмотрения заявки:</label>
                    <input class="form-control" type="text" value="{speed_see}" name="speed_see" id="speed_see">
                </div>
                <div class="form-group">
                    <label for="register">Регистрация:</label>
                    <input class="form-control" type="text" value="{register}" name="register" id="register">
                </div>
                <div class="form-group">
                    <label for="experience">Стаж:</label>
                    <input class="form-control" type="text" value="{experience}" name="experience" id="experience">
                </div>

                <div class="form-group">
                    <label for="income_verification">Подтверждение дохода:</label>
                    <input class="form-control" type="text" value="{income_verification}" name="income_verification" id="income_verification">
                </div>
                <div class="form-group">
                    <label for="transport_type">Тип транспорта:</label>
                    <input class="form-control" type="text" value="{transport_type}" name="transport_type" id="transport_type">
                </div>
                <div class="form-group">
                    <label for="borrower_category">Категория заемщика:</label>
                    <input class="form-control" type="text" value="{borrower_category}" name="borrower_category" id="borrower_category">
                </div>

                <div class="form-group">
                    <label for="additional">Дополнительно:</label>
                    <input class="form-control" type="text" value="{additional}" name="additional" id="additional">
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
                <!--
                <div class="form-group">
                    <label for="promo">Промокоды:</label>
                    <input class="form-control" type="text" value="{promo}" name="promo" id="promo">
                </div> -->


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