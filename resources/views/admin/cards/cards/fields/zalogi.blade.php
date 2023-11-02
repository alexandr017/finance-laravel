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
    <div class="panel-heading" role="tab" id="heading4">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4">Правая часть</a>
      </h4>
    </div>
    <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
        <div class="panel-body">
            <div class="form-group">
                <label for="zalog_type">Виды залога:</label>
                <input class="form-control" type="text" value="{zalog_type}" name="zalog_type" id="zalog_type">
            </div>
            <div class="form-group">
                <label for="sum_min">Сумма min (руб):</label>
                <input class="form-control" type="number" value="{sum_min}" name="sum_min" id="sum_min">
            </div>
            <div class="form-group">
                <label for="sum_max">Сумма max (руб):</label>
                <input class="form-control" type="number" value="{sum_max}" name="sum_max" id="sum_max">
            </div>

            <div class="form-group">
                <label for="term_min">Срок min (дней):</label>
                <input class="form-control" type="number" value="{term_min}" name="term_min" id="term_min">
            </div>
            <div class="form-group">
                <label for="term_max">Срок max (дней):</label>
                <input class="form-control" type="number" value="{term_max}" name="term_max" id="term_max">
            </div>
            <div class="form-group">
                <label for="percent_min">Процентная ставка (%):</label>
                <input class="form-control" type="number" value="{percent_min}" name="percent_min" id="percent_min" min="0" max="100" step="0.1">
            </div>
            <div class="form-group">
                <label for="percent_max">Процентная ставка max (%):</label>
                <input class="form-control" type="number" value="{percent_max}" name="percent_max" id="percent_max" min="0" max="100" step="0.1">
            </div>
            <hr>
            <div class="form-group">
                <label for="year">Год:</label>
                <input class="form-control" type="number" value="{year}" name="year" id="year">
            </div>
            <div class="form-group">
                <label for="licency">Лицензия:</label>
                <input class="form-control" type="text" value="{licency}" name="licency" id="licency">
            </div>
            <div class="form-group">
                <label for="docs">Документы:</label>
                <input class="form-control" type="text" value="{docs}" name="docs" id="docs">
            </div>
            <div class="form-group">
                <label for="work_time">График работы:</label>
                <input class="form-control" type="text" value="{work_time}" name="work_time" id="work_time">
            </div>            
            <div class="form-group">
                <label for="repayment">Выкуп:</label>
                <input class="form-control" type="text" value="{repayment}" name="repayment" id="repayment">
            </div>
            <div class="form-group">
                <label for="investors">Инвесторам:</label>
                <input class="form-control" type="text" value="{investors}" name="investors" id="investors">
            </div>            
            <div class="form-group">
                <label for="additional">Дополнительно:</label>
                <input class="form-control" type="text" value="{additional_field}" name="additional" id="additional">
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
                <textarea class="form-control" name="advantages" id="advantages" rows="8">{additional}</textarea>
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