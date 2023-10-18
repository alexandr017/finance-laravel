
<div class="school_add_review">
    <div class="universalrating" id="rating_{{$companyId}}">
        <h2 class="universalrating-title">
            Оставьте свой отзыв
        </h2>

        <div class="school_add_review_cont">
            <div class="universalrating-form">
                <div id="add-school-review">
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

                    <div class="form_field_cont">
                        <div class="form_field_title">
                            Имя<font color="red"><span class="form-required starrequired">*</span></font>
                        </div>
                        <div class="form_field_input ">
                            <input type="text" placeholder="Иван" name="name" id="name_{{$companyId}}" value="">
                        </div>
                    </div>
                    <div class="form_field_cont">
                        <div class="form_field_title">
                            Плюсы
                        </div>
                        <div class="form_field_input ">
                            <textarea id="pluses_{{$companyId}}" name="pluses" cols="40" rows="5" class="inputtextarea"></textarea>
                        </div>
                    </div>

                    <div class="form_field_cont">
                        <div class="form_field_title">
                            Минусы
                        </div>
                        <div class="form_field_input ">
                            <textarea id="minuses_{{$companyId}}" name="minuses" cols="40" rows="5" class="inputtextarea"></textarea>
                        </div>
                    </div>

                    <div class="form_field_cont">
                        <div class="form_field_title">
                            Комментарий
                        </div>
                        <div class="form_field_input ">
                            <textarea id="content_{{$companyId}}" name="content" cols="40" rows="5" class="inputtextarea"></textarea>
                        </div>
                    </div>
                    <p style="margin-bottom: 24px;">
                        <font color="red"><span class="form-required starrequired">*</span></font>
                        - обязательные поля
                    </p>
                    <div class="form_buttons">
                        <button class="blue_button_template"  onclick="leaveReview({{$companyId}})"> Отправить </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




{{--<style media="screen">--}}

{{--</style>--}}

@push('styles')
    <link href="{{ Vite::asset('resources/css/company/company-review-add.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ Vite::asset('resources/js/company/company-review-add.js') }}"></script>
@endpush
{{--<script>--}}

{{--</script>--}}