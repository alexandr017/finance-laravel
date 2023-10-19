<form action="/rko" class="rko_calc" method="POST">
    <div class="visible-block">
        <?php /* <div class="calc-sub-title">Подбор расчетного счета</div> */ ?>
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
    </div>
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

        @if($_SERVER['REQUEST_URI'] == '/rko')
    .cont:after{
            word-spacing: 35.8px;
            left: 4px;
        }
        @endif

    </style>

@endsection