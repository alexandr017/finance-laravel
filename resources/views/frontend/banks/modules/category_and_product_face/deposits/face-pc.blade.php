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
                {!! App\Models\System::rating($ratingValue) !!}
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
            <?php /*
            @if(isset($cards[0]))
            <div class="row row-margin-block-1">
                <div class="col-sm-4">
                    <span class="scb-label"><i class="fa fa-money"></i> Сумма</span>
                    <div class="scb-value">от {{number_format($cards[0]->sum_min, 0, '.', ' ')}} @if(isset($cards[0]->sum_max) && $cards[0]->sum_max != null && $cards[0]->sum_max != 0) до {{number_format($cards[0]->sum_max, 0, '.', ' ')}} руб. @endif</div>
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
            */ ?>
        </div>
    </div>
    <div class="row row-margin-block-2">
        <?php
        /*
        if(isset($cards[0])) {
            if($cards[0]->additional != null) {
                $c_additional = str_replace("\r", '', $cards[0]->additional);
                $additionalArr = explode("\n", $c_additional);
            }
        }
        */
        ?>
        <?php /*
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
        */ ?>
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
        /*
        if (isset($cards[0]->sum_min) && $cards[0]->sum_min != null) {
            $value = 'от ' . number_format($cards[0]->sum_min, 0, '.', ' ');
        }
        if (isset($cards[0]->sum_max) && $cards[0]->sum_max != null && $cards[0]->sum_max != 0) {
            $value .= ' до ' . number_format($cards[0]->sum_max, 0, '.', ' ');
        }
        if ($value != '') {
            $value .= ' руб';
            $firstCardDetails['Сумма'] = $value;
            $value = '';
        }
        if (isset($cards[0]->term_min) && $cards[0]->term_min != null) {
            $value = 'от ' . $cards[0]->term_min;
        }
        if (isset($cards[0]->term_max) && $cards[0]->term_max != null && $cards[0]->term_max != 0) {
            $value .= ' до ' . number_format($cards[0]->term_max, 0, '.', ' ');
        }
        */
        if ($cards[0]->sum_min != null) {
            $firstCardDetails['Минимальная сумма вклада'] = number_format($cards[0]->sum_min, 0, '.', ' ') . ' руб';
        }
        if ($cards[0]->sum_max != null) {
            $firstCardDetails['Минимальный срок вклада'] = number_format($cards[0]->sum_max, 0, '.', ' ') . ' руб';
        }
        if ($cards[0]->percent_min != null) {
            $firstCardDetails['Процент по вкладу'] = $cards[0]->percent_min . '%';
        }
        if ($cards[0]->partial_withdrawal != null) {
            $firstCardDetails['Возможность частичное снятие'] = $cards[0]->partial_withdrawal ? 'Есть' : 'Нет';
        }
        if ($cards[0]->replanishment != null) {
            $firstCardDetails['Возможность пополнения'] = $cards[0]->replanishment ? 'Есть' : 'Нет';
        }
        if ($cards[0]->currency != null) {
            $firstCardDetails['Виды валют'] = $cards[0]->currency;
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
            <a data-id="{{$cards[0]->id}}" class="form-btn1" @if($cards[0]->link_type==1) href="{{$cards[0]->link_1}}" @else href="{{$cards[0]->link_2}}" @endif target="_blank"><i class="fa fa-lock"></i> Открыть</a>
        </div>

        <div class="col-sm-6">
            <button id="load_card_for_bank" class="form-btn1">Все продукты банка ({{count($cards)}} шт.)</button>
        </div>
        @endif
    </div>
</div>
