<h2 class="index_subtitle command">Команда</h2>
<div class="person-list swiper_styles-slider slider_person_slider_31bd70ba83bb5ae47065 swiper-initialized swiper-horizontal" id="person_slider_31bd70ba83bb5ae47065">

    <div class="swiper_styles-wraper swiper-wrapper" id="swiper-wrapper-83fe791d272b75eb" aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">


        @php $i = 1 @endphp
        @foreach($team as $employee)
            <div class="swiper-slide @if($i == 1) swiper-slide-active @else swiper-slide-next @endif" role="group" aria-label="{{$i}} / {{$team->count()}}">
                <div class="person-item">
                    <img class="person_picture" src="{{$employee->photo}}" alt="{{$employee->name}}" title="{{$employee->name}}" loading="lazy">
                    <div class="person_info">
                        <div class="person_name">{{$employee->name}}</div>
                        <div class="person_post">{{$employee->job}}</div>
                        <div class="person_link">
                            <a class="white_button_template" href="/{{$employee->url}}">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
            @php $i++ @endphp
        @endforeach



    </div>


    <div class="swiper_styles-pagination_cont">
        <div class="slider_person_slider_31bd70ba83bb5ae47065-button-prev swiper_styles-button-prev swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-83fe791d272b75eb" aria-disabled="true"></div>
        <div class="slider_person_slider_31bd70ba83bb5ae47065-pagination swiper_styles-pagination swiper-pagination swiper-pagination-fraction swiper-pagination-horizontal"><span class="swiper-pagination-current">1</span> / <span class="swiper-pagination-total">13</span></div>
        <div class="slider_person_slider_31bd70ba83bb5ae47065-button-next swiper_styles-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-83fe791d272b75eb" aria-disabled="false"></div>
    </div>

    <div class="person-item last_element_label"></div>
    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
</div>
