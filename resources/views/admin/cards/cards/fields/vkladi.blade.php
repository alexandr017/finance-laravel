<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="heading1">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">Опции</a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
            <div class="panel-body">{options}</div>
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
                    <label for="percent_min"> Ставка % min:</label>
                    <input class="form-control" type="number" value="{percent_min}" name="percent_min" id="percent_min">
                </div>
                <div class="form-group">
                    <label for="percent_max"> Ставка % max:</label>
                    <input class="form-control" type="number" value="{percent_max}" name="percent_max" id="percent_max">
                </div>
                <div class="form-group">
                    <label for="currency"> Валюта:</label>
                    <input class="form-control" type="text" value="{currency}" name="currency" id="currency">
                </div>
                <div class="form-group">
                    <label for="term"> Срок вклада:</label>
                    <input class="form-control" type="text" value="{term}" name="term" id="term">
                </div>
                <div class="form-group">
                    <label for="sum_min"> Сумма мин. ₽:</label>
                    <input class="form-control" type="number" value="{sum_min}" name="sum_min" id="sum_min">
                </div>
                <div class="form-group">
                    <label for="sum_max"> Сумма макс. ₽:</label>
                    <input class="form-control" type="number" value="{sum_max}" name="sum_max" id="sum_max">
                </div>
                <div class="form-group">
                    <label for="term_min"> Срок мин.:</label>
                    <input class="form-control" type="number" value="{term_min}" name="term_min" id="term_min">
                </div>
                <div class="form-group">
                    <label for="term_max"> Срок макс.:</label>
                    <input class="form-control" type="number" value="{term_max}" name="term_max" id="term_max">
                </div>
                <div class="form-group">
                    <label for="replanishment"> Пополнение:</label>
                    <input class="form-control" type="text" value="{replanishment}" name="replanishment" id="replanishment">
                </div>
                <div class="form-group">
                    <label for="auto_prolongation"> Автопролонгация:</label>
                    <input class="form-control" type="text" value="{auto_prolongation}" name="auto_prolongation" id="auto_prolongation">
                </div>
                <div class="form-group">
                    <label for="partial_withdrawal"> Частичное снятие:</label>
                    <input class="form-control" type="text" value="{partial_withdrawal}" name="partial_withdrawal" id="partial_withdrawal">
                </div>
                <div class="form-group">
                    <label for="early_termination"> Досрочное расторжение:</label>
                    <input class="form-control" type="text" value="{early_termination}" name="early_termination" id="early_termination">
                </div>
                <div class="form-group">
                    <label for="investment_feature"> Особенность вклада:</label>
                    <input class="form-control" type="text" value="{investment_feature}" name="investment_feature" id="investment_feature">
                </div>
                <div class="form-group">
                    <label for="percents_payment"> Выплата процентов:</label>
                    <input class="form-control" type="text" value="{percents_payment}" name="percents_payment" id="percents_payment">
                </div>
                <div class="form-group">
                    <label for="capitalization"> Капитализация:</label>
                    <input class="form-control" type="text" value="{capitalization}" name="capitalization" id="capitalization">
                </div>
                <div class="form-group">
                    <label for="open_online"> Открытие вклада Online:</label>
                    <select class="form-control" type="number" name="open_online" id="open_online">
                        {open_online}
                    </select>
                </div>
                <div class="form-group">
                    <label for="special_conditions"> Особые условия:</label>
                    <input class="form-control" type="text" value="{special_conditions}" name="special_conditions" id="special_conditions">
                </div>
                <div class="form-group">
                    <label for="stock"> Акции:</label>
                    <input class="form-control" type="text" value="{stock}" name="stock" id="stock">
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
                <label for="text">Текст после шкал:</label>
                <textarea class="form-control" name="text" id="text" rows="8">{text}</textarea>
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