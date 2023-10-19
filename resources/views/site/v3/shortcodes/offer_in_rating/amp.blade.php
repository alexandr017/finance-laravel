<div class="offer_in_rating_wrap shadow">
    <span class="offer_in_rating_place">{!! $place !!} место</span>
    <div class="offer_in_rating_img">
        <?php $imgSize = img_size($img); ?>
        <amp-img src="{!! $img !!}" alt="{!! $title !!}" width="{{$imgSize['width']}}px" height="{{$imgSize['height']}}px" layout="fixed"></amp-img>
    </div>
    <p class="inf-p shadow">{!! $text !!}</p>
    <div class="offer_in_rating_block">
        {!! $content !!}
    </div>
    <div class="one-offer">
        <a class="form-btn1 {!! $class !!}" href="{!! $link !!}" target="_blank"><i class="fa fa-eye"></i>Подробнее</a>
    </div>
</div>