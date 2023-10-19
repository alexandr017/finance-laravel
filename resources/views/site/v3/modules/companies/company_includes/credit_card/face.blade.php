<div class="silver-company-block">
    <div class="row">
        <div class="col-sm-3 v-flex">
            <div class="left b-wrap">
                @if(isset($cards[0]))
                <img loading="lazy" src="{{$cards[0]->logo}}" alt="{{$cards[0]->title}}" class="logo-company">
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
            <div class="row row-margin-block-1">
                <div class="col-sm-4">
                    <span class="scb-label"><i class="fa fa-money"></i> Максимальный лимит</span>
                    @if(isset($cards[0]))
                    <div class="scb-value">@if(isset($cards[0]->limit_max)) @if($cards[0]->limit_max != null) {{$cards[0]->limit_max}} @endif @endif рублей</div>
                    @endif
                </div>
                <div class="col-sm-4">
                    <span class="scb-label"><i class="fa fa-percent"></i> Процентная ставка в год</span>
                    @if(isset($cards[0]))
                    <div class="scb-value">@if(isset($cards[0]->percent_min)) @if($cards[0]->percent_min != null)от {{$cards[0]->percent_min}}@endif @endif @if(isset($cards[0]->percent_max)) @if($cards[0]->percent_max != null) до {{$cards[0]->percent_max}} @endif @endif %</div>
                    @endif
                </div>
                <div class="col-sm-4">
                    <span class="scb-label"><i class="fa fa-calendar"></i> Беспроцентный период</span>
                    @if(isset($cards[0]))
                    <div class="scb-value">@if(isset($cards[0]->none_percent_period)) @if($cards[0]->none_percent_period != null) {{$cards[0]->none_percent_period}} @endif @endif дней</div>
                    @endif
                </div>
            </div>


        </div>
    </div>
    <div class="row row-margin-block-2">
        <div class="@if($company->company_advantages!= null) col-sm-4 @else col-sm-1 @endif">
            {!! $company->company_advantages !!}
        </div>
        @if(isset($cards[0]))
        <div class="line-scale-wrap @if($company->company_advantages!= null) col-sm-8 @else col-sm-11 @endif">
            @if($cards[0]->scale_1 != null)
            <div class="line-scale">
                <span class="line-scale-title">Условия кредитования</span>
                <span class="line-scale-print">
                    <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_1}}"></span>
                </span>
                <span class="line-scale-value">{{$cards[0]->scale_1}}/10</span>
            </div>
            @endif
            @if($cards[0]->scale_2 != null)
            <div class="line-scale">
                <span class="line-scale-title">Пополнение и снятие</span>
                <span class="line-scale-print">
                    <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_2}}"></span>
                </span>
                <span class="line-scale-value">{{$cards[0]->scale_2}}/10</span>
            </div>
            @endif
            @if($cards[0]->scale_3 != null)
            <div class="line-scale">
                <span class="line-scale-title">Бонусная программа</span>
                <span class="line-scale-print">
                    <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_3}}"></span>
                </span>
                <span class="line-scale-value">{{$cards[0]->scale_3}}/10</span>
            </div>
            @endif
            @if($cards[0]->scale_4 != null)
            <div class="line-scale">
                <span class="line-scale-title">Дополнительные услуги</span>
                <span class="line-scale-print">
                    <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_4}}"></span>
                </span>
                <span class="line-scale-value">{{$cards[0]->scale_4}}/10</span>
            </div>
            @endif
            @if($cards[0]->scale_5 != null)
            <div class="line-scale">
                <span class="line-scale-title">Надежность банка</span>
                <span class="line-scale-print">
                    <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_5}}"></span>
                </span>
                <span class="line-scale-value">{{$cards[0]->scale_5}}/10</span>
            </div>
            @endif
        </div>
        @endif
    </div>
    @if(isset($cards[0]))
        <table class="company-face-table">
            <tr>
                <th>Процентная ставка в год</th>
                <td>
                    @if(isset($cards[0]->percent_min)) @if($cards[0]->percent_min != null)
                        от {{$cards[0]->percent_min}} @if(isset($cards[0]->percent_max)) @if($cards[0]->percent_max != null) до {{$cards[0]->percent_max}} @endif @endif %
                    @endif @endif
                </td>
                <th>Максимальный лимит</th>
                <td>
                    @if(isset($cards[0]->limit_max))@if($cards[0]->limit_max != null)
                        {{$cards[0]->limit_max}} руб.
                    @endif @endif
                </td>
            </tr>
            <tr>
            <th>Беспроцентный период</th>
                <td>
                    @if(isset($cards[0]->none_percent_period))@if($cards[0]->none_percent_period != null)
                        {{$cards[0]->none_percent_period}} дней
                    @endif @endif
                </td>
                <th>Открытие</th>
                <td>
                    @if(isset($cards[0]->opened))@if($cards[0]->opened != null)
                        {{$cards[0]->opened}} руб.
                    @endif @endif
                </td>
            </tr>
            <tr>
            <th>Обслуживание</th>
                <td>
                    @if(isset($cards[0]->maintenance))@if($cards[0]->maintenance != null)
                        {{$cards[0]->maintenance}} руб.
                    @endif @endif
                </td>
                <th>Возраст</th>
                <td>
                    @if(isset($cards[0]->age_min)) @if($cards[0]->age_min != null)
                        от {{$cards[0]->age_min}} @if(isset($cards[0]->age_max)) @if($cards[0]->age_max != null) до {{$cards[0]->age_max}} @endif @endif лет
                    @endif @endif
                </td>
            </tr>
        </table>
    @endif

    <div class="row">
    @if(isset($cards[0]))
        <div class="col-sm-6">
            <a data-id="{{$cards[0]->id}}" class="form-btn1" @if($cards[0]->link_type==1) href="{{$cards[0]->link_1}}" @else href="{{$cards[0]->link_2}}" @endif target="_blank"><i class="fa fa-lock"></i> Оформить</a>
        </div>
        <div class="col-sm-6">
            <button id="load_card_for_company" class="form-btn1">Все карты банка</button>
        </div>
    @endif
    </div>

</div>
