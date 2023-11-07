<div class="silver-company-block one-offer">
    <div class="top-cart">
        @if(isset($cards[0]))
            <div class="name-line">{{$cards[0]->title}}</div>
        @endif
        <div class="rating-line micro">
            <?php
            /*
            $realCount = 0; $ratingValue = 0; $ratingValueTmp = 0;
            foreach ($reviews as  $review) {
                if($review->rating != null){
                    $ratingValueTmp += $review->rating;
                    $realCount++;
                }
            }
            if($realCount != 0){
                $ratingValue = round($ratingValueTmp / $realCount,2);
            } else {
                $ratingValue = 0;
            }
            */
            $ratingValue = 0;
            $reviews = [];
            ?>
            @if(isset($cards[0]))
                {!! RatingParser::printImgRatingByValueForAMP($cards[0]->ratingValue) !!}
            @endif
            <div class="text-rating">
                <a rel="nofollow" href="<?= str_replace('https://'.$_SERVER['SERVER_NAME'], '', URL::current()) ?>/reviews"><span itemprop="ratingCount">{{count($reviews)}}</span> {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}</a>
            </div>
            <div class="val-rating">(<span>{{$ratingValue}}</span> из <span>5</span>)</div>
        </div>
        <p class="pupdate">
            <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}}</span>
        </p>
    </div>
    <div class="row mob-relative">
        @if(isset($cards[0]))
            <div class="col-md-4 mob-mar">
                <amp-img width="250" height="120" layout="fixed" src="{{$cards[0]->logo}}" alt="{{$cards[0]->logo}}"></amp-img>
                <div class="bor">
                    <div class="tt">К5М = {{@str_replace('.0','',$cards[0]->km5)}}/10</div>
                </div>

                <p>{!! str_replace(['<p>','</p>'], '', Shortcode::compile(System::nofollow($page->lead))) !!}</p>

            </div><?php /* col-md-4 */ ?>
        @endif
        @if(isset($cards[0]))
            @if(isset($cards[0]) && isset($cards[0]->sum_min) || isset($cards[0]->sum_max))
                <div class="lvc">Сумма: <div class="value"> @if(isset($cards[0]->sum_min))от {{number_format($cards[0]->sum_min, 0, '.', ' ')}}@endif @if(isset($cards[0]->sum_max)) @if($cards[0]->sum_max != null)
                            до {{number_format($cards[0]->sum_max, 0, '.', ' ')}} руб. @endif @endif</div></div>
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
                    @if(isset($cards[0]->sum_min) || isset($cards[0]->sum_max))
                        <tr>
                            <th>Сумма</th>
                            <td>
                                @if(isset($cards[0]->sum_min)) @if($cards[0]->sum_min != null)
                                    от {{number_format($cards[0]->sum_min, 0, '.', ' ')}} @if(isset($cards[0]->sum_max)) @if($cards[0]->sum_max != null) до {{number_format($cards[0]->sum_max, 0, '.', ' ')}} руб. @endif @endif
                                @endif @endif
                            </td>
                        </tr>
                    @endif
                    @if(isset($cards[0]->term_min) || isset($cards[0]->term_max))
                        <tr>
                            <th>Срок</th>
                            <td>
                                @if(isset($cards[0]->term_min))@if($cards[0]->term_min != null)
                                    от {{$cards[0]->term_min}} @if(isset($cards[0]->term_max))@if($cards[0]->term_max != null) до {{$cards[0]->term_max}} дней@endif @endif
                                @endif @endif
                            </td>
                        </tr>
                    @endif
                    @if(isset($cards[0]->percent_min) || isset($cards[0]->percent_max))
                        <tr>
                            <th>Процентная ставка</th>
                            <td>
                                @if(isset($cards[0]->percent_min))@if($cards[0]->percent_min != null)
                                    от {{$cards[0]->percent_min}} @if(isset($cards[0]->percent_max)) @if($cards[0]->percent_max != null)до {{$cards[0]->percent_max}} @endif @endif %
                                @endif @endif
                            </td>
                        </tr>
                    @endif
                    @if(isset($cards[0]->age_min) || isset($cards[0]->age_max))
                        <tr>
                            <th>Возраст</th>
                            <td>
                                @if(isset($cards[0]->age_min)) @if($cards[0]->age_min != null)
                                    от {{$cards[0]->age_min}} @if(isset($cards[0]->age_max)) до {{$cards[0]->age_max}} @endif лет
                                @endif @endif
                            </td>
                        </tr>
                    @endif
                    @if(isset($cards[0]->docs) && $cards[0]->docs != null)
                        <tr>
                            <th>Документы</th>
                            <td>
                                {{$cards[0]->docs}}
                            </td>
                        </tr>
                    @endif
                    @if(isset($cards[0]->speed_see) && $cards[0]->speed_see != null)
                        <tr>
                            <th>Скорость рассмотрения заявки</th>
                            <td>
                                {{$cards[0]->speed_see}}
                            </td>
                        </tr>
                    @endif
                    @if(isset($cards[0]->register) && $cards[0]->register != null)
                        <tr>
                            <th>Регистрация</th>
                            <td>
                                {{$cards[0]->register}}
                            </td>
                        </tr>
                    @endif
                    @if(isset($cards[0]->experience) && $cards[0]->experience != null)
                        <tr>
                            <th>Стаж</th>
                            <td>
                                {{$cards[0]->experience}}
                            </td>
                        </tr>
                    @endif
                </table>
            @endif
        @if(isset($cards[0]))
            <a data-id="{{$cards[0]->id}}" class="form-btn1"
               @if($cards[0]->link_type==1) href="{{$cards[0]->link_1}}" @else href="{{$cards[0]->link_2}}"
               @endif target="_blank"> Оформить</a>
    @endif    <!-- end col-md-6 -->
    </div><!-- end row -->
</div>
<style>
    .silver-company-block {
        border: 2px solid #a2c737;
        box-shadow: 0 0 21px 0 rgba(0,0,0,.2);
        margin-top: 15px;
    }
    .company-face-table th {
        border: 1px solid #ccc;
    }
    .bor .tt {
        font-weight: bold;
    }
    .silver-company-block .lvc {
        padding-left: 5px;
    }
    .line-scale-title {
        width: 100%;
        display: inline-block;
    }
    .line-scale-print {
        width: 85%;
        background: #eaeaea;
        border-radius: 0.25rem;
        display: inline-block;
        position: relative;
        height: 10px;
    }
    .line-scale-value {
        display: inline-block;
        padding-left: 10px;
        width: 9%;
    }
    .progress-bar {
        display: block;
        height: inherit;
        border-radius: 4px;
    }
    .lsv-1{
        width: 10%;
    }
    .lsv-2{
        width: 20%;
    }
    .lsv-3{
        width: 30%;
    }
    .lsv-4{
        width: 40%;
    }
    .lsv-5{
        width: 50%;
    }
    .lsv-6{
        width: 60%;
    }
    .lsv-7{
        width: 70%;
    }
    .lsv-8{
        width: 80%;
    }
    .lsv-9{
        width: 90%;
    }
    .lsv-10{
        width: 100%;
    }
</style>