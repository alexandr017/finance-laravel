<div class="silver-company-block border one-offer">
    <div class="top-cart">
        @if(isset($cards[0]))
            <div class="name-line h4">{{$cards[0]->title}}</div>

        <div class="rating-line micro">
            <?php
            $ratingValue = \App\Algorithms\Frontend\Banks\BankReviews::getRatingByReviews($reviews);
            $page->average_rating = $ratingValue;
            $page->number_of_votes = count($reviews);
            if (isset($page->category_id)) {
                $linkToReviewsPage = str_replace('/amp', '', Request::url())  . '/reviews';
            } elseif ($cards[0]->link_to_reviews_page != null) {
                $linkToReviewsPage = $cards[0]->link_to_reviews_page;
            }
            ?>
            @if(isset($linkToReviewsPage))
            {!! RatingParser::printImgRatingByValueForAMP($ratingValue) !!}
            <div class="text-rating">
                <a rel="nofollow" href="{{$linkToReviewsPage}}">{{count($reviews)}} {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}</a>
            </div>
            <div class="val-rating">(<span>{{$ratingValue}}</span> из <span>5</span>)</div>
            @endif
        </div>
        @endif
        <p class="pupdate">
            <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}}</span>
        </p>
    </div>
    <div class="row mob-relative">
        @if(isset($cards[0]))
            <div class="col-md-4 mob-mar">
                <amp-img width="250" height="120" layout="fixed" src="{{$cards[0]->logo}}" alt="{{$cards[0]->logo}}"></amp-img>

                <p>{!! str_replace(['<p>','</p>'], '', Shortcode::compile(System::nofollow($page->lead))) !!}</p>

            </div><?php /* col-md-4 */ ?>
        @endif
        @if(isset($cards[0]))
            @if(isset($cards[0]) && isset($cards[0]->sum_min) || isset($cards[0]->sum_max))
                <div class="lvc">Сумма: <div class="value"> @if(isset($cards[0]->sum_min))от {{number_format($cards[0]->sum_min, 0, '.', ' ')}}@endif @if(isset($cards[0]->sum_max)) @if($cards[0]->sum_max != null)
                            до {{number_format($cards[0]->sum_max, 0, '.', ' ')}} ₽ @endif @endif</div></div>
            @endif
            @if(isset($cards[0]) && isset($cards[0]->term_min) || isset($cards[0]->term_max))
                <div class="lvc">Срок: <div class="value">@if(isset($cards[0]->term_min)) от {{$cards[0]->term_min}} @endif @if(isset($cards[0]->term_max)) до {{$cards[0]->term_max}} дней @endif</div></div>
            @endif
            @if(isset($cards[0]) && isset($cards[0]->percent_min) || isset($cards[0]->percent_max))
                <div class="lvc">Процентная ставка: <div class="value">@if(isset($cards[0]->percent_min)) от {{$cards[0]->percent_min}} @endif @if(isset($cards[0]->percent_max)) до {{$cards[0]->percent_max}} % @endif</div></div>
            @endif
        @endif
        <div class="row row-margin-block-2">
            <?php /*
        <div class="@if($company->company_advantages!= null) col-sm-4 @else col-sm-1 @endif">
            {!! $company->company_advantages !!}
        </div>
        */ ?>
            <div class="col-sm-12">
                @foreach($scales as $scale)
                    @if($scale['count'] != 0)
                        <div class="line-scale">
                            <span class="line-scale-title">{{$scale['title']}}</span>
                            <span class="line-scale-print">
                                <?php
                                $progress_bar_width = ceil($scale['sum']/$scale['count']);
                                ?>
                                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$progress_bar_width}}"></span>
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
            <a data-id="{{$cards[0]->id}}" class="form-btn1"  @if($cards[0]->link_type==1) href="{{$cards[0]->link_1}}" @else href="{{$cards[0]->link_2}}" @endif target="_blank">Оформить</a>
    @endif
    </div><!-- end row -->
</div>