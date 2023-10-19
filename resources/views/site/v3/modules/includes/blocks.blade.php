<div class="container" id="fix-block">
    <div class="section-title">Новые отзывы о компаниях</div>
    <div class="reviews">
        @foreach($reviews as $value)
            <div class="itm">
                <div class="iname">{{$value->author}}</div>
                {!! App\Models\System::rating($value->rating) !!}
                <div class="itext"><p>{!! reviewsShortLenghtRender($value->review) !!}</p></div>
            </div>
        @endforeach
    </div>
</div>




<div class="info-block container">
    <div class="row">
        <div class="col-lg-5 col-md-12">
            <div class="info-rating-title upgrade-title">111111</div>
            <div class="video-link"><img class="about_vzo" style="cursor: pointer" loading="lazy" src="/old_theme/img/video-preview.jpg" alt="О проекте «Финанс Ру»"></div>
        </div>
        <div class="col-lg-7 col-md-12">
            <div class="int-cont">
                122222
            </div>
        </div>   
    </div>
    <div class="int-cont2">
        <div class="itm"><div class="iimage"><img loading="lazy" src="/old_theme/img/1.jpg" alt=""></div><div class="itext">ewfewf</div></div>
        <div class="itm"><div class="iimage"><img loading="lazy" src="/old_theme/img/1.jpg" alt=""></div><div class="itext">wefef</div></div>
        <div class="itm"><div class="iimage"><img loading="lazy" src="/old_theme/img/1.jpg}" alt=""></div><div class="itext">fewf</div></div>
        <div class="itm"><div class="iimage"><img loading="lazy" src="/old_theme/img/1.jpg}" alt=""></div><div class="itext">wefef</div></div>
    </div>
</div>

