<form action="/rko" class="rko_calc" method="POST">sss
    <div class="visible-block">
        <div class="calc-sub-title">Подбор расчетного счета</div>
        <div class="form-line">
            <b class="calc-mb0">Количество платежей: <i id="pay-count">50</i></b>
            <div class="cont">
                <input type="range" min="0" max="101" value="50" step="1" list="count_range" id="count_range_input" oninput="calc_update(this.value)">
                <datalist id="count_range">
                    <option value="0 to 101">50</option>
                    <?php
                    for($i = 0; $i<=100; $i++){
                        echo "<option>$i</option>";
                    }
                    ?>
                    <option>100+</option>
                </datalist>
            </div>
        </div>
        <div class="form-line">
            <div class="rko_block">
                <div class="block_6">
                    <b>Дополнительные условия:</b>
                    <label> <input type="checkbox" id="add_cond_1" required>С бесплатным открытием</label>
                    <label> <input type="checkbox" id="add_cond_2" required>С бесплатным обслуживанием</label>
                    <label> <input type="checkbox" id="add_cond_3" required>Нужен интернет-банк</label>
                    <label> <input type="checkbox" id="add_cond_4" required>Нужен мобильный банк</label>
                    <label> <input type="checkbox" id="add_other_1" required>Открытие в течение дня</label>
                    <label> <input type="checkbox" id="add_other_2" required>Бонусы при открытии счета</label>
                </div>
                <div class="block_6">
                    <b>Требуется:</b>
                    <label> <input type="checkbox" id="planning_1" required>Внесение больших сумм наличных</label>
                    <label> <input type="checkbox" id="planning_2" required>Выдача больших сумм наличных</label>
                    <label> <input type="checkbox" id="salary_project" required>Зарплатный проект</label>
                    <label> <input type="checkbox" id="ekva" required>Эквайринг</label>
                    <div class="only-check-ekva">
                        <span class="fdde4">Вид необходимого эквайринга:</span>
                        <label> <input type="radio" value="trade" name="rr1" checked>Торговый</label>
                        <label> <input type="radio" value="mobile" name="rr1">Мобильный</label>
                        <label> <input type="radio" value="internet" name="rr1">Интернет</label>
                        <br>
                        <label> <input type="checkbox" id="rent_terminal" required>Нужна аренда терминала</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden-block">
        <div class="form-line">
            <div class="rko_block">
                <div class="block_6">
                    <b>Валютный контроль:</b>
                    <label> <input type="checkbox" id="curr_ctrl_1" required>Бесплатное открытие счета в иностранной валюте</label><br>
                    <label> <input type="checkbox" id="curr_ctrl_2" required>Бесплатное ведение счета в иностранной валюте</label><br>
                    <label> <input type="checkbox" id="curr_ctrl_3" required>Бесплатная постановка договора на учет</label><br>
                </div>
                <div class="block_6">
                    <b>Корпоративные карты:</b>
                    <label> <input type="checkbox" id="corp_cards_1" required>Visa</label><br>
                    <label> <input type="checkbox" id="corp_cards_2" required>MasterCard</label><br>
                    <label> <input type="checkbox" id="corp_cards_3" required>Бесплатное открытие</label><br>
                    <label> <input type="checkbox" id="corp_cards_4" required>Бесплатное обслуживание</label><br>
                </div>
            </div>
        </div>
    </div>aaa
    <div class="rko_block">
        <div class="block_6">
            <a href="#" id="rko_render" class="text-center" onclick="yaCounter38176370.reachGoal('rko-podbor'); return true;">Подобрать <i class="fa fa-arrow-right"></i></a>
        </div>
        <div class="block_4 display_none">
            <div id="rko_clear_result" class="text-center">Сбросить <i class="fa fa-refresh"></i></div>
        </div>
        <div class="block_6">
            <div id="show-hidded-block" class="text-center">Расширенный подбор <i class="fa fa-arrow-down"></i></div>
        </div>
    </div>
    <div class="rko_block">
        <div class="block_12">
            <div id="hide-hidded-block" class="text-center">Скрыть <i class="fa fa-arrow-up"></i></div>
        </div>
    </div>
</form>

@if($_SERVER['REQUEST_URI'] != '/rko')
<div class="offers-list">
</div>
@endif


