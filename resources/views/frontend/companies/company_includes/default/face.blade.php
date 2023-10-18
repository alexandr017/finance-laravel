<div class="row">
    <div class="col-md-4">
        <div class="top-credit-cards">
            <span @if($company->closed) class="closed-company" @endif>
                <img loading="lazy" src="https://finance.ru{{$company->img}}" alt="{{$company->h1}}" class="alignleft no-margin">
            </span>
        </div>
    </div>
    <div class="col-md-8">
        <p class="pupdate">
            <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}}</span>
        </p>
        <?php $ratingValue = \App\Algorithms\Frontend\Banks\BankReviews::getRatingByReviews($reviews); ?>
        @if(isset($cards[0]))
        <div class="rating-line micro">
            {!! App\Models\System::rating($ratingValue) !!}
            <div class="text-rating">
                <a rel="nofollow" href="{{$cards[0]->link_to_reviews_page}}">{{count($reviews)}} {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}</a>
            </div>
            <div class="val-rating">({{$ratingValue}} из 5)</div>
        </div>
        @endif
        <?php echo Shortcode::compile(System::nofollow($company->text_before)); ?>
    </div>
</div>