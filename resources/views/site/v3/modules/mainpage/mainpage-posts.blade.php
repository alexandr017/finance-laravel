<div class="swiper_styles-slider articles-slider-cont slider_person_slider_ccff94d72d7cd84ac997 swiper-initialized swiper-horizontal">
    <div class="articles-slider-list swiper_styles-wraper swiper-wrapper" aria-live="polite">
        @foreach($posts as $post)
            <div class="swiper_styles-item articles_slider-slide swiper-slide swiper-slide-active" role="group" aria-label="1 / 16">
                @include('site.v3.modules.post.post-card', ['post' => $post])
            </div>
        @endforeach
    </div>

    <div class="swiper_styles-pagination_cont">
        <div
            class="swiper_styles-button-prev swiper-button-disabled"
            id="prev_button"
            tabindex="-1"
            role="button"
            aria-label="Previous slide"
            aria-controls="swiper-wrapper-32741108d34487f14"
            aria-disabled="true"
            onclick="showCards(event, 'prev', 'news_item')"
        ></div>

        <div class="slider_kursi_slider_970728d78bc2c2a36f99-pagination swiper_styles-pagination swiper-pagination swiper-pagination-fraction swiper-pagination-horizontal">
            <span class="swiper-pagination-current" id="current-page">1</span>
            /
            <span class="swiper-pagination-total">{{$posts->count()}}</span>
        </div>

        @if($listings->count() < 5)
            <div
                class="swiper_styles-button-next swiper-button-disabled"
                id="next_button"
                tabindex="0"
                role="button"
                aria-label="Next slide"
                aria-controls="swiper-wrapper-32741108d34487f14"
                aria-disabled="true"
                onclick="showCards(event, 'next', 'news_item')"
            ></div>
        @else
            <div
                class="swiper_styles-button-next"
                id="next_button"
                tabindex="0"
                role="button"
                aria-label="Next slide"
                aria-controls="swiper-wrapper-32741108d34487f14"
                aria-disabled="false"
                onclick="showCards(event, 'next', 'news_item')"
            ></div>
        @endif
    </div>

    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
</div>

@push('styles')
    <link href="{{ Vite::asset('resources/css/mainpage/mainpage-posts.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ Vite::asset('resources/js/courses/courses-cards.js') }}"></script>
@endpush