<script src="/vzo_theme/js/jquery-3.2.1.min.js"></script>
<script>
    $('#show-hidded-block').click(function(){
        $(this).hide();
        $('.hidden-block').show();
        $(this).parent().hide();

        if($('#rko_clear_result').css('display') == 'none'){
            $('#rko_render').parent().removeClass('block_6').addClass('block_12');
        } else {
            $('#rko_render').parent().removeClass('block_4').addClass('block_6');
            $('#rko_clear_result').parent().removeClass('block_4').addClass('block_6');
        }
        $('#hide-hidded-block').show();
    });

    $('#hide-hidded-block').click(function(){
        $(this).hide();
        $('.hidden-block').hide();
        $('#show-hidded-block').show();
        $('#show-hidded-block').parent().show();

        if($('#rko_clear_result').css('display') == 'none'){
            $('#rko_render').parent().removeClass('block_12').addClass('block_6');
            $(this).parent().removeClass('block_4').addClass('block_6');
        } else {
            $('#rko_render').parent().removeClass('block_6').removeClass('block_12').addClass('block_4');
            $(this).parent().removeClass('block_6').removeClass('block_12').addClass('block_4');
            $('#rko_clear_result').parent().removeClass('block_6').removeClass('block_12').addClass('block_4');
        }

    });

    function calc_update(value){
        if(value == '101'){
            $('#pay-count').text('100+');
        } else {
            $('#pay-count').text(value);
        }
    }


    $('#ekva').change(function(){
        if($(this).is(':checked')){
            $('.only-check-ekva').show();
        } else {
            $('.only-check-ekva').hide();
        }
    });

    $('#rko_render').click(function(e){
        e.preventDefault();

        // Количество платежей
        var pay_count = $('#pay-count').text();

        // Дополнительные условия
        if ($('#add_cond_1').is(":checked")) add_cond_1 = 1; else add_cond_1 = 0;
        if ($('#add_cond_2').is(":checked")) add_cond_2 = 1; else add_cond_2 = 0;
        if ($('#add_cond_3').is(":checked")) add_cond_3 = 1; else add_cond_3 = 0;
        if ($('#add_cond_4').is(":checked")) add_cond_4 = 1; else add_cond_4 = 0;

        // Требуется
        if ($('#planning_1').is(":checked")) planning_1 = 1; else planning_1 = 0;
        if ($('#planning_2').is(":checked")) planning_2 = 1; else planning_2 = 0;

        // Зарплатный проект
        if ($('#salary_project').is(":checked")) salary_project = 1; else salary_project = 0;

        // Эквайринг
        if ($('#ekva').is(":checked")) ekva = 1; else ekva = 0;
        if ($('#rent_terminal').is(":checked")) rent_terminal = 1; else rent_terminal = 0;
        rr1 = $('input[name=rr1]:checked').val();


        // Валютный контроль
        if ($('#curr_ctrl_1').is(":checked")) curr_ctrl_1 = 1; else curr_ctrl_1 = 0;
        if ($('#curr_ctrl_2').is(":checked")) curr_ctrl_2 = 1; else curr_ctrl_2 = 0;
        if ($('#curr_ctrl_3').is(":checked")) curr_ctrl_3 = 1; else curr_ctrl_3 = 0;

        // Корпоративные карты
        if ($('#corp_cards_1').is(":checked")) corp_cards_1 = 1; else corp_cards_1 = 0;
        if ($('#corp_cards_2').is(":checked")) corp_cards_2 = 1; else corp_cards_2 = 0;
        if ($('#corp_cards_3').is(":checked")) corp_cards_3 = 1; else corp_cards_3 = 0;
        if ($('#corp_cards_4').is(":checked")) corp_cards_4 = 1; else corp_cards_4 = 0;

        // Дополнительно
        if ($('#add_other_1').is(":checked")) add_other_1 = 1; else add_other_1 = 0;
        if ($('#add_other_2').is(":checked")) add_other_2 = 1; else add_other_2 = 0;

        $('#rko_clear_result').show();
        $('#rko_clear_result').parent().removeClass('display_none');
        if($('#show-hidded-block').css('display') == 'none'){
            $(this).parent().removeClass('block_12').addClass('block_6');
            $('#rko_clear_result').parent().removeClass('block_4').addClass('block_6');
        } else {
            $(this).parent().removeClass('block_6').addClass('block_4');
            $('#show-hidded-block').parent().removeClass('block_6').addClass('block_4');
        }

        $.ajax({
            type: "POST",
            url: "/rko/calc",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'pay_count':pay_count,
                'add_cond_1':add_cond_1,
                'add_cond_2':add_cond_2,
                'add_cond_3':add_cond_3,
                'add_cond_4':add_cond_4,
                'planning_1':planning_1,
                'planning_2':planning_2,
                'salary_project':salary_project,
                'ekva':ekva,
                'rr1':rr1,
                'rent_terminal':rent_terminal,
                'curr_ctrl_1':curr_ctrl_1,
                'curr_ctrl_2':curr_ctrl_2,
                'curr_ctrl_3':curr_ctrl_3,
                'corp_cards_1':corp_cards_1,
                'corp_cards_2':corp_cards_2,
                'corp_cards_3':corp_cards_3,
                'corp_cards_4':corp_cards_4,
                'add_other_1':add_other_1,
                'add_other_2':add_other_2
            },
            success: function(data){
                $('.offers-list').html(data);
                update_img_and_bg();
            }
        });

        return false;
    });

    $('#rko_clear_result').click(() => location.reload());


