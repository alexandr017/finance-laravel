<div class="silver-company-block">
    <div class="row">
        <div class="col-sm-3 v-flex">
            <div class="left b-wrap">
                @if(isset($cards[0]))
                <img loading="lazy" src="{{$cards[0]->logo}}" alt="{{$cards[0]->title}}" class="logo-company">
                @elseif($company->closed)
                    <span class="closed-company">
                        <img loading="lazy" src="{{$company->img}}" alt="{{$company->h1}}" class="logo-company">
                    </span>
                @endif
            </div>
        </div>
        <div class="col-sm-9">
            <p class="pupdate">
                <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}}</span>
            </p>

            <?php $ratingValue = \App\Algorithms\Frontend\Banks\BankReviews::getRatingByReviews($reviews); ?>
            @if(isset($cards[0]))
            <div class="rating-line micro">
                {!! App\Models\System::rating($ratingValue) !!}
                <div class="text-rating">
                    <a rel="nofollow" href="{{$cards[0]->link_to_reviews_page}}">{{count($reviews)}} {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}</a>
                </div>
                <div class="val-rating">({{$ratingValue}} из 5)</div>
            </div>
            @endif

            <p>{!! str_replace(['<p>','</p>'], '', Shortcode::compile(System::nofollow($company->text_before))) !!}</p>

            @if(isset($cards[0]))
                @if($cards[0]->icons != null)
                <div class="vzo_icons_wrap">
                    <?php
                    $all_vzo_icons = \Config::get('icons');
                    $current_vzo_icons = explode(',', $cards[0]->icons);
                    ?>
                    @foreach ($current_vzo_icons as $current_item_icon)
                    @if (isset($all_vzo_icons[$current_item_icon]))
                            <div class="sprite vzo_icons def_bg" style="background: url(/images/ic/icon-{{$current_item_icon}}.png)" data-title="{{$all_vzo_icons[$current_item_icon]['title']}}"></div>
                    @endif
                    @endforeach
                </div>
                @endif
            @endif

            @if(! $company->closed)
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
                    <span class="scb-label"><i class="fa fa-percent"></i> Ставка в день</span>
                    @if(isset($cards[0]))
                    <div class="scb-value">{{$cards[0]->percent}}%</div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
    @if(!$company->closed && isset($cards[0]))
    <div class="row row-margin-block-2">
        <div class="line-scale-wrap @if($company->company_advantages!= null) col-sm-4 @else col-sm-1 @endif">
            {!! $company->company_advantages !!}
        </div>
        <div class="line-scale-wrap @if($company->company_advantages!= null) col-sm-8 @else col-sm-11 @endif">
            @if($cards[0]->scale_1 != null)
            <div class="line-scale">
                <span class="line-scale-title">Условия займов</span>
                <span class="line-scale-print">
                    <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_1}}"></span>
                </span>
                <span class="line-scale-value">{{$cards[0]->scale_1}}/10</span>
            </div>
            @endif
            @if($cards[0]->scale_2 != null)
            <div class="line-scale">
                <span class="line-scale-title">Удобство для заемщика</span>
                <span class="line-scale-print">
                    <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_2}}"></span>
                </span>
                <span class="line-scale-value">{{$cards[0]->scale_2}}/10</span>
            </div>
            @endif
            @if($cards[0]->scale_3 != null)
            <div class="line-scale">
                <span class="line-scale-title">Оформление и погашение</span>
                <span class="line-scale-print">
                    <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_3}}"></span>
                </span>
                <span class="line-scale-value">{{$cards[0]->scale_3}}/10</span>
            </div>
            @endif
            @if($cards[0]->scale_4 != null)
            <div class="line-scale">
                <span class="line-scale-title">Надежность компании</span>
                <span class="line-scale-print">
                    <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_4}}"></span>
                </span>
                <span class="line-scale-value">{{$cards[0]->scale_4}}/10</span>
            </div>
            @endif
            @if($cards[0]->scale_5 != null)
            <div class="line-scale">
                <span class="line-scale-title">Доступность для заемщиков</span>
                <span class="line-scale-print">
                    <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_5}}"></span>
                </span>
                <span class="line-scale-value">{{$cards[0]->scale_5}}/10</span>
            </div>
            @endif
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
                <th>Документы</th>
                <td>
                    @if(isset($cards[0]->docs)) @if($cards[0]->docs != null)
                        {{$cards[0]->docs}}
                    @endif @endif
                </td>
            </tr>
            <tr>
                <th>Ставка в день</th>
                <td>
                    @if(isset($cards[0]->percent)) @if($cards[0]->percent != null)
                        {{$cards[0]->percent}}%
                    @endif @endif
                </td>
                <th>Плохая КИ</th>
                <td>
                    @if(isset($cards[0]->poor_ch)) @if($cards[0]->poor_ch != null)
                        @if($cards[0]->poor_ch==1) Да @else Нет @endif
                    @endif @endif
                </td>
            </tr>
            <tr>
                <th>Переплата, от</th>
                <td>
                    <?php
                    $m_min = (isset($cards[0]->sum_min)) ? $cards[0]->sum_min : 0;
                    $m_term_min = (isset($cards[0]->term_min)) ? $cards[0]->term_min : 0;
                    $m_percent = (isset($cards[0]->percent)) ? $cards[0]->percent : 0;
                    $res = $m_min * ($m_percent /100) * $m_term_min;
                    echo number_format($res, 0, '.', ' ') . ' руб.';
                    ?>
                </td>
                <th>Продление</th>
                <td>
                    @if(isset($cards[0]->extension)) @if($cards[0]->extension != null)
                        {{$cards[0]->extension}}
                    @endif @endif
                </td>
            </tr>
            <tr>
                <th>Возраст заемщика</th>
                <td>
                    @if(isset($cards[0]->age_min)) @if($cards[0]->age_min != null)
                        от {{$cards[0]->age_min}} @if(isset($cards[0]->age_max)) @if($cards[0]->age_max != null) до {{$cards[0]->age_max}} лет @endif  @else @if($cards[0]->age_min == 21) года @else лет @endif  @endif
                    @endif @endif
                </td>
                <th>Скорость выплаты</th>
                <td>
                    @if(isset($cards[0]->payout_speed)) @if($cards[0]->payout_speed != null)
                        {{$cards[0]->payout_speed}}
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
            <button id="load_card_for_company" class="form-btn1">Все продукты компании</button>
        </div>
    @endif
    </div>

</div>
