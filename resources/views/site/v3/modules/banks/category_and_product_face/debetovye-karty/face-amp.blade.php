<div class="silver-company-block border one-offer">
    <div class="top-cart">
        @if(isset($cards[0]))
            <div class="name-line">{{$cards[0]->title}}</div>
        @endif
        <div class="rating-line micro">
            <?php
            $ratingValue = \App\Algorithms\Frontend\Banks\BankReviews::getRatingByReviews($reviews);
            $page->average_rating = $ratingValue;
            $page->number_of_votes = count($reviews);
            if (isset($page->category_id)) {
                $linkToReviewsPage = str_replace('/amp', '', Request::url())  . '/reviews';
            } elseif (isset($cards[0]) && $cards[0]->link_to_reviews_page != null) {
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
        <p class="pupdate">
            <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}}</span>
        </p>
    </div>
    <div class="row mob-relative">
        @if(isset($cards[0]))
            <div class="col-md-4 mob-mar">
                <amp-img width="250" height="120" layout="fixed" src="{{$cards[0]->logo}}" alt="{{$cards[0]->logo}}"></amp-img>
                <?php
                $tmpRatingK5M = isset($page->product_name)
                    ? str_replace('.0','',$cards[0]->km5)
                    : App\Algorithms\Frontend\Banks\K5MBank::getRatingByBankCategoryID($page->id);
                ?>
                @if($tmpRatingK5M != null)
                <div class="bor">
                    <div class="tt">К5М = {{$tmpRatingK5M}}/10</div>
                </div>
                @endif

                <p>{!! str_replace(['<p>','</p>'], '', Shortcode::compile(System::nofollow($page->lead))) !!}</p>

            </div><?php /* col-md-4 */ ?>
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
                    $firstCardDetails['Открытие'] = $cards[0]->opened . ' ₽';
                    $value = '';
                }
                if (isset($cards[0]->maintenance) && $cards[0]->maintenance != null) {
                    $firstCardDetails['Обслуживание'] = $cards[0]->maintenance . ' ₽';
                    $value = '';
                }
                if (isset($cards[0]->age_min) && $cards[0]->age_min != null) {
                    $value = 'от ' . $cards[0]->age_min;
                }
                if (isset($cards[0]->age_max) && $cards[0]->age_max != null && $cards[0]->age_max) {
                    $value .= ' до ' . $cards[0]->age_max;
                }
                if ($value != '') {
                    $value .= ' лет';
                    $firstCardDetails['Возраст'] = $value;
                    $value = '';
                }
                if (isset($cards[0]->licency) && $cards[0]->licency != null) {
                    $firstCardDetails['Лицензия'] = $cards[0]->licency;
                    $value = '';
                }
                if (isset($cards[0]->docs) && $cards[0]->docs != null) {
                    $firstCardDetails['Документы'] = $cards[0]->docs;
                    $value = '';
                }
                if (isset($cards[0]->register) && $cards[0]->register != null) {
                    $firstCardDetails['Регистрация'] = $cards[0]->register;
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
            <a data-id="{{$cards[0]->id}}" class="form-btn1"  @if($cards[0]->link_type==1) href="{{$cards[0]->link_1}}" @else href="{{$cards[0]->link_2}}"  @endif target="_blank">Оформить</a>
    @endif    <!-- end col-md-6 -->
    </div><!-- end row -->
</div>