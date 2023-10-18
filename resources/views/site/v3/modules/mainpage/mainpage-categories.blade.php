<div class="catalog-section-list-cont">
    <div class="catalog_section_list-title_cont">
        <div class="catalog_section_list-title">
            Категории
        </div>
        <div class="catalog_section_list-subtitle">
            Выбери то, что тебе нравится
        </div>
    </div>

    <div class="catalog-section-list swiper_styles-slider slider_section_slider_82d0336cbb0c2e994246 swiper-initialized swiper-horizontal">
        <ul class="first_lvl swiper_styles-wraper swiper-wrapper" id="swiper-wrapper-51f202c934c9d9d8" aria-live="polite">
            @foreach($listings as $listing)
                @include('site.v3.modules.mainpage.mainpage-category-item', ['listing' => $listing])
            @endforeach
        </ul>

        <div class="swiper_styles-pagination_cont">
            <div
                class="swiper_styles-button-prev swiper-button-disabled"
                id="prev_button"
                tabindex="-1"
                role="button"
                aria-label="Previous slide"
                aria-controls="swiper-wrapper-32741108d34487f14"
                aria-disabled="true"
                onclick="showCards(event, 'prev', 'categories_slider-cont')"
            ></div>

            <div class="slider_kursi_slider_970728d78bc2c2a36f99-pagination swiper_styles-pagination swiper-pagination swiper-pagination-fraction swiper-pagination-horizontal">
                <span class="swiper-pagination-current" id="current-page">1</span>
                /
                <span class="swiper-pagination-total">{{$listings->count()}}</span>
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
                    onclick="showCards(event, 'next', 'categories_slider-cont')"
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
                    onclick="showCards(event, 'next', 'categories_slider-cont')"
                ></div>
            @endif
        </div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
</div>

@push('styles')
    <link href="{{ Vite::asset('resources/css/mainpage/mainpage-categories.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ Vite::asset('resources/js/courses/courses-cards.js') }}"></script>
@endpush
