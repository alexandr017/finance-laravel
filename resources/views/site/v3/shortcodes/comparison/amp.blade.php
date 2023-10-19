@if($count == 2)
    <div class="cmp_wrap">
        <div class="h3 text-center">{!! $title !!}</div>
        <div class="cmp_block">
            <div class="div_cnt_2">
                <?php $imgSize = img_size($img1); ?>
                <amp-img src="{!! $img1 !!}" alt="{!! $alt1 !!}" layout="fixed" width="{{$imgSize['width']}}px" height="{{$imgSize['height']}}px"></amp-img>
                <div class="cmp_i">
                    <div class="h4 text-center">{!! $t0 !!}</div>
                    <div class="cmp_f">{!! $content0 !!}</div>
                </div>
            </div>
            <div class="div_cnt_2">
                <?php $imgSize = img_size($img2); ?>
                <amp-img src="{!! $img2 !!}" alt="{!! $alt2 !!}" layout="fixed" width="{{$imgSize['width']}}px" height="{{$imgSize['height']}}px"></amp-img>
                <div class="cmp_i">
                    <div class="h4 text-center">{!! $t1 !!}</div>
                    <div class="cmp_f">{!! $content1 !!}</div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="cmp_wrap">
        <div class="h3 text-center">{!! $title !!}</div>
        <div class="cmp_block">
            <div class="div_cnt_3">
                <?php $imgSize = img_size($img1); ?>
                <amp-img src="{!! $img1 !!}" alt="{!! $alt1 !!}" layout="fixed" width="{{$imgSize['width']}}px" height="{{$imgSize['height']}}px"></amp-img>
                <div class="cmp_i">
                    <div class="h4 text-center">{!! $t0 !!}</div>
                    <div class="cmp_f">{!! $content0 !!}</div>
                </div>
            </div>
            <div class="div_cnt_3">
                <?php $imgSize = img_size($img2); ?>
                <amp-img src="{!! $img2 !!}" alt="{!! $alt2 !!}" layout="fixed" width="{{$imgSize['width']}}px" height="{{$imgSize['height']}}px"></amp-img>
                <div class="cmp_i">
                    <div class="h4 text-center">{!! $t1 !!}</div>
                    <div class="cmp_f">{!! $content1 !!}</div>
                </div>
            </div>
            <div class="div_cnt_3">
                <?php $imgSize = img_size($img3); ?>
                <amp-img src="{!! $img2 !!}" alt="{!! $alt2 !!}" layout="fixed" width="{{$imgSize['width']}}px" height="{{$imgSize['height']}}px"></amp-img>
                <div class="cmp_i">
                    <div class="h4 text-center">{!! $t2 !!}</div>
                    <div class="cmp_f">{!! $content2 !!}</div>
                </div>
            </div>
        </div>
    </div>
@endif