<?php if(!is_mobile_device()){ ?>
<aside class="sidebar">
@if(Request::path() != 'banki')
<?php
    $showBankMenu = $bank->show_credits
        || $bank->show_credit_cards
        || $bank->show_debit_cards
        || $bank->show_auto_credits
        || $bank->show_deposits
        || $bank->show_mortgage
        || $bank->show_rko
?>
    @if($showBankMenu)
<div class="side-block">
    <div class="side-title fa-icon fa-bank"> {{$bank->name}}</div>
    <div class="side-box">
        <ul class="mb0 rating-mfk">
            @if($bank->show_credits && Request::path() != "banki/$bank->alias/kredity")
            <li><a href="/banki/{{$bank->alias}}/kredity" class="fa-icon fa-bank">Кредиты</a></li>
            @endif
            @if($bank->show_credit_cards && Request::path() != "banki/$bank->alias/kreditnye-karty")
            <li><a href="/banki/{{$bank->alias}}/kreditnye-karty" class="fa-icon fa-credit-card">Кредитные карты</a></li>
            @endif
            @if($bank->show_debit_cards && Request::path() != "banki/$bank->alias/debetovye-karty")
            <li><a href="/banki/{{$bank->alias}}/debetovye-karty" class="fa-icon fa-credit-card-alt">Дебетовые карты</a></li>
            @endif
            @if($bank->show_auto_credits && Request::path() != "banki/$bank->alias/avtokredity")
            <li><a href="/banki/{{$bank->alias}}/avtokredity" class="fa-icon fa-automobile">Автокредиты</a></li>
            @endif
            @if($bank->show_deposits && Request::path() != "banki/$bank->alias/vklady")
            <li><a href="/banki/{{$bank->alias}}/vklady" class="fa-icon fa-money">Вклады</a></li>
            @endif
            @if($bank->show_mortgage && Request::path() != "banki/$bank->alias/ipoteki")
            <li><a href="/banki/{{$bank->alias}}/ipoteki" class="fa-icon fa-home">Ипотеки</a></li>
            @endif
            @if($bank->show_rko && Request::path() != "banki/$bank->alias/rko")
            <li><a href="/banki/{{$bank->alias}}/rko" class="fa-icon fa-id-card">РКО</a></li>
            @endif

        </ul>
    </div>
</div>
@endif
@endif




@include('site.v3.modules.banks.bank-relink')



<?php global $sidebar_tags_menu; ?>
@if(is_array($sidebar_tags_menu))
    @if(count($sidebar_tags_menu) > 1)
        <div class="side-block sidebar_menu_wrap">
            <div class="side-block">
                <div class="side-title">Содержание</div>
                <div class="side-box text-center">
                    <ul class="side_bar_menu_scroll">
                        @foreach($sidebar_tags_menu as $menu_item)
                        <li><a href="#{{$menu_item['id']}}">{{$menu_item['text']}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
@endif


</aside><?php /* sidebar */ ?>
<?php } // end if mobile device ?>