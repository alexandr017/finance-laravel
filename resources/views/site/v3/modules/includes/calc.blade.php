            <div class="calc-block">
                <div class="blue-block">
                    <div class="listing-h2 text-center">Калькулятор переплаты</div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="desc">Сумма займа в рублях</div>
                            <div class="form-line"><input class="width-100" pattern="[0-9]*"  type="text" name="value" id="mc_summ" onkeypress="return isNumberKey(event)"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="desc">Срок в днях</div>
                            <div class="form-line"><input class="width-100" data-category-id="{{$category_id}}" pattern="[0-9]*" type="text" name="days" id="mc_term" onkeypress="return isNumberKey(event)"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="desc">@if($category_id == 7) Процент в неделю @else  Процент в день @endif</div>
                            <div class="form-line"><input class="width-100" pattern="[0-9]*"  type="text" name="percent" id="mc_percent" onkeypress="return isNumberKey(event)"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="desc"></div>
                            <div class="form-line"><button class="form-btn1">Рассчитать</button></div>
                        </div>
                    </div>
                    <div class="mc_result text-center"></div>
                </div>
            </div>