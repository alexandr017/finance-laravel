<div class="silver-company-block">
    <p class="pupdate">
        <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}}</span>
    </p>
    @if(isset($cards[0]))
        <img src="{{$cards[0]->logo}}" alt="{{$cards[0]->title}}" class="logo-company">
    @else
    <img loading="lazy" src="{{$bank->logo}}" alt="{{$bank->name}}" class="logo-company">
    @endif

    @if(isset($cards[0]))
    <div class="rating-line micro">
        <?php
        $ratingValue = \App\Algorithms\Frontend\Banks\BankReviews::getRatingByReviews($reviews);
        $page->average_rating = $ratingValue;
        $page->number_of_votes = count($reviews);
        if (isset($page->category_id)) {
            $linkToReviewsPage = Request::url() . '/otzyvy';
        } elseif ($cards[0]->link_to_reviews_page != null) {
            $linkToReviewsPage = $cards[0]->link_to_reviews_page;
        }
        ?>
        @if(isset($linkToReviewsPage))
        {!! App\Algorithms\System::rating($ratingValue) !!}
        <div class="text-rating">
            <a rel="nofollow" href="/banki/{{$bank->alias}}/otzyvy">{{count($reviews)}} {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}</a>
        </div>
        <div class="val-rating">(<span>{{$ratingValue}}</span> из <span>5</span>)</div>
        @endif
    </div>
    @endif

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
            <img class="sprite vzo_icons" src="/images/ic/icon-{{$current_item_icon}}.png" alt="{{$all_vzo_icons[$current_item_icon]['title']}}" data-title="{{$all_vzo_icons[$current_item_icon]['title']}}">
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
            if (isset($cards[0]->opened) && $cards[0]->opened != null) {
                $value = $cards[0]->opened;
            }
            if ($value != '') {
                $value .= ' ₽';
                $firstCardDetails['Открытие'] = $value;
                $value = '';
            }
            if (isset($cards[0]->maintenance) && $cards[0]->maintenance != null) {
                $value = $cards[0]->maintenance;
            }
            if ($value != '') {
                $value .= ' ₽';
                $firstCardDetails['Обслуживание'] = $value;
                $value = '';
            }
            if (isset($cards[0]->internet_bank) && $cards[0]->internet_bank != null) {
                $value = $cards[0]->internet_bank;
            }
            if ($value != '') {
                $firstCardDetails['Интернет банк'] = $value;
                $value = '';
            }
            if (isset($cards[0]->mobile_bank) && $cards[0]->mobile_bank != null) {
                $value = $cards[0]->mobile_bank;
            }
            if ($value != '') {
                $firstCardDetails['Мобильный банк'] = $value;
                $value = '';
            }
            if (isset($cards[0]->sms_info) && $cards[0]->sms_info != null) {
                $value = $cards[0]->sms_info;
            }
            if ($value != '') {
                $firstCardDetails['СМС-информирование'] = $value;
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

        <button id="load_card_for_bank" class="form-btn1">Все тарифы банка ({{count($cards)}} шт.)</button>
    @endif
</div>