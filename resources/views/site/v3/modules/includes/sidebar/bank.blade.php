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
        || $bank->show_refinancing
        || $bank->show_cashback
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
            <li><a href="/banki/{{$bank->alias}}/vklady" class="fa-icon fa-gift">Вклады</a></li>
            @endif
            @if($bank->show_mortgage && Request::path() != "banki/$bank->alias/ipoteki")
            <li><a href="/banki/{{$bank->alias}}/ipoteki" class="fa-icon fa-home">Ипотеки</a></li>
            @endif
            @if($bank->show_rko && Request::path() != "banki/$bank->alias/rko")
            <li><a href="/banki/{{$bank->alias}}/rko" class="fa-icon fa-id-card">РКО</a></li>
            @endif
            @if($bank->show_refinancing && Request::path() != "banki/$bank->alias/refinancing")
            <li><a href="/banki/{{$bank->alias}}/refinancing" class="fa-icon fa-id-card">Рефинансирование</a></li>
            @endif
            @if($bank->show_cashback && Request::path() != "banki/$bank->alias/cashback")
            <li><a href="/banki/{{$bank->alias}}/cashback" class="fa-icon fa-credit-card">Кэшбэки</a></li>
            @endif

        </ul>
    </div>
</div>
@endif
@endif




<?php /*
@if(isset($newsBase))
<div class="side-block">
    <div class="side-title fa-icon fa-bank"> База знаний</div>
    <div class="side-box">
        <ul class="mb0 rating-mfk">
            @foreach($newsBase as $post)
                <?php $post = (object)$post; ?>
                <?php $post_h1 = ($post->h1_in_category != null) ? $post->h1_in_category : $post->h1; ?>
            <li style="line-height: 1.3rem; padding: 15px 0" >
                <a href="/{{$post->categoryAlias}}/{{$post->alias}}.html"><?php echo Shortcode::compile($post_h1); ?></a>
            </li>
            @endforeach
        </ul>
        <div class="text-center" style="margin-top: 30px">
            <a href="/" class="">Все записи</a>
        </div>
    </div>
</div>
@endif
*/ ?>



@if(Request::path() == 'banks')
    @if(isset($cardCategories))

        @foreach($cardCategories as $cardCategory)
                <?php if (in_array($cardCategory->id, [1,3,7,9,10,11])) continue; ?>
                <div class="side-block-dart">
                    <div class="side-title"><i class="fa fa-angle-up"></i> {{$cardCategory->breadcrumb}}</div>
                    <div class="side-box links-list display_none">

            <?php $filters = json_decode($cardCategory->filters_json);?>
            @if($filters!=null)
                @foreach($filters as $filter)
                        <?php $tmp_arr = explode('=',$filter->group_name); ?>
                        <div class="bold text-center">@if(isset($tmp_arr[1])) <span class="fa {{$tmp_arr[1]}}"></span> @endif {{$tmp_arr[0]}}</div>
                        @foreach($filter->values as $link)
                            <a class="sidebar" href="<?= str_replace('https://finance.ru', '', $link[0]->link) ?>">{{$link[0]->label}}</a>
                        @endforeach
                        <br>
                        <br>
                @endforeach
            @endif
                    </div>
                </div>

        @endforeach
    @endif
@endif



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