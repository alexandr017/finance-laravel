<div class="swiper_styles-item kursi_slider-cont swiper-slide " style="/*width:330px*/" role="group" aria-label="1 / 2">

{{--    @dd($class)--}}
    <div class="kurse_card {{$class}} card_mobile">

        <div class="kurse_card-title">
            {{$course->title}}
        </div>
        <div class="kurse_card-length">
            <p class="kurse_card-length_title">
                Длительность:
            </p>
            <p class="kurse_card-length_value">
                 {{ $course->duration}} {{__('courses_duration_types.' . $course->duration_type)}}
            </p>
        </div>
        <div class="kurse_card-school">
            <div class="school_minicard-cont">
                <a class="school_minicard-logo" href="/{{$course->school?->url?->url}}">
                    <img src="{{$course->school->logo}}" alt="{{$course->school?->h1}}" title="{{$course->school?->h1}}">
                </a>
                <div class="school_minicard-text">
                    <div class="school_minicard-title">
                        <a href="/{{$course->school?->url?->url}}">
                            {{$course->school?->name}}
                        </a>
                    </div>

                    <div class="school_minicard-subtitle">
                        @if($course->school ? $course->school->reviews->count() : 0)
                            <div class="school_minicard-rating">
                                <div class="school_minicard-rating_value">
                                    {{round($course->school?->rating_value ?: 0, 2)}}
                                </div>

                                <img src="/images/system/rating_star_blue.svg" alt="Картинка оценки курса" title="Картинка оценки курса">
                            </div>
                            <a class="school_minicard-reviews" href="/{{$course->school?->url?->url}}/#reviews">
                                (
                                <p class="school_minicard-reviews_value">
                                    {{$course->school?->rating_count ?: 0}}
                                </p>
                                <p class="school_minicard-reviews_text">
                                    отзывов
                                </p>
                                )
                            </a>
                        @else
                            <a class="school_minicard-reviews" href="/{{$course->school?->url?->url}}/#reviews">
                                <p class="school_minicard-reviews_value">
                                    0
                                </p>
                                <p class="school_minicard-reviews_text">
                                    отзывов
                                </p>
                            </a>
                        @endif

                    </div>

                </div>
            </div>
        </div>

        <div class="kurse_card-tags">
            @foreach($course->tags as $tag)
                <div class="kurse_card-tag_element">
                    {{$tag->name}}
                </div>

            @endforeach

        </div>


        <div class="kurse_card-price">
            @if($course->cost != $course->sale_cost)
                <div class="kurse_card-old_price">
                    {{ substr(number_format($course->cost, 0, '', ' '), 0, -3) . ' ' . substr($course->cost, -3) }} ₽
                </div>
            @endif


            <div class="kurse_card-now_price">
                <div class="kurse_card-price_sum">
                    {{ substr(number_format($course->sale_cost, 0, '', ' '), 0, -3) . ' ' . substr($course->sale_cost, -3) }} ₽
                </div>
            </div>
        </div>

        <!-- <div class="kurse_card-link"> -->
        <a class="kurse_card-link" rel="sponsored" href="{{$course->affiliate_link}}" onclick="ym(91433233,'reachGoal','CourseAggregator'); return true;" target="_blank">Подробнее</a>

        <!-- </div> -->
    </div>
</div>
@push('styles')
    <link href="{{ Vite::asset('resources/css/courses/course-card.css') }}" rel="stylesheet">
@endpush
