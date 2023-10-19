<div class="hot_lines">
    <span  class="hl_title">Вам может быть полезно</span>
    <div class="hot_lines_block">
        @if($online_credit != null)
        <div class="col_cnt_{{$greed}}">
            <a href="{{$online_credit}}" class="inn_ht_link ht_online_credit">
                <i class="fa fa-database"></i>
                <span>Кредиты</span>
            </a>
        </div>
        @endif
        @if($credit_cards != null)
        <div class="col_cnt_{{$greed}}">
            <a href="{{$credit_cards}}" class="inn_ht_link ht_credit_cards">
                <i class="fa fa-money"></i>
                <span>Кредитные карты</span>
            </a>
        </div>
        @endif
        @if($debit_cards != null)
        <div class="col_cnt_{{$greed}}">
            <a href="{{$debit_cards}}" class="inn_ht_link ht_debit_cards">
                <i class="fa fa-credit-card"></i>
                <span>Дебетовые карты</span>
            </a>
        </div>
        @endif
        @if($rko != null)
        <div class="col_cnt_{{$greed}}">
            <a href="{{$rko}}" class="inn_ht_link ht_rko">
                <i class="fa fa-university"></i>
                <span>Расчетные счета</span>
            </a>
        </div>
        @endif
    </div>
</div>