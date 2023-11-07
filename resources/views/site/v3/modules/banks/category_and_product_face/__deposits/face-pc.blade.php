<div class="silver-company-block">
    <div class="row">
        <div class="col-sm-3 v-flex">
            <div class="left b-wrap">
                @if(isset($cards[0]))
                    <img loading="lazy" src="{{$cards[0]->logo}}" alt="{{$cards[0]->title}}" class="logo-company">
                    <div class="k5m-wrap">К5М = {{$cards[0]->km5}}/10 <img loading="lazy" src="/old_theme/img/icon-help2.png" alt="Рейтинг К5М" class="lazy icon-help k5m_button"></div>
                @endif
            </div>
        </div>
        <div class="col-sm-9">

            <div class="rating-line">
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
                {!! App\Models\System::rating($ratingValue) !!}
                <div class="text-rating">
                    <a rel="nofollow" href="<?= str_replace('https://'.$_SERVER['SERVER_NAME'], '', URL::current()) ?>/reviews"><span itemprop="ratingCount">{{count($reviews)}}</span> {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}</a>
                </div>
                <div class="val-rating">({{$ratingValue}} из 5)</div>


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
            <div class="row row-margin-block-1">
                <div class="col-sm-4">
                    <span class="scb-label"><i class="fa fa-money"></i> Сумма</span>
                    @if(isset($cards[0]))
                        <div class="scb-value">от {{number_format($cards[0]->sum_min, 0, '.', ' ')}} @if(isset($cards[0]->sum_max)) @if($cards[0]->sum_max != null) до {{number_format($cards[0]->sum_max, 0, '.', ' ')}} руб. @endif @endif</div>
                    @endif
                </div>
                <div class="col-sm-4">
                    <span class="scb-label"><i class="fa fa-calendar"></i> Срок</span>
                    @if(isset($cards[0]))
                        <div class="scb-value">от {{$cards[0]->term_min}} @if(isset($cards[0]->term_max)) @if($cards[0]->sum_max != null) до {{$cards[0]->term_max}} дней @endif @endif</div>
                    @endif
                </div>
                <div class="col-sm-4">
                    <span class="scb-label"><i class="fa fa-percent"></i> Процентная ставка</span>
                    @if(isset($cards[0]))
                        <div class="scb-value">от {{$cards[0]->percent_min}} @if(isset($cards[0]->percent_max)) @if($cards[0]->sum_max != null) до {{$cards[0]->percent_max}} % @endif @endif</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if($scales != '')
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
                        <span class="progress progress-bar bg-success progress-bar-striped lsv-{{ceil($scale['sum']/$scale['count'])}}"></span>
                    </span>
                        <span class="line-scale-value">{{ceil($scale['sum']/$scale['count'])}}/10</span>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    @endif
    @if(isset($cards[0]))
        <table class="company-face-table">
            <tr>
                <th>Сумма</th>
                <td>
                    @if(isset($cards[0]->sum_min)) @if($cards[0]->sum_min != null)
                        от {{number_format($cards[0]->sum_min, 0, '.', ' ')}} @if(isset($cards[0]->sum_max)) @if($cards[0]->sum_max != null) до {{number_format($cards[0]->sum_max, 0, '.', ' ')}} руб. @endif @endif
                    @endif @endif
                </td>
                <th>Срок</th>
                <td>
                    @if(isset($cards[0]->term_min))@if($cards[0]->term_min != null)
                        от {{$cards[0]->term_min}} @if(isset($cards[0]->term_max))@if($cards[0]->term_max != null) до {{$cards[0]->term_max}} дней@endif @endif
                    @endif @endif
                </td>
            </tr>
            <tr>
                <th>Процентная ставка</th>
                <td>
                    @if(isset($cards[0]->percent_min))@if($cards[0]->percent_min != null)
                        от {{$cards[0]->percent_min}} @if(isset($cards[0]->percent_max)) @if($cards[0]->percent_max != null)до {{$cards[0]->percent_max}} @endif @endif %
                    @endif @endif
                </td>
                <th>Возраст</th>
                <td>
                    @if(isset($cards[0]->age_min)) @if($cards[0]->age_min != null)
                        от {{$cards[0]->age_min}} @if(isset($cards[0]->age_max)) @if($cards[0]->sum_max != null) до {{$cards[0]->age_max}} @endif @endif лет
                    @endif @endif
                </td>
            </tr>
            <tr>
                <th>Документы</th>
                <td>
                    @if(isset($cards[0]->docs)) @if($cards[0]->docs != null)
                        {{$cards[0]->docs}}
                    @endif @endif
                </td>
                <th>Скорость рассмотрения заявки</th>
                <td>
                    @if(isset($cards[0]->speed_see)) @if($cards[0]->speed_see != null)
                        {{$cards[0]->speed_see}}
                    @endif @endif
                </td>
            </tr>
            <tr>
                <th>Регистрация</th>
                <td>
                    @if(isset($cards[0]->register)) @if($cards[0]->register != null)
                        {{$cards[0]->register}}
                    @endif @endif
                </td>
                <th>Стаж</th>
                <td>
                    @if(isset($cards[0]->experience)) @if($cards[0]->experience != null)
                        {{$cards[0]->experience}}
                    @endif @endif
                </td>
            </tr>
        </table>
    @endif

    <div class="row">
        @if(isset($cards[0]))
            <div class="col-sm-6">
                <a data-id="{{$cards[0]->id}}" class="form-btn1" @if($cards[0]->link_type==1) href="{{$cards[0]->link_1}}" @else href="{{$cards[0]->link_2}}" @endif target="_blank"> Оформить</a>
            </div>
            <div class="col-sm-6">
                <button id="load_card_for_bank" class="form-btn1">Все вклады банка</button>
            </div>
        @endif
    </div>

</div>
