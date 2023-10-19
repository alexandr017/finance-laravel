<div class="tarif_wrap">
    <div class="tarify_block">
        <div class="col_cnt_4"></div>
        <div class="col_cnt_8"><span class="sub_title">{!! $title !!}</span></div>
    </div>
    <div class="tarify_block">
        <div class="col_cnt_4">
            <img loading="lazy" src="{!! $img !!}" alt="">
        </div>
        <div class="col_cnt_8">
            <p>{!! $text !!}</p>
            {!! $listHtml !!}
        </div>
    </div>
    @if($tariffCard != null)
        <div class="tarify_block">
            <a class="form-btn1 goToCard" onclick="yaCounter38176370.reachGoal('orgbut');  gtag('event', 'Клик', { 'event_category': 'orgbut', 'event_action': 'orgbut_click', }); return true;" @if($tariffCard->link_type==1) href="{{$tariffCard->link_1}}" @else href="{{$tariffCard->link_2}}" @endif target="_blank"> Перейти</a>
        </div>
    @endif
</div>