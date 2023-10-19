@if($count == 2)
    <div class="cmp_wrap">
        <div class="cmp_h">{!! $title !!}</div>
        <div class="cmp_block">
            <div class="div_cnt_2">
                <img loading="lazy" src="{!! $img1 !!}" alt="{!! $alt1 !!}">
                <div class="cmp_i">
                    <div class="cmp_h">{!! $t0 !!}</div>
                    <div class="cmp_f">{!! $content0 !!}</div>
                </div>
            </div>
            <div class="div_cnt_2">
                <img loading="lazy" src="{!! $img2 !!}" alt="{!! $alt2 !!}">
                <div class="cmp_i">
                    <div class="cmp_h">{!! $t1 !!}</div>
                    <div class="cmp_f">{!! $content1 !!}</div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="cmp_wrap">
        <div class="cmp_h">{!! $title !!}</div>
        <div class="cmp_block">
            <div class="div_cnt_3">
                <img loading="lazy" src="{!! $img1 !!}" alt="{!! $alt1 !!}">
                <div class="cmp_i">
                    <div class="cmp_h">{!! $t0 !!}</div>
                    <div class="cmp_f">{!! $content0 !!}</div>
                </div>
            </div>
            <div class="div_cnt_3">
                <img loading="lazy" src="{!! $img2 !!}" alt="{!! $alt2 !!}">
                <div class="cmp_i">
                    <div class="cmp_h">{!! $t1 !!}</div>
                    <div class="cmp_f">{!! $content1 !!}</div>
                </div>
            </div>
            <div class="div_cnt_3">
                <img loading="lazy" src="{!! $img2 !!}" alt="{!! $alt2 !!}">
                <div class="cmp_i">
                    <div class="cmp_h">{!! $t2 !!}</div>
                    <div class="cmp_f">{!! $content2 !!}</div>
                </div>
            </div>
        </div>
    </div>
@endif