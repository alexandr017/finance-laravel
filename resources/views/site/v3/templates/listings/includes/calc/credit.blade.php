<?php /*<h2 class="calc-block-title">Подбор кредита</h2> */ ?>
<div class="credit-calc-wrap">
    

<form action="#" id="credit-calc">
<div class="row">
    <div class="col-md-6">
        <div class="fields-wrap">
            <label for="credit-sum">Сумма кредита</label>
            <i class="fa fa-question-circle-o i-hint"></i>
            <span class="hint">Укажите желаемую сумму кредита</span><br>
        <div class="fields-wrap summ-wrap">
            <input type="text" value="500 000" id="credit-sum">
            <div class="sum-val"><u><i></i></u></div>
        </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="fields-wrap">
            <label>Срок</label>
            <i class="fa fa-question-circle-o i-hint"></i>
            <span class="hint">Укажите срок, на который вы хотите получить кредит</span><br>
            <div id="credit-term" class="new-select">
                <b>любой</b>
                <div>
                    <span>любой</span>
                    <span>1 месяц</span>
                    <span>3 месяца</span>
                    <span>6 месяцев</span>
                    <span>9 месяцев</span>
                    <span>1 год (12 месяцев)</span>
                    <span>2 года (24 месяцев)</span>
                    <span>3 года (36 месяцев)</span>
                    <span>4 года (48 месяцев)</span>
                    <span>5 лет (60 месяцев)</span>
                    <span>6 лет (72 месяцев)</span>
                    <span>7 лет (84 месяцев)</span>
                    <span>10 лет (120 месяцев)</span>
                    <span>15 лет</span>
                    <span>20 лет</span>
                    <span>25 лет</span>
                    <span>30 лет</span>
                </div>
                <i class="sel"></i>
            </div>
        </div>
    </div>    
</div><!-- end row -->
<br>



<div class="row">
    <div class="col-md-6">
        <div class="fields-wrap">
            <label>Рассмотрение заявки</label>
            <i class="fa fa-question-circle-o i-hint"></i>
            <span class="hint">Выберите желаемую скорость рассмотрения заявки в банке</span><br>
            <div id="credit-speed" class="new-select">
                <b>любое</b>
                <div>
                    <span>любое</span>
                    <span>день в день</span>
                    <span>до 3 дней</span>
                    <span>до 7 дней</span>
                    <span>до 14 дней</span>
                </div>
                <i class="sel"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="fields-wrap">
            <label>Подтверждение дохода</label>
            <i class="fa fa-question-circle-o i-hint"></i>
            <span class="hint">Выберите способ подтверждения дохода (например, 2-НДФЛ) или оформление без подтверждения</span><br>
            <div id="credit-docs" class="new-select">
                <b>не важно</b>
                <div>
                    <span>не важно</span>
                    <span>2-НДФЛ / 3-НДФЛ / 4-НДФЛ</span>
                    <span>альтернативные формы</span>
                    <span>без подтверждения</span>
                </div>
                <i class="sel"></i>
            </div>
        </div>
    </div>    
</div><!-- end row -->
<br>



<div class="row">
    <div class="col-md-6">
        <div class="fields-wrap">
            <label>Регистрация в регионе выдачи</label>
            <i class="fa fa-question-circle-o i-hint"></i>
            <span class="hint">Укажите, требуется ли регистрация в регионе оформления кредита для желаемого предложения</span><br>
            <div id="credit-place" class="new-select">
                <b>не важно</b>
                <div>
                    <span>не важно</span>
                    <span>постоянная</span>
                    <span>временная</span>
                    <span>не требуется</span>
                </div>
                <i class="sel"></i>
            </div>
        </div>
    </div>
</div><!-- end row -->

    <hr>
    <div class="text-center"><button id="getReuslt">Найти кредиты</button></div>

<div class="text-center"><span class="clearCreditResult" style="display:none;">Очистить результаты поиска</span></div>
<div class="container-progress" id="progressLoadCredit" style="display:none;">

</div>

</form>

</div><!-- end .credit-calc-wrap -->

<div id="credit-calc-res" style="display:none"></div>

<div style="clear:both"></div>

@push('credit-additional-scripts')
<script src="/old_theme/js/jquery-ui.js"></script>
<script>
/* code for new select elements  */
$(document).on('click','.new-select span',function(){
  var value = $(this).text();
  $(this).closest('.new-select').find('b').text(value);
  $(this).closest('div').hide();
});




/* code for the form hint */

$('.fields-wrap .i-hint').on('click',function(){
    //$(this).next('span').toggle('inline');
    $('.fields-wrap span.hint').not($(this).next('span.hint')).hide();
    if($(this).next('span.hint').css('display') == 'none'){
        $(this).next('span.hint').css('display','inline');
    } else {
        $(this).next('span.hint').css('display','none');
    }
});

