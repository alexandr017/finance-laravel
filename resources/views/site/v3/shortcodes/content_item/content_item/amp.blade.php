<div class="content_item">
    <div class="inner">
        <a class="c_i_f_l" href="{!! $link !!}" target="_blank">
            <?php $imgSize = img_size($img); ?>
            <amp-img width="{{$imgSize['width']}}px" height="{{$imgSize['height']}}px" layout="fixed" src="{!! $img !!}" alt="{!! $alt !!}"></amp-img>
        </a><br>
        <a href="{!! $link !!}" target="_blank">{!! $link_title !!}</a><br>
        {!! $content !!}
    </div>
</div>