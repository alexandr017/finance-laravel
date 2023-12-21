@section('compress-styles')
    @parent
    <?php include (public_path(). "/old_theme/css/modules/banks/mob-menu-global.css"); ?>
@endsection

<?php
    $bank_menu_items = [];

    $bank_menu_items[''] = ['О банке','bank'];
    $bank_menu_items['gorjachaja-linija'] = ['Служба поддержки','life-bouy'];
    $bank_menu_items['lichnyj-kabinet'] = ['Личный кабинет','user'];
    $bank_menu_items['rekvizity'] = ['Реквизиты','file-text-o'];
    $bank_menu_items['otzyvy'] = ['Отзывы','comments-o'];

    $sideBarItems = ['kredity','debetovye-karty','avtokredity','kreditnye-karty','vklady','ipoteki','refinancing','rko'];

    if($bank->show_credits){
        $bank_menu_items['kredity'] = ['Кредиты','bank'];
    }
    if($bank->show_debit_cards){
        $bank_menu_items['debetovye-karty'] = ['Дебетовые карты','credit-card-alt'];
    }
    if($bank->show_auto_credits){
        $bank_menu_items['avtokredity'] = ['Автокредиты','automobile'];
    }
    if($bank->show_credit_cards){
        $bank_menu_items['kreditnye-karty'] = ['Кредитные карты','credit-card-alt'];
    }
    if($bank->show_deposits){
        $bank_menu_items['vklady'] = ['Вклады','money'];
    }
    if($bank->show_mortgage){
        $bank_menu_items['ipoteki'] = ['Ипотеки','home'];
    }
    if($bank->show_refinancing){
        $bank_menu_items['refinancing'] = ['Рефинансирование','id-card'];
    }
    if($bank->show_rko){
        $bank_menu_items['rko'] = ['РКО','id-card'];
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
        @elseif($key == 'otzyvy')
            <li><a href="/banki/{{ $bank->alias }}/{{ $section }}{{$key}}" class="fa-icon fa-{{$bank_menu_item_logo}}">{{$bank_menu_item_name}}</a></li>
        @else
            <li><a href="/banki/{{ $bank->alias }}/{{$key}}" class="fa-icon fa-{{$bank_menu_item_logo}}">{{$bank_menu_item_name}}</a></li>
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