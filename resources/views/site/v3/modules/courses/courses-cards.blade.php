<div class="kursi_slider_cont_scroll">
    <div
        class="swiper_styles-slider slider_kursi_slider_224a58da6a119cab6c81 kursi_slider_cont bx-blue swiper-initialized swiper-horizontal swiper-backface-hidden"
        id=""
        data-entity=""
    >
        <div class="swiper_styles-wraper swiper-wrapper" id="swiper-wrapper-75d4bfbee56cdc94" aria-live="polite">
            @foreach($courses as $key => $course)
                @if(isset($fromMainPage))
                    @php($class = 'card_white')
                @elseif($key%2 == 0)
                    @php($class = 'card_green')
                @else
                    @php($class = 'card_black')
                @endif
                @include('site.v3.modules.courses.course-card', ['course' => $course, 'class' => $class])
            @endforeach
        </div>

        <div class="swiper_styles-pagination_cont">
            <div
                class="slider_kursi_slider_970728d78bc2c2a36f99-button-prev swiper_styles-button-prev swiper-button-disabled"
                id="prev_button"
                tabindex="-1"
                role="button"
                aria-label="Previous slide"
                aria-controls="swiper-wrapper-32741108d34487f14"
                aria-disabled="true"
                onclick="showCards(event, 'prev', 'kursi_slider-cont')"
            ></div>

            <div class="slider_kursi_slider_970728d78bc2c2a36f99-pagination swiper_styles-pagination swiper-pagination swiper-pagination-fraction swiper-pagination-horizontal">
                <span class="swiper-pagination-current" id="current-page">1</span>
                /
                <span class="swiper-pagination-total">{{$courses->count()}}</span>
            </div>

            @if($courses->count() < 5)
                <div
                    class="slider_kursi_slider_970728d78bc2c2a36f99-button-next swiper_styles-button-next swiper-button-disabled"
                    id="next_button"
                    tabindex="0"
                    role="button"
                    aria-label="Next slide"
                    aria-controls="swiper-wrapper-32741108d34487f14"
                    aria-disabled="true"
                    onclick="showCards(event, 'next', 'kursi_slider-cont')"
                ></div>
            @else
                <div
                    class="slider_kursi_slider_970728d78bc2c2a36f99-button-next swiper_styles-button-next"
                    id="next_button"
                    tabindex="0"
                    role="button"
                    aria-label="Next slide"
                    aria-controls="swiper-wrapper-32741108d34487f14"
                    aria-disabled="false"
                    onclick="showCards(event, 'next', 'kursi_slider-cont')"
                ></div>
            @endif
        </div>
    </div>
    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
</div>

@push('styles')
    <link href="{{ Vite::asset('resources/css/courses/courses-cards.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ Vite::asset('resources/js/courses/courses-cards.js') }}"></script>
@endpush
