<div class="universalrating" id="rating_">
    <div class="universalrating-title">
        Информация была полезна?
    </div>

    <div class="universalrating-form">
        <form>
            <div id="half-stars-example" class="disabled">
                <div class="rating-group">
                    <input class="rating__input rating__input--none" checked name="rating" id="rating-0" value="0" type="radio">
                    <label aria-label="0 stars" class="rating__label" for="rating-0"></label>


                    <label aria-label="0.5" class="rating__label rating__label--half" for="rating-0.5">
                        <div class="star-left"></div>
                        <i class="rating__icon rating__icon--star fa fa-star-half"></i>
                    </label>
                    <input class="rating__input" name="rating" id="rating-0.5" value="0.5" type="radio" disabled  >

                    <label aria-label="1" class="rating__label " for="rating-1">
                        <div class="star-right"></div>
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                    </label>
                    <input class="rating__input" name="rating" id="rating-1" value="1" type="radio" disabled  >

                    <label aria-label="1.5" class="rating__label rating__label--half" for="rating-1.5">
                        <div class="star-left"></div>
                        <i class="rating__icon rating__icon--star fa fa-star-half"></i>
                    </label>
                    <input class="rating__input" name="rating" id="rating-1.5" value="1.5" type="radio" disabled  >

                    <label aria-label="2" class="rating__label " for="rating-2">
                        <div class="star-right"></div>
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                    </label>
                    <input class="rating__input" name="rating" id="rating-2" value="2" type="radio" disabled  >

                    <label aria-label="2.5" class="rating__label rating__label--half" for="rating-2.5">
                        <div class="star-left"></div>
                        <i class="rating__icon rating__icon--star fa fa-star-half"></i>
                    </label>
                    <input class="rating__input" name="rating" id="rating-2.5" value="2.5" type="radio" disabled  >

                    <label aria-label="3" class="rating__label " for="rating-3">
                        <div class="star-right"></div>
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                    </label>
                    <input class="rating__input" name="rating" id="rating-3" value="3" type="radio" disabled  >

                    <label aria-label="3.5" class="rating__label rating__label--half" for="rating-3.5">
                        <div class="star-left"></div>
                        <i class="rating__icon rating__icon--star fa fa-star-half"></i>
                    </label>
                    <input class="rating__input" name="rating" id="rating-3.5" value="3.5" type="radio" disabled  >

                    <label aria-label="4" class="rating__label " for="rating-4">
                        <div class="star-right"></div>
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                    </label>
                    <input class="rating__input" name="rating" id="rating-4" value="4" type="radio" disabled  >

                    <label aria-label="4.5" class="rating__label rating__label--half" for="rating-4.5">
                        <div class="star-left"></div>
                        <i class="rating__icon rating__icon--star fa fa-star-half"></i>
                    </label>
                    <input class="rating__input" name="rating" id="rating-4.5" value="4.5" type="radio" disabled  >

                    <label aria-label="5" class="rating__label " for="rating-5">
                        <div class="star-right"></div>
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                    </label>
                    <input class="rating__input" name="rating" id="rating-5" value="5" type="radio" disabled checked >
                </div>
            </div>

        </form>
    </div>
    <div class="universalrating-total">
        <p>
            <span class="quantity">{{4}}</span> оценок, среднее <span class="rating">{{5}}</span> из 5
        </p>
    </div>
</div>


@push('styles')
    <link href="{{ Vite::asset('resources/css/listing/rating_stars.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ Vite::asset('resources/js/ratings/rating_stars_simple.js') }}"></script>
@endpush
