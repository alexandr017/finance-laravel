<div class="silver-company-block">
    <div class="row">
        <div class="col-sm-3 v-flex">
            <div class="left b-wrap">
                <img loading="lazy" src="{{$bank->logo}}" alt="{{$bank->name}}" class="logo-company">
            </div>
        </div>
        <div class="col-sm-9">
            <p class="pupdate">
                <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}}</span>
            </p>

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
                        <a rel="nofollow" href="/banki/{{$bank->alias}}/otzyvy"><span>{{count($reviews)}}</span> {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}</a>
                </div>
                <div class="val-rating">(<span>{{$ratingValue}}</span> из <span>5</span>)</div>
            </div>

            <p>{!! str_replace(['<p>','</p>'], '', Shortcode::compile(System::nofollow($bank->lead))) !!}</p>


        </div>
    </div>

    <table class="company-face-table">
        <tr>
            <th>Лицензия</th>
            <td>{{$bank->licence}}</td>
            <th>Официальный сайт</th>
            <td>{{$bank->site}}</td>
        </tr>
        <tr>
            <th>Дата регистрации</th>
            <td>{{date('d.m.Y', strtotime($bank->date_opened))}}</td>
            <th>Телефоны</th>
            <td>{{$bank->phone}}</td>
        </tr>
    </table>

</div>
