<div class="silver-company-block">
    <p class="pupdate">
        <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}}</span>
    </p>
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

    <div class="rating-line micro">
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

    <p>{!! str_replace(['<p>','</p>'], '', Shortcode::compile(System::nofollow($page->lead))) !!}</p>

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



    <?php /*
    <div class="scales">
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
    */ ?>
    @if(isset($cards[0]))
    <table class="company-face-table">
        <?php
        if ($cards[0]->sum_min != null) {
            $firstCardDetails['Минимальная сумма вклада'] = number_format($cards[0]->sum_min, 0, '.', ' ') . ' ₽';
        }
        if ($cards[0]->sum_max != null) {
            $firstCardDetails['Минимальный срок вклада'] = number_format($cards[0]->sum_max, 0, '.', ' ') . ' ₽';
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
    <a data-id="{{$cards[0]->id}}" class="form-btn1"
       @if($cards[0]->link_type==1) href="{{$cards[0]->link_1}}" @else href="{{$cards[0]->link_2}}"
        @endif target="_blank"> Оформить</a>

    <button id="load_card_for_bank" class="form-btn1">Все продукты банка ({{count($cards)}} шт.)</button>
    @endif
</div>