$(document).click(function(event) {
    if ($(event.target).closest(".i-hint").length) return;
    $(".i-hint").next('span').hide();
    event.stopPropagation();
});





var mim_sum = 10000
var max_sum = 30000000;
var step = 50000;
var count_step = max_sum / step;



$(".sum-val i").draggable({
    'axis' : "x",
    containment: "parent",
    drag:function(){
        var left = parseInt($(this).css('left'));
        if( (left < -7 ) || (left > 355) ){
        } else {
            console.log(left);


            if(left <= 183){
                //185 : 500000 = left : x;
                var x = Math.round(left * 500000 / 185);
                x = Math.round(x / 1000) * 1000;
            } else {
                leftX = 355 - 184;
                sumX = max_sum - 500000;
                step = sumX / leftX;
                x = (left * step) - max_sum - 1000000;
                x = Math.round(x / 10000) * 10000;
                if(left ==355) x = max_sum;
            }
                $('#credit-sum').val(x);
            $('.sum-val').css('width',(left+2)+'px');
        }
        d1 = document.getElementById('credit-sum');
        d1.value = d1.value.replace(' ','');
        d1.value = d1.value.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
    }
});


$('#credit-sum').on('change paste keyup',function(){
    var input = $(this).val();
    input = input.replace(' ','');
    input = parseInt(input);

    if(isNaN(input)) {
        $(this).addClass('error');
    } else {
        $(this).removeClass('error');
        if((input < mim_sum) || (input > max_sum)){
            $(this).addClass('error');
        } else {
            if(input <= 500000){
                var x = 185 * input / 500000;
                //if(input==10000) x = 0;
                console.log(x);
                $('.sum-val i').css('left',(x-5) +'px');            
                $('.sum-val').css('width',(x)+'px');                
            } else {
                var x = 185 * input / 30000000;
                console.log(x);
                $('.sum-val i').css('left',(185+x-15) +'px');            
                $('.sum-val').css('width',(185+x-10)+'px');                
            }
        }
    }
    d1 = document.getElementById('credit-sum');
    d1.value = d1.value.replace(' ','');
    d1.value = d1.value.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');

});











$('#getReuslt').on('click',function(e){
    e.preventDefault();

    var sum = $('#credit-sum').val(); // сумма
    sum = sum.replace(' ','');
    sum = parseInt(sum);
    //var currency = $('#credit-currency b').text();
    var term = $('#credit-term b').text(); // срок
    var speed = $('#credit-speed b').text(); // скорость рассмотрения заявки
    //var pledge = $('#credit-pledge b').text(); // залог и поручительство
    var place = $('#credit-place b').text(); // место регистрации
    var docs = $('#credit-docs b').text(); // документы

    if((sum < mim_sum) || (sum > max_sum)) return false;
/*
console.log(sum);
console.log(term);
console.log(speed);
console.log(place);
console.log(docs);
*/
    $('#progressLoadCredit').show();
    LoadCredit = setInterval(ProgressStatusCredit,100);
        $.ajax({
            type: "GET",
            data: {sum:sum, term:term, speed:speed, place:place, docs:docs},
            dataType: "html",
            url: '/credit_load',
            cache: false,
            success: function (data) {
                $('#credit-calc-res').html(data).show();
                $('.clearCreditResult').show();
            }
        });

    return false;

});


var ProgressStatusCredit = function(){
    var old = $('#progressLoadCredit .form-progress').attr('data-value');
    x = parseInt(old) + parseInt(randomInteger(5, 10));
    $('#progressLoadCredit .form-progress').css('width',x+'%');
    $('#progressLoadCredit .sr-only').text(x+'%');    
    $('#progressLoadCredit .form-progress').attr('data-value',x);

    if($('#progressLoadCredit .form-progress').attr('data-value')>=100){
        $('#progressLoadCredit .form-progress').css('width','100%');
        $('#progressLoadCredit .form-progress').attr('data-value',100);
        $('#progressLoadCredit .sr-only').text('100%'); 
        $('#credit-calc-res').show();       
        clearInterval(LoadCredit);
        $('#progressLoadCredit').fadeOut(1000);
        $('.clearCreditResult').show();
    }   
}

function randomInteger(min, max) {
    var rand = min - 0.5 + Math.random() * (max - min + 1)
    rand = Math.round(rand);
    return rand;
}

$('.clearCreditResult').on('click',function(){
    $('#credit-calc-res').html('');
    $('#progressLoadCredit .form-progress').css('width','0%');
    $('#progressLoadCredit .form-progress').attr('data-value',0);
    $('#progressLoadCredit .sr-only').text('0%');    
    $(this).hide();
});


</script>
@endpush

