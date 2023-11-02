
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

                <div class="form-group">
                    <label for="">Иконки:</label>
                </div>
                {icon_after_name}

                <div class="form-group">
                    <label for="sum_min">Сумма min (руб):</label>
                    <input class="form-control" type="text" value="{sum_min}" name="sum_min" id="sum_min">
                </div>
                <div class="form-group">
                    <label for="sum_max">Сумма max (руб):</label>
                    <input class="form-control" type="text" value="{sum_max}" name="sum_max" id="sum_max">
                </div>
                <div class="form-group">
                    <label for="term_min">Срок min (дней):</label>
                    <input class="form-control" type="text" value="{term_min}" name="term_min" id="term_min">
                </div>
                <div class="form-group">
                    <label for="term_max">Срок max (дней):</label>
                    <input class="form-control" type="text" value="{term_max}" name="term_max" id="term_max">
                </div>
                <div class="form-group">
                    <label for="percent">Процентная ставка в неделю (%):</label>
                    <input class="form-control" type="text" value="{percent}" name="percent" id="percent">
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
                    <label for="repayment">Погашение:</label>
                    <input class="form-control" type="text" value="{repayment}" name="repayment" id="repayment">
                </div>
                <div class="form-group">
                    <label for="pay_method">Способ выплаты:</label>
                    <input class="form-control" type="text" value="{pay_method}" name="pay_method" id="pay_method">
                </div>
                <div class="form-group">
                    <label for="payment_method">Способ оплаты:</label>
                    <input class="form-control" type="text" value="{payment_method}" name="payment_method" id="payment_method">
                </div>
                <div class="form-group">
                    <label for="docs">Документы:</label>
                    <input class="form-control" type="text" value="{docs}" name="docs" id="docs">
                </div>
                <div class="form-group">
                    <label for="review_speed">Скорость рассмотрения заявки:</label>
                    <input class="form-control" type="text" value="{review_speed}" name="review_speed" id="review_speed">
                </div>
                <div class="form-group">
                    <label for="payout_speed">Скорость выплаты:</label>
                    <input class="form-control" type="text" value="{payout_speed}" name="payout_speed" id="payout_speed">
                </div>
                <div class="form-group">
                    <label for="identification">Идентификация:</label>
                    <input class="form-control" type="text" value="{identification}" name="identification" id="identification">
                </div>
                <div class="form-group">
                    <label for="schedule">График работы:</label>
                    <input class="form-control" type="text" value="{schedule}" name="schedule" id="schedule">
                </div>
                <div class="form-group">
                    <label for="poor_ch">Плохая КИ:</label>
                    <select class="form-control" name="poor_ch" id="poor_ch">
                        {poor_ch}
                    </select>
                </div>

                <div class="form-group">
                    <label for="extension">Продление:</label>
                    <input class="form-control" type="text" value="{extension}" name="extension" id="extension">
                </div>
                <div class="form-group">
                    <label for="investors">Инвесторам:</label>
                    <input class="form-control" type="text" value="{investors}" name="investors" id="investors">
                </div>
                <div class="form-group">
                    <label for="year">Год:</label>
                    <input class="form-control" type="text" value="{year}" name="year" id="year">
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
                <div class="form-group">
                    <label for="promocodes">Промокоды:</label>
                    <input class="form-control" type="text" value="{promocodes}" name="promocodes" id="promocodes">
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