<div class="silver-company-block">
    <p class="pupdate">
        <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}}</span>
    </p>
    @if(isset($cards[0]))
        <img loading="lazy" src="{{$cards[0]->logo}}" alt="{{$cards[0]->title}}" class="logo-company">
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
        <div class="scb-group">
            <span class="scb-label"><i class="fa fa-money"></i> Виды залога</span>
            @if(isset($cards[0]))
                <div class="scb-value">
                    @if(isset($cards[0]->zalog_type))@if($cards[0]->zalog_type != null){{$cards[0]->zalog_type}}@endif @endif
                </div>
            @endif
            <span class="scb-label"><i class="fa fa-calendar"></i> Срок</span>
            @if(isset($cards[0]))
                <div class="scb-value">
                    от {{$cards[0]->term_min}} @if(isset($cards[0]->term_max)) @if($cards[0]->sum_max != null)
                        до {{$cards[0]->term_max}} дней @endif @endif</div>
            @endif
            <span class="scb-label"><i class="fa fa-percent"></i> Процентная ставка</span>
            @if(isset($cards[0]))
                <div class="scb-value"> @if(isset($cards[0]->percent_min)) @if($cards[0]->percent_min != null)
                        от {{$cards[0]->percent_min}}@endif @endif @if(isset($cards[0]->percent_max)) @if($cards[0]->percent_max != null)
                        до {{$cards[0]->percent_max}} процентов @endif @endif</div>
            @endif
        </div>
    @endif

    @if(isset($cards[0]))
    <div class="scales">
        @if($cards[0]->scale_1 != null)
            <div class="line-scale">
                Условия займов ({{$cards[0]->scale_1}}/10)
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
                Надежность компании ({{$cards[0]->scale_4}}/10)
                <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_4}}"></span>
            </span>
            </div>
        @endif
        @if($cards[0]->scale_5 != null)
            <div class="line-scale">
                Доступность для заемщиков ({{$cards[0]->scale_5}}/10)
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
                <th>Открытие</th>
                <td>
                    @if(isset($cards[0]->opened))@if($cards[0]->opened != null)
                        {{$cards[0]->opened}}
                    @endif @endif
                </td>
            </tr>
            <tr>
                <th>Обслуживание</th>
                <td>
                    @if(isset($cards[0]->maintenance))@if($cards[0]->maintenance != null)
                        {{$cards[0]->maintenance}}
                    @endif @endif
                </td>
            </tr>
            <tr>
                <th>Интернет банк</th>
                <td>
                    @if(isset($cards[0]->internet_bank))@if($cards[0]->internet_bank != null)
                        {{$cards[0]->internet_bank}}
                    @endif @endif
                </td>
            </tr>
            <tr>
                <th>Мобильный банк</th>
                <td>
                    @if(isset($cards[0]->mobile_bank))@if($cards[0]->mobile_bank != null)
                        {{$cards[0]->mobile_bank}}
                    @endif @endif
                </td>
            </tr>
            <tr>
                <th>СМС-информирование</th>
                <td>
                    @if(isset($cards[0]->sms_info))@if($cards[0]->sms_info != null)
                        {{$cards[0]->sms_info}}
                    @endif @endif
                </td>
            </tr>
        </table>

    @endif

    @if(isset($cards[0]))
        <a data-id="{{$cards[0]->id}}" class="form-btn1"
           @if($cards[0]->link_type==1) href="{{$cards[0]->link_1}}" @else href="{{$cards[0]->link_2}}"
           @endif target="_blank"><i class="fa fa-lock"></i> Оформить</a>
        <button id="load_card_for_company" class="form-btn1">Подробнее</button>
    @endif
</div>