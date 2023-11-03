<?php
$bank_menu_items = [];
$sideBarItems = ['kredity','debetovye-karty','avtokredity','kreditnye-karty','vklady','ipoteki','refinancing','rko','cashback'];
$bank_menu_items[''] = 'О банке';
if($bank->show_credits){
    $bank_menu_items['kredity'] = 'Кредиты';
}
if($bank->show_debit_cards){
    $bank_menu_items['debetovye-karty'] = 'Дебетовые карты';
}
if($bank->show_auto_credits){
    $bank_menu_items['avtokredity'] = 'Автокредиты';
}
if($bank->show_credit_cards){
    $bank_menu_items['kreditnye-karty'] = 'Кредитные карты';
}
if($bank->show_deposits){
    $bank_menu_items['vklady'] = 'Вклады';
}
if($bank->show_mortgage){
    $bank_menu_items['ipoteki'] = 'Ипотеки';
}
if($bank->show_refinancing){
    $bank_menu_items['refinancing'] = 'Рефинансирование';
}
if($bank->show_rko){
    $bank_menu_items['rko'] = 'РКО';
}
if($bank->show_cashback){
    $bank_menu_items['cashback'] = 'Кэшбэки';
}
$bank_menu_items['gorjachaja-linija'] = 'Служба поддержки';
$bank_menu_items['lichnyj-kabinet'] = 'Личный кабинет';
$bank_menu_items['otzyvy'] = 'Отзывы';
$bank_menu_items['rekvizity'] = 'Реквизиты';
$news = DB::table('posts')
    ->leftJoin('posts_categories', 'posts.pcid','posts_categories.id')
    ->select('posts.*', 'posts_categories.alias_category as alias_category')
    ->whereIn('posts.pcid',[13,28])
    ->where(['bank_id' => $bank->id, 'status' => 1])
    ->orderBy('posts.date','desc')
    ->get();
if(isset($news) && count($news) != 0){
    $bank_menu_items['news'] = 'Новости';
}
$url= explode('/',$_SERVER['REQUEST_URI']);
$section = '';
$active_item = '';
if(isset($url[3]) && $url[3] != 'amp'){
    $active_item_alias = $url[3];
    if(array_key_exists($active_item_alias,$bank_menu_items)){
        if(in_array($active_item_alias,$sideBarItems)){
            $section = $active_item_alias.'/';
        }
        $active_item = $bank_menu_items[$active_item_alias];
    }
} else {
    $active_item = 'О банке';
}
?>
<div class="bank-menu-block-amp">
    <input type="checkbox" id="bank-menu-checkbox" />
    <nav role="navigation" class="bank-menu-amp-nav"><!-- навигация -->
        <label for="bank-menu-checkbox" class="bank-menu-btn">
            <span class="bank-menu-active-item"><amp-img alt="Рейтинг" width="15" height="15" layout="fixed" src="/old_theme/img/icon-menu.jpg"></amp-img> {{$active_item}}</span>
        </label>
        <ul class="bank-menu hide-bank-menu">
            @foreach($bank_menu_items as $key => $sidebar_item)
                @if($active_item == $sidebar_item)
                    <li class="bank-active-item">{{$sidebar_item}}</li>
                @elseif($key == 'otzyvy')
                    <li><a href="/banki/{{ $bank->alias }}/{{ $section }}">{{$sidebar_item}}</a></li>
                @else
                    <li><a href="/banki/{{ $bank->alias }}/{{$key}}">{{$sidebar_item}}</a></li>
                @endif
            @endforeach
        </ul>
    </nav>
</div>