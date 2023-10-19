<div class="tarif_wrap">
    <span class="tarif_title">{!! $title !!}</span>
    <img loading="lazy" class="tarif_img" src="{{ $img }}" alt="{{$title}}">
    <p>{!! $text !!}</p>
    {!! $listHtml !!}
    @if($tariffCard != null)
        <div class="tarify_card-block">
            <a class="form-btn1 goToCard" onclick="yaCounter38176370.reachGoal('orgbut');  gtag('event', 'Клик', { 'event_category': 'orgbut', 'event_action': 'orgbut_click', }); return true;" @if($tariffCard->link_type==1) href="{{$tariffCard->link_1}}" @else href="{{$tariffCard->link_2}}" @endif target="_blank"> Перейти</a>
        </div>
    @endif
</div>