<div class="rat_cnt_4">
    <?php $imgSize = img_size($img); ?>
    <amp-img src="{!! $img !!}" alt="" layout="fixed" width="{{$imgSize['width']}}px" height="{{$imgSize['height']}}px"></amp-img>
    <div>{!! $title !!}</div>
    <span>{!! $i_code !!}</span><br>
    {!! $content !!}
</div>