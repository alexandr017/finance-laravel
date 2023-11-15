<div class="silver-company-block">
    <div class="row">
        <div class="col-sm-3 v-flex">
            <div class="left b-wrap">
                @if(isset($cards[0]))
                <img loading="lazy" src="{{$cards[0]->logo}}" alt="{{$cards[0]->title}}" class="logo-company">
                <?php
                $tmpRatingK5M = isset($page->product_name)
                    ? str_replace('.0','',$cards[0]->km5)
                    : App\Algorithms\Frontend\Banks\K5MBank::getRatingByBankCategoryID($page->id);
                ?>
                @if($tmpRatingK5M != null)
                <div class="k5m-wrap">К5М = {{$tmpRatingK5M}}/10 <img loading="lazy" src="/old_theme/img/icon-help2.png" alt="Рейтинг К5М" class="lazy icon-help k5m_button"></div>
                @endif
                @else
                <img loading="lazy" src="{{$bank->logo}}" alt="{{$bank->name}}" class="logo-company">
                @endif
            </div>
        </div>
        <div class="col-sm-9">
            <p class="pupdate">
                <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}}</span>
            </p>

            @if(isset($cards[0]))
            <div class="rating-line micro">
                <?php
                $ratingValue = \App\Algorithms\Frontend\Banks\BankReviews::getRatingByReviews($reviews);
                $page->average_rating = $ratingValue;
                $page->number_of_votes = count($reviews);
                if (isset($page->category_id)) {
                    $linkToReviewsPage = Request::url() . '/reviews';
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
                <span class="sprite vzo_icons def_bg" data-src="/images/ic/icon-{{$current_item_icon}}.png" data-title="{{$all_vzo_icons[$current_item_icon]['title']}}"></span>
                @endif
                @endforeach
            </div>
            @endif
            @endif
        </div>
    </div>
    <div class="row row-margin-block-2">
        <?php
        if(isset($cards[0])) {
            if($cards[0]->additional != null) {
                $c_additional = str_replace("\r", '', $cards[0]->additional);
                $additionalArr = explode("\n", $c_additional);
            }
        }
        ?>
        @if(isset($additionalArr))
        <div class="col-sm-4">
            <ul>
                <?php $additionalCounter = 1; ?>
                @foreach($additionalArr as $additional)
                <?php if($additionalCounter > 3) break; ?>
                <?php if($additional == '') continue; ?>
                <?php $additionalCounter ++; ?>
                <li>{{$additional}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="line-scale-wrap @if(isset($additionalArr)) col-sm-8 @else col-sm-12 @endif">
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
</div>
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
            @if(count($firstCardDetails) % 2 == 1)
                <?php
                $firstCardDetails[''] = '';
                ?>
            @endif
            <?php $trCount = 0; ?>
            @foreach($firstCardDetails as $key => $detail)
                @if($trCount % 4 == 0) <tr> @endif
                    <th>{{$key}}</th>
                    <td>{!! $detail !!}</td>
                    <?php $trCount += 2;?>
                    @if($trCount % 4 == 0) </tr> @endif
            @endforeach
        @endif
    </table>
@endif

    <div class="row">
    @if(isset($cards[0]))
        <div class="col-sm-6">
            <a data-id="{{$cards[0]->id}}" class="form-btn1" @if($cards[0]->link_type==1) href="{{$cards[0]->link_1}}" @else href="{{$cards[0]->link_2}}" @endif target="_blank"> Оформить</a>
        </div>
        <div class="col-sm-6">
            <button id="load_card_for_bank" class="form-btn1">Все тарифы банка ({{count($cards)}} шт.)</button>
        </div>
    @endif
    </div>

</div>
