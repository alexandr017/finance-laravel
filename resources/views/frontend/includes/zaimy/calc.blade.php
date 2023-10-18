<div class="side-block">
    <div class="side-title"><i class="fa fa-calculator"></i> Калькулятор переплаты</div>
    <div class="side-box options-list">
        <div class="calc-block">
            <div class="desc">Сумма займа в рублях</div>
            <div class="form-line"><input class="width-100 text-center" pattern="[0-9]*"  type="text" name="value" id="mc_summ" onkeypress="return isNumberKey(event)"></div>

            <div class="desc">Срок в днях</div>
            <div class="form-line"><input class="width-100 text-center" data-category-id="{{$category_id}}" pattern="[0-9]*" type="text" name="days" id="mc_term" onkeypress="return isNumberKey(event)"></div>

            <div class="desc">@if($category_id == 7) Процент в неделю @else  Процент в день @endif</div>
            <div class="form-line"><input class="width-100 text-center" type="number" name="percent" id="mc_percent"></div>

            <div class="text-center"><button class="form-btn1">Рассчитать</button></div>
        </div>
    </div>
    <div class="mc_result text-center"></div>
</div>