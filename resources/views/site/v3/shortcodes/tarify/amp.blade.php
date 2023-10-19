<div class="tarif_wrap">
    <div class="tarify_block">
        <div class="col_cnt_4"></div>
        <div class="col_cnt_8"><div class="h3 text-center">{!! $title !!}</div></div>
    </div>
    <div class="tarify_block">
        <div class="col_cnt_4">
            <amp-img src="{!! $img !!}" alt="" width="250px" height="120px"></amp-img>
        </div>
        <div class="col_cnt_8">
            <p>{!! $text !!}</p>
            {!! $listHtml !!}
        </div>
    </div>
    @if($tariffCard != null)
        <div class="tarify_block">
            <a class="goToCard" @if($tariffCard->link_type==1) href="{{$tariffCard->link_1}}" @else href="{{$tariffCard->link_2}}" @endif target="_blank"> Перейти</a>
        </div>
    @endif
</div>