<div class="silver-company-block">
    <div class="row">
        <div class="col-sm-3 v-flex">
            <div class="left b-wrap">
                @if(isset($cards[0]))
                <img loading="lazy" src="{{$cards[0]->logo}}" alt="{{$cards[0]->title}}" class="logo-company">
                @else
                <img loading="lazy" src="{{$bank->logo}}" alt="{{$bank->name}}" class="logo-company">
                @endif
            </div>
        </div>
        <div class="col-sm-9">

            <div class="rating-line">
                <?php
                $ratingValue = \App\Algorithms\Frontend\Banks\BankReviews::getRatingByReviews($reviews);
                $page->average_rating = $ratingValue;
                $page->number_of_votes = count($reviews);
                if (isset($page->category_id)) {
                    $linkToReviewsPage = Request::url() . '/reviews';
                } elseif (isset($cards[0]) && $cards[0]->link_to_reviews_page != null) {
                    $linkToReviewsPage = $cards[0]->link_to_reviews_page;
                }
                ?>
                @if(isset($linkToReviewsPage))
                {!! App\Algorithms\System::rating($ratingValue) !!}
                <div class="text-rating">
                    <a rel="nofollow" href="{{$linkToReviewsPage}}">{{count($reviews)}} {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}</a>
                </div>
                <div class="val-rating">(<span>{{$ratingValue}}</span> из <span>5</span>)</div>
                @endif


            </div>


            <span class="pupdate">
                <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}} <i class="fa fa-refresh fa-spin"></i></span>
            </span>


            <p>{!! str_replace(['<p>','</p>'], '', Shortcode::compile(System::nofollow($page->lead))) !!}</p>
            <div class="vzo_icons_wrap">
                @foreach ($icons as $current_item_icon)
                @if (isset($all_vzo_icons[$current_item_icon]))
                <span class="sprite vzo_icons def_bg" data-src="/images/ic/icon-{{$current_item_icon}}.png" data-title="{{$all_vzo_icons[$current_item_icon]['title']}}"></span>
                @endif
                @endforeach
            </div>
            @if(isset($cards[0]))
            <div class="row row-margin-block-1">
                <div class="col-sm-4">
                    <span class="scb-label"><i class="fa fa-money"></i> Сумма</span>
                    <div class="scb-value">от {{number_format($cards[0]->sum_min, 0, '.', ' ')}} @if(isset($cards[0]->sum_max) && $cards[0]->sum_max != null && $cards[0]->sum_max != 0) до {{number_format($cards[0]->sum_max, 0, '.', ' ')}} ₽ @endif</div>
                </div>
                <div class="col-sm-4">
                    <span class="scb-label"><i class="fa fa-calendar"></i> Срок</span>
                    <div class="scb-value">от {{$cards[0]->term_min}} @if(isset($cards[0]->term_max) && $cards[0]->term_max != null && $cards[0]->term_max != 0) до {{$cards[0]->term_max}} лет @endif</div>
                </div>
                <div class="col-sm-4">
                    <span class="scb-label"><i class="fa fa-percent"></i> Процентная ставка</span>
                    <div class="scb-value">от {{$cards[0]->percent_min}} @if(isset($cards[0]->percent_max) && $cards[0]->percent_max != null && $cards[0]->percent_max != 0) до {{$cards[0]->percent_max}} % @endif</div>
                </div>
            </div>
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
        <div class="col-sm-12">
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
        <?php /*
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
        </div> */ ?>
    </div>
    @if(isset($cards[0]))
    <table class="company-face-table">
        <?php
        $value = '';
        $firstCardDetails = [];
        if (isset($cards[0]->sum_min) && $cards[0]->sum_min != null) {
            $value = 'от ' . number_format($cards[0]->sum_min, 0, '.', ' ');
        }
        if (isset($cards[0]->sum_max) && $cards[0]->sum_max != null && $cards[0]->sum_max != 0) {
            $value .= ' до ' . number_format($cards[0]->sum_max, 0, '.', ' ');
        }
        if ($value != '') {
            $value .= ' ₽';
            $firstCardDetails['Сумма'] = $value;
            $value = '';
        }
        if (isset($cards[0]->term_min) && $cards[0]->term_min != null) {
            $value = 'от ' . $cards[0]->term_min;
        }
        if (isset($cards[0]->term_max) && $cards[0]->term_max != null && $cards[0]->term_max != 0) {
            $value .= ' до ' . number_format($cards[0]->term_max, 0, '.', ' ');
        }
        if ($value != '') {
            $value .= ' лет';
            $firstCardDetails['Срок'] = $value;
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
            $firstCardDetails['Процентная ставка'] = $value;
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
        if(isset($cards[0]->speed_see) && $cards[0]->speed_see != null){
            $firstCardDetails['Скорость рассмотрения заявки'] = $cards[0]->speed_see;
            $value = '';
        }
        if(isset($cards[0]->register) && $cards[0]->register != null){
            $firstCardDetails['Регистрация'] = $cards[0]->register;
            $value = '';
        }
        if(isset($cards[0]->experience) && $cards[0]->experience != null){
            $firstCardDetails['Стаж'] = $cards[0]->experience;
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
            <button id="load_card_for_bank" class="form-btn1">Все продукты банка ({{count($cards)}} шт.)</button>
        </div>
        @endif
    </div>
</div>