</script>


@section('additional-styles')

    <style>

        .calc-sub-title{    font-size: 30px;
            font-weight: bold;
            text-align: center;
            background: #38b6f7;
            margin: -15px;
            color: #fff;
            margin-bottom: 15px;}
        .rko_calc{padding: 15px;border: 2px solid #38b6f7;}

        .calc-mb0{margin: 5px 0 5px !important;}

        .rko_calc b{margin: 15px 0 7.5px;display: block;}
        .rko_calc label b{display: inline-block; margin: 0}
        .rko_calc input[type='radio']{    padding: 5px;
            width: 23px;
            height: 23px;
            vertical-align: bottom;
            margin: 0 5px 0 10px;}

        #show-hidded-block, #rko_render, #rko_clear_result, #hide-hidded-block{
            padding: 10px;
            border: 1px solid #a5ca38;
            color: #fff;
            background: #a5ca38;
            cursor: pointer;
            display: block;
        }
        #hide-hidded-block{display: none; margin-top: 15px;}

        #show-hidded-block, #hide-hidded-block{
            /*margin-top: 15px;*/
            background: #ededed !important;
            border: 1px solid #ededed !important;
            color: #000;
        }

        #rko_clear_result{display: none;}

        #show-hidded-block:hover, #hide-hidded-block:hover{
            background: #d8d3d3 !important;
            border: 1px solid #d8d3d3 !important;
        }

        #rko_clear_result {
            /*margin-top: 15px;*/
            background: #ef463e !important;
            border: 1px solid #ef463e !important;
        }

        #rko_clear_result:hover{
            background: #d4332b !important;
            border: 1px solid #d4332b !important;
        }

        #rko_render:hover{
            background: #063;
        }

        #rko_render:hover{
            text-decoration: none;
            color:#fff;
        }

        .rko_calc .form-line label{
            display: inline-flex;
            width: 100%;
        }

        .docs-list li:before{
            display: none !important;
        }

        .fdde4{margin-bottom: 7px; display: block;}

        .hidden-block{display: none;}

        .only-check-ekva{display: none;}

        .form-line .cont input{padding: 0;}
        .cont:after {
            content: '0 <?php for($i = 1; $i<=99; $i++){if($i % 5 == 0) echo " $i";} ?> 100+';
        }

        .cont:after{
            word-spacing: 22.4px;
            left: 4px;
        }

        @if($_SERVER['REQUEST_URI'] == '/rko')
    .cont:after{
            word-spacing: 35.8px;
            left: 4px;
        }
        @endif


    input[type='range'] {
            box-sizing: border-box;
            border: 0px solid transparent;
            padding: 0px;
            margin: 0px;
            width: 100%;
            height: 50px;
            cursor: pointer;
            background: -webkit-repeating-linear-gradient(90deg, #777, #777 1px, transparent 1px, transparent 24.9%) no-repeat 100% 50%;
            background: -moz-repeating-linear-gradient(90deg, #777, #777 1px, transparent 1px, transparent 24.9%) no-repeat 100% 50%;
            background: repeating-linear-gradient(90deg, #777, #777 1px, transparent 1px, transparent 4.95%) no-repeat 100% 50%;
            background-size: 100% 15px;
            font-size: 16px;
        }

        .res-h4-c{
            margin: 25px 0 10px;
            text-align: center;
        }

        @media (max-width: 768px) {
            #rko_clear_result, #show-hidded-block{
                margin-top: 15px;
            }
        }

    </style>

@endsection