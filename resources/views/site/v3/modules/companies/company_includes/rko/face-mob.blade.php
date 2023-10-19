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
    <div class="scales">
        @if($cards[0]->scale_1 != null)
            <div class="line-scale">
                Обслуживание счета ({{$cards[0]->scale_1}}/10)
                <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_1}}"></span>
            </span>
            </div>
        @endif
        @if($cards[0]->scale_2 != null)
            <div class="line-scale">
                Денежные операции ({{$cards[0]->scale_2}}/10)
                <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_2}}"></span>
            </span>
            </div>
        @endif
        @if($cards[0]->scale_3 != null)
            <div class="line-scale">
                Дополнительные услуги ({{$cards[0]->scale_3}}/10)
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
                Доступность для клиента ({{$cards[0]->scale_5}}/10)
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
        <button id="load_card_for_company" class="form-btn1">Все тарифы банка</button>
    @endif
</div>