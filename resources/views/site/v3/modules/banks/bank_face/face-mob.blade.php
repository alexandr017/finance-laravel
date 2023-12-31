<div class="silver-company-block">
    <p class="pupdate">
        <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}}</span>
    </p>

    <img loading="lazy" src="{{$bank->logo}}" alt="{{$bank->name}}}" class="logo-company">
    <div class="rating-line micro">
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
        {!! App\Algorithms\System::rating($ratingValue) !!}
        <div class="text-rating">
            <a rel="nofollow" href="/banks/{{$bank->alias}}/review"><span>{{count($reviews)}}</span> {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}</a>
        </div>
        <div class="val-rating">(<span>{{4}}</span> из <span>5</span>)</div>
    </div>

    <p>{!! str_replace(['<p>','</p>'], '', Shortcode::compile(System::nofollow($bank->lead))) !!}</p>

    <div class="scales">
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
    </div>
</div>