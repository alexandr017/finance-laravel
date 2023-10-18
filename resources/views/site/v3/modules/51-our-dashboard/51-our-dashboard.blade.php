<div class="about_head page_head">
    <h1 class="about_head-title page_head-title">{{$page->h1}}</h1>
    <div class="about_head-desk page_head-desk">
        <div class="about_head-desk_test page_head-desk_text">{!! $page->lead !!}</div>
    </div>
    <div class="about_head-img page_head-img">
        <!-- <img src="" alt=""> -->
    </div>
</div>
<div class="about-total">
    <div class="school_total about-total_cont ">
        <div class="scholl_total-head about-total_head">
            <img src="/v3/images/about/schools_total.png" alt="Картинка количества онлайн-школ на сайте" title="Количество онлайн-школ на сайте">
            <p>{{$countSchools}}</p>
        </div>
        <div class="scholl_total-text about-total_text">онлайн-школ<br>на сайте</div>
    </div>
    <div class="kursi_total about-total_cont ">
        <div class="kursi_total-head about-total_head">
            <img src="/v3/images/about/kursi_total.png" alt="Картинка количества онлайн-курсов" title="Количество онлайн-курсов">
            <p>{{$coursesCount}}</p>
        </div>
        <div class="kursi_total-text about-total_text">курсов</div>
    </div>
    <div class="persons_total about-total_cont ">
        <div class="persons_total-head about-total_head">
            <img src="/v3/images/about/persons_total.png" alt="Картинка количества человек в команде" title="Количество человек в команде">
            <p>{{$employeesCount}}</p>
        </div>
        <div class="persons_total-text about-total_text">человек<br>в команде</div>
    </div>
    <div class="reviews_total about-total_cont ">
        <div class="reviews_total-head about-total_head">
            <img src="/v3/images/about/reviews_total.png" alt="Картинка количества отзывов о онлайн-школах" title="Количества отзывов о онлайн-школах">
            <p>{{$reviewsCount}}</p>
        </div>
        <div class="reviews_total-text about-total_text">отзывов</div>
    </div>
</div>
