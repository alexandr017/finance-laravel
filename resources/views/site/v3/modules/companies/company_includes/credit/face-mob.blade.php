<div class="silver-company-block">
    <p class="pupdate">
        <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}}</span>
    </p>
    @if(isset($cards[0]))
        <img loading="lazy" src="{{$cards[0]->logo}}" alt="{{$cards[0]->title}}" class="logo-company">
        </div>
    @endif

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

    {!! Shortcode::compile(System::nofollow($company->text_before)) !!}

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

    @if(isset($cards[0]))
        <div class="scb-group">
            <span class="scb-label"><i class="fa fa-money"></i> Сумма</span>
            @if(isset($cards[0]))
                <div class="scb-value">
                    от {{number_format($cards[0]->sum_min, 0, '.', ' ')}} @if(isset($cards[0]->sum_max)) @if($cards[0]->sum_max != null)
                        до {{number_format($cards[0]->sum_max, 0, '.', ' ')}} руб. @endif @endif</div>
            @endif
            <span class="scb-label"><i class="fa fa-calendar"></i> Срок</span>
            @if(isset($cards[0]))
                <div class="scb-value">
                    от {{$cards[0]->term_min}} @if(isset($cards[0]->term_max)) @if($cards[0]->sum_max != null)
                        до {{$cards[0]->term_max}} дней @endif @endif</div>
            @endif
            <span class="scb-label"><i class="fa fa-percent"></i> Процентная ставка</span>
            @if(isset($cards[0]))
                <div class="scb-value">
                    от {{$cards[0]->percent_min}} @if(isset($cards[0]->percent_max)) @if($cards[0]->sum_max != null)
                        до {{$cards[0]->percent_max}} % @endif @endif</div>
            @endif
        </div>


    <div class="scales">
        @if($cards[0]->scale_1 != null)
            <div class="line-scale">
                Условия кредитования ({{$cards[0]->scale_1}}/10)
                <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_1}}"></span>
            </span>
            </div>
        @endif
        @if($cards[0]->scale_2 != null)
            <div class="line-scale">
                Удобство для заемщика ({{$cards[0]->scale_2}}/10)
                <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_2}}"></span>
            </span>
            </div>
        @endif
        @if($cards[0]->scale_3 != null)
            <div class="line-scale">
                Оформление и погашение ({{$cards[0]->scale_3}}/10)
                <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_3}}"></span>
            </span>
            </div>
        @endif
        @if($cards[0]->scale_4 != null)
            <div class="line-scale">
                Надежность банка ({{$cards[0]->scale_4}}/10)
                <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_4}}"></span>
            </span>
            </div>
        @endif
        @if($cards[0]->scale_5 != null)
            <div class="line-scale">
                Доступность для заемщика ({{$cards[0]->scale_5}}/10)
                <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_5}}"></span>
            </span>
            </div>
        @endif
    </div>
    @endif

    {!! $company->company_advantages !!}

    @if(isset($cards[0]))
        <table class="company-face-table">
            <tr>
                <th>Сумма</th>
                <td>
                    @if(isset($cards[0]->sum_min)) @if($cards[0]->sum_min != null)
                        от {{number_format($cards[0]->sum_min, 0, '.', ' ')}} @if(isset($cards[0]->sum_max)) @if($cards[0]->sum_max != null) до {{number_format($cards[0]->sum_max, 0, '.', ' ')}} руб. @endif @endif
                    @endif @endif
                </td>
            </tr>
            <tr>
                <th>Срок</th>
                <td>
                    @if(isset($cards[0]->term_min))@if($cards[0]->term_min != null)
                        от {{$cards[0]->term_min}} @if(isset($cards[0]->term_max))@if($cards[0]->term_max != null) до {{$cards[0]->term_max}} дней@endif @endif
                    @endif @endif
                </td>
            </tr>
            </tr>
            <tr>
                <th>Процентная ставка</th>
                <td>
                    @if(isset($cards[0]->percent_min))@if($cards[0]->percent_min != null)
                        от {{$cards[0]->percent_min}} @if(isset($cards[0]->percent_max)) @if($cards[0]->percent_max != null)до {{$cards[0]->percent_max}} @endif @endif %
                    @endif @endif
                </td>
            </tr>
            <tr>
                <th>Возраст</th>
                <td>
                    @if(isset($cards[0]->age_min)) @if($cards[0]->sum_min != null)
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
            </tr>
            <tr>
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
            </tr>
            <tr>
                <th>Стаж</th>
                <td>
                    @if(isset($cards[0]->experience)) @if($cards[0]->experience != null)
                        {{$cards[0]->experience}}
                    @endif @endif
                </td>
            </tr>
        </table>
    @endif

    @if(isset($cards[0]))
        <a data-id="{{$cards[0]->id}}" class="form-btn1"
           @if($cards[0]->link_type==1) href="{{$cards[0]->link_1}}" @else href="{{$cards[0]->link_2}}"
           @endif target="_blank"><i class="fa fa-lock"></i> Оформить</a>
        <button id="load_card_for_company" class="form-btn1">Все кредиты банка</button>
    @endif
</div>