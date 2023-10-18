<label class="review_card-sect_btn review-card" for="read_more_{{ $review->id }}">
    <div class="review_card-cont">
        <div class="review_card-header">
            <div class="review_card-school">
                <div class="review_card-school_logo">
                    <img src="{{$company->logo}}" alt="Учебный Центр «Специалист»" title="Отзыв от: Женя Проскурин">
                </div>
                <div class="review_card-school_info">
                    <a class="review_card-school_name" href="/schools/uchebnyy-tsentr-spetsialist/">
                        {{$company->h1}}
                    </a>
                    <div class="review_card-school_rating">
                        <div class="review_card-school_rating_value">
                            {{$review->rating}}
                        </div>
                        <div class="review_card-school_stars">
                            @for($i = 0; $i < ($review->rating/0.5); $i++)
                                @if($i%2 < 1)
                                    <img src="/images/rating/LeftBlue.svg" alt="Рейтинг онлайн-школы" title="Рейтинг онлайн-школы">
                                @else
                                    <img src="/images/rating/RightBlue.svg" alt="Рейтинг онлайн-школы" title="Рейтинг онлайн-школы" class="rating-right_star">
                                @endif
                            @endfor

                            @for($i = 0; $i < ((5-$review->rating)/0.5); $i++)
                                @if($i%2 < 1)
                                    <img src="/images/rating/LeftGray.svg" alt="Рейтинг онлайн-школы" title="Рейтинг онлайн-школы">
                                @else
                                    <img src="/images/rating/RightGray.svg" alt="Рейтинг онлайн-школы" title="Рейтинг онлайн-школы" class="rating-right_star">
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="review_card-right_cont">
                <div class="review_card-date">
                    {{$review->created_at->formatLocalized('%e %B %Y')}}
                </div>
                <div class="review_card-author">
                    {{$review->author_name}}
                </div>
            </div>
        </div>

        <input type="checkbox" id="read_more_{{ $review->id }}" name="" value="" onchange="openReview(this)">

        <label class="review_card-pc_close" for="read_more_{{ $review->id }}">
            {{--            <img src="/local/templates/kursi/components/bitrix/catalog.item/review_card/img/close.svg" class="review_card-pc_close-default" alt="Закрыть">--}}
            {{--            <img src="/local/templates/kursi/components/bitrix/catalog.item/review_card/img/rCloseHover.svg" class="review_card-pc_close-hover" alt="Закрыть">--}}
        </label>

        <div class="review_card-data">
            <div class="review_card-sect">
                <div class="review_card-sect_title">
                    Плюсы:
                </div>
                <div class="review_card-sect_value">
                    {!! $review->pluses ?? '-' !!}
                </div>
            </div>

            <div class="review_card-sect">
                <div class="review_card-sect_title">
                    Минусы:
                </div>
                <div class="review_card-sect_value">
                    {!! $review->minuses !!}
                </div>
            </div>

            <div class="review_card-sect">
                <div class="review_card-sect_title">
                    Комментарий:
                </div>
                <div class="review_card-sect_value">
                    {!! $review->content !!}
                </div>
            </div>
        </div>

        <label class="review_card-sect_btn" for="read_more_{{ $review->id }}" id="read-all">Читать полностью</label>
    </div>
</label>
@push('styles')
    <link href="{{ Vite::asset('resources/css/company/company-review.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ Vite::asset('resources/js/company/company-review.js') }}"></script>
@endpush
