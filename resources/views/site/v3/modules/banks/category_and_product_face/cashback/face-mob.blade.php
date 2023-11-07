<div class="silver-company-block">
    <p class="pupdate">
        <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}}</span>
    </p>
    @if(isset($cards[0]))
        <img loading="lazy" src="{{$cards[0]->logo}}" alt="{{$cards[0]->title}}" class="logo-company">
    <?php
    $tmpRatingK5M = isset($page->product_name)
        ? str_replace('.0','',$cards[0]->km5)
        : App\Algorithms\Frontend\Banks\K5MBank::getRatingByBankCategoryID($page->id);
    ?>

    <img loading="lazy" src="{{$bank->logo}}" alt="{{$bank->name}}" class="logo-company">

    <div class="rating-line micro">
        <?php
        $ratingValue = \App\Algorithms\Frontend\Banks\BankReviews::getRatingByReviews($reviews);
        $page->average_rating = $ratingValue;
        $page->number_of_votes = count($reviews);
        if (isset($page->category_id)) {
            if (isset($reviewsPage) && $reviewsPage != null ) {
                $linkToReviewsPage = Request::url() . '/reviews';
            }
        } elseif ($cards[0]->link_to_reviews_page != null) {
            $linkToReviewsPage = $cards[0]->link_to_reviews_page;
        }
        ?>
        @if(isset($linkToReviewsPage))
            {!! App\Models\System::rating($ratingValue) !!}
            <div class="text-rating">
                <a rel="nofollow" href="{{$linkToReviewsPage}}">{{count($reviews)}} {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}</a>
            </div>
            <div class="val-rating">(<span>{{$ratingValue}}</span> из <span>5</span>)</div>
        @endif
    </div>

    <p>{!! str_replace(['<p>','</p>'], '', Shortcode::compile(System::nofollow($page->lead))) !!}</p>

    @if(isset($cards[0]))
    @if($cards[0]->icons != null)
    <div class="vzo_icons_wrap">
        <?php
        $all_vzo_icons = \Config::get('icons');
        $current_vzo_icons = explode(',', $cards[0]->icons);
        ?>
        @foreach ($current_vzo_icons as $current_item_icon)
        @if (isset($all_vzo_icons[$current_item_icon]))
        <span class="sprite vzo_icons def_bg" data-src="/images/ic/icon-{{$current_item_icon}}.png" data-title="{{$all_vzo_icons[$current_item_icon]['title']}}"></span>
        @endif
        @endforeach
    </div>
    @endif
    @endif

    <div class="scales">
        @foreach($scales as $scale)
            @if($scale['count'] != 0)
                <div class="line-scale">
                    <span class="line-scale-title">{{$scale['title']}}</span>
                    <span class="line-scale-print">
                    <span class="progress progress-bar bg-success progress-bar-striped lsv-{{ceil($scale['sum']/$scale['count'])}}"></span>
                </span>
                    <span class="line-scale-value">{{ceil($scale['sum']/$scale['count'])}}/10</span>
                </div>
            @endif
        @endforeach
    </div>

    <?php
    if(isset($cards[0])) {
        if($cards[0]->additional != null) {
            $c_additional = str_replace("\r", '', $cards[0]->additional);
            $additionalArr = explode("\n", $c_additional);
        }
    }
    ?>
    @if(isset($additionalArr))
        <ul>
            @foreach($additionalArr as $additional)
                <?php if($additional == '') continue; ?>
                <li>{{$additional}}</li>
            @endforeach
        </ul>
    @endif

    @if(isset($cards[0]))
        <table class="company-face-table">
            <?php
            $value = '';
            $firstCardDetails = [];
            if(isset($cards[0]->opened) && $cards[0]->opened != null){
                $firstCardDetails['Открытие'] = $cards[0]->opened.' руб.';
                $value = '';
            }
            if(isset($cards[0]->cache_back) && $cards[0]->cache_back != null){
                $firstCardDetails['Кэшбэк'] = $cards[0]->cache_back;
                $value = '';
            }
            if (isset($cards[0]->percent_min) && $cards[0]->percent_min != null) {
                $value = 'от ' . $cards[0]->percent_min;
            }
            if (isset($cards[0]->percent_max) && $cards[0]->percent_max != null && $cards[0]->percent_max != 0) {
                $value .= ' до ' . $cards[0]->percent_max;
            }
            if ($value != '') {
                $value .= ' %';
                $firstCardDetails['Процентная ставка в год'] = $value;
                $value = '';
            }
            if(isset($cards[0]->percent_on_balance) && $cards[0]->percent_on_balance != null){
                $firstCardDetails['Процент на остаток'] = $cards[0]->percent_on_balance.' %';
                $value = '';
            }
            if(isset($cards[0]->age_min) && $cards[0]->age_min != null){
                $value = 'от '.$cards[0]->age_min;
            }
            if(isset($cards[0]->age_max) && $cards[0]->age_max != null && $cards[0]->age_max){
                $value .= ' до '.$cards[0]->age_max;
            }
            if ($value != '') {
                $value .= ' лет';
                $firstCardDetails['Возраст'] = $value;
                $value = '';
            }
            ?>
            @if(count($firstCardDetails) != 0)
                @foreach($firstCardDetails as $key => $detail)
                    <tr>
                        <th>{{$key}}</th>
                        <td>{!! $detail !!}</td>
                    </tr>
                @endforeach
            @endif
        </table>
    @endif


    @if(isset($cards[0]))
        <a data-id="{{$cards[0]->id}}" class="form-btn1"
           @if($cards[0]->link_type==1) href="{{$cards[0]->link_1}}" @else href="{{$cards[0]->link_2}}"
           @endif target="_blank"> Оформить</a>

        <button id="load_card_for_bank" class="form-btn1">Все карты банка ({{count($cards)}} шт.)</button>
    @endif
</div>