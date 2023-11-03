<p>{!! str_replace(['<p>','</p>'], '', Shortcode::compile(System::nofollow($bank->lead))) !!}</p>
<div class="border">
    <div class="text-center">
        <amp-img width="250" height="120" layout="fixed" src="{{$bank->logo}}" alt="{{$bank->logo}}"></amp-img>
    </div>


    <div class="rating-line text-center">
        @if($bank->average_rating!=null)
        {!! RatingParser::printImgRatingByValueForAMP($bank->average_rating) !!}
        <div class="text-rating">
            <a href="/banks/{{$bank->alias}}/reviews">{{count($reviews)}}  {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}</a>
            <span class="val-rating">({{$bank->average_rating}} из 5)</span>
        </div>
        @endif
    </div>

    <div class="refresh-item text-center">
        <span>Обновлено</span> <span>{{fake_update_offer($bank->created_at)}}</span>
        <?php $tmpRatingK5M = App\Algorithms\Frontend\Banks\K5MBank::getRatingByBankID($bank->id); ?>
    </div>

    <table class="company-face-table">
        <tr>
            <th>Лицензия</th>
            <td>{{$bank->licence}}</td>
        </tr>
        <tr>
            <th>Сайт</th>
            <td>{{$bank->site}}</td>
        </tr>
        <tr>
            <th>Дата регистрации</th>
            <td>{{date('d.m.Y', strtotime($bank->date_opened))}}</td>
        </tr>
        <tr>
            <th>Телефоны </th>
            <td>{{$bank->phone}}</td>
        </tr>
    </table>
    <?php
    $realCount = 0; $ratingValue = 0; $ratingValueTmp = 0;
    foreach ($reviews as  $review) {
        if($review->rating != null){
            $ratingValueTmp += $review->rating;
            $realCount++;
        }
    }
    if($realCount != 0){
        $ratingValue = round($ratingValueTmp / $realCount,2);
        $page->average_rating = $ratingValue;
        $page->number_of_votes = count($reviews);
    } else {
        $ratingValue = 0;
    }
    ?>
</div>