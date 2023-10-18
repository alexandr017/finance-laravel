@section('compress-styles')
    @parent
    <?php
    if(response::check_mobile()){
        include (public_path(). "/old_theme/css/modules/banks/mob-menu-global.css");
    }
    ?>
@endsection

<?php
    $bank_menu_items = [];
    $sideBarItems = ['credits','debit-cards','autocredits','credit-cards','insurance','deposits','mortgage','refinancing','rko','cashback'];
    $bank_menu_items[''] = ['О банке','bank'];
    if($bank->show_credits){
        $bank_menu_items['credits'] = ['Кредиты','bank'];
    }
    if($bank->show_debit_cards){
        $bank_menu_items['debit-cards'] = ['Дебетовые карты','credit-card-alt'];
    }
    if($bank->show_auto_credits){
        $bank_menu_items['autocredit'] = ['Автокредиты','automobile'];
    }
    if($bank->show_credit_cards){
        $bank_menu_items['credit-cards'] = ['Кредитные карты','credit-card-alt'];
    }
    if($bank->show_deposits){
        $bank_menu_items['deposits'] = ['Вклады','gift'];
    }
    if($bank->show_mortgage){
        $bank_menu_items['mortgage'] = ['Ипотеки','life-buoy'];
    }
    if($bank->show_refinancing){
        $bank_menu_items['refinancing'] = ['Рефинансирование','id-card'];
    }
    if($bank->show_rko){
        $bank_menu_items['rko'] = ['РКО','id-card'];
    }
    if($bank->show_cashback){
        $bank_menu_items['cashback'] = ['Кэшбэки','credit-card-alt'];
    }

    $bank_menu_items['hotline'] = ['Служба поддержки','life-bouy'];
    $bank_menu_items['login'] = ['Личный кабинет','user'];
    $bank_menu_items['reviews'] = ['Отзывы','comments-o'];
    $bank_menu_items['requisites'] = ['Реквизиты','file-text-o'];
    $news = DB::table('posts')
        ->leftJoin('posts_categories', 'posts.pcid','posts_categories.id')
        ->select('posts.*', 'posts_categories.alias_category as alias_category')
        ->whereIn('posts.pcid',[13,28])
        ->where(['bank_id' => $bank->id, 'status' => 1])
        ->orderBy('posts.date','desc')
        ->get();
    if(isset($news) && count($news) != 0){
        $bank_menu_items['news'] = ['Новости','newspaper-o'];
    }
    $url= explode('/',$_SERVER['REQUEST_URI']);
    $section = '';
    $active_item = '';
    if(isset($url[3])){
        $active_item_alias = $url[3];
        if(array_key_exists($active_item_alias,$bank_menu_items)){
            if(in_array($active_item_alias,$sideBarItems)){
                $section = $active_item_alias.'/';
            }
            $active_item = $bank_menu_items[$active_item_alias][0];
        }
    } else {
        $active_item = 'О банке';
    }
?>
<div class="bank-menu-btn">
    <i class="fa fa-bars toggle-bank-menu" aria-hidden="true"></i>
    <span class="bank-menu-active-item">{{$active_item}}</span>
    <i class="fa fa-angle-down" aria-hidden="true"></i>
</div>
<ul class="bank-menu hide-bank-menu">
    @foreach($bank_menu_items as $key => $sidebar_item)
        <?php
        $bank_menu_item_name = $sidebar_item[0];
        $bank_menu_item_logo = $sidebar_item[1];
        ?>
        @if($active_item == $bank_menu_item_name)
            <li class="bank-active-item"><span class="fa-icon fa-{{$bank_menu_item_logo}}">{{$bank_menu_item_name}}</span></li>
        @elseif($key == 'reviews')
            <li><a href="/banks/{{ $bank->alias }}/{{ $section }}{{$key}}" class="fa-icon fa-{{$bank_menu_item_logo}}">{{$bank_menu_item_name}}</a></li>
        @else
            <li><a href="/banks/{{ $bank->alias }}/{{$key}}" class="fa-icon fa-{{$bank_menu_item_logo}}">{{$bank_menu_item_name}}</a></li>
        @endif
    @endforeach
</ul>

@section('additional-scripts')
    @parent
    <script>
        $('.bank-menu-btn').on('click',function () {
            $('.bank-menu').toggleClass('hide-bank-menu');
        })
    </script>
@endsection