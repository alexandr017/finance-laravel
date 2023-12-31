
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
                <label for="">Иконки:</label>
            </div>
            {icon_after_name}


            <div class="form-group">
                <label for="opened">Открытие (₽):</label>
                <input class="form-control" type="number" value="{opened}" name="opened" id="opened">
            </div>
            <div class="form-group">
                <label for="maintenance">Обслуживание (₽):</label>
                <input class="form-control" type="number" value="{maintenance}" name="maintenance" id="maintenance">
            </div>
            <div class="form-group">
                <label for="other_maintenance">Обслуживание дополнительно:</label>
                <input class="form-control" type="text" value="{other_maintenance}" name="other_maintenance" id="other_maintenance">
            </div>
            <div class="form-group">
                <label for="age_min">Возраст min (лет):</label>
                <input class="form-control" type="number" value="{age_min}" name="age_min" id="age_min">
            </div>
            <div class="form-group">
                <label for="age_max">Возраст max (лет):</label>
                <input class="form-control" type="number" value="{age_max}" name="age_max" id="age_max">
            </div>
            <hr>                    
            <div class="form-group">
                <label for="licency">Лицензия:</label>
                <input class="form-control" type="text" value="{licency}" name="licency" id="licency">
            </div> 
            <div class="form-group">
                <label for="docs">Документы:</label>
                <input class="form-control" type="text" value="{docs}" name="docs" id="docs">
            </div>
            <div class="form-group">
                <label for="register">Регистрация:</label>
                <input class="form-control" type="text" value="{register}" name="register" id="register">
            </div>
            <!--
            <div class="form-group">
                <label for="percent_on_balance">Лимит:</label>
                <input class="form-control" type="text" value="{percent_on_balance}" name="percent_on_balance" id="percent_on_balance">
            </div> -->
            <div class="form-group">
                <label for="cache_back">Кэшбэк:</label>
                <input class="form-control" type="text" value="{cache_back}" name="cache_back" id="cache_back">
            </div>
            <div class="form-group">
                <label for="additional">Дополнительно:</label>
                <input class="form-control" type="text" value="{additional}" name="additional" id="additional">
            </div>
            <div class="form-group">
                <label for="percent_on_balance">Процентная ставка min (%):</label>
                <input class="form-control" type="number" value="{percent_on_balance}" name="percent_on_balance" id="percent_on_balance" min="0" max="100" step="0.1">
            </div>
            <div class="form-group">
                <label for="age_work">Срок выпуска:</label>
                <input class="form-control" type="text" value="{age_work}" name="age_work" id="age_work">
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






<style type="text/css">
    .width-33{width: 33%;display: inline-block;}
</style>


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