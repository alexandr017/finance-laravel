<div class="silver-company-block">
    <p class="pupdate">
        <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}}</span>
    </p>
    @if(isset($cards[0]))
        <img loading="lazy" src="{{$cards[0]->logo}}" alt="{{$cards[0]->title}}" class="logo-company">
        <div class="k5m-wrap">К5М = {{$cards[0]->km5}}/10 <img loading="lazy" src="/old_theme/img/icon-help2.png" alt="Рейтинг К5М" class="def_load icon-help k5m_button">
        </div>
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
        {!! App\Algorithms\System::rating($ratingValue) !!}
        <div class="text-rating">
            <a rel="nofollow" href="<?= str_replace('https://'.$_SERVER['SERVER_NAME'], '', URL::current()) ?>/reviews"><span itemprop="ratingCount">{{count($reviews)}}</span> {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}</a>
        </div>
        <div class="val-rating">(<span>{{$ratingValue}}</span> из <span>5</span>)</div>
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
                        <img class="sprite vzo_icons def_bg" src="/images/ic/icon-{{$current_item_icon}}.png" alt="{{$all_vzo_icons[$current_item_icon]['title']}}" data-title="{{$all_vzo_icons[$current_item_icon]['title']}}">
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
                        до {{number_format($cards[0]->sum_max, 0, '.', ' ')}} ₽ @endif @endif</div>
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
    @endif
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
    @if(isset($cards[0]))
        <table class="company-face-table">
            <tr>
                <th>Сумма</th>
                <td>
                    @if(isset($cards[0]->sum_min)) @if($cards[0]->sum_min != null)
                        от {{number_format($cards[0]->sum_min, 0, '.', ' ')}} @if(isset($cards[0]->sum_max)) @if($cards[0]->sum_max != null) до {{number_format($cards[0]->sum_max, 0, '.', ' ')}} ₽ @endif @endif
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
           @endif target="_blank"> Оформить</a>
        <button id="load_card_for_bank"
                class="form-btn1">Все вклады банка</button>
    @endif
</div>
<style>
    .scales .line-scale-print {
        width: 90%;
    }
    .scales .line-scale-value {
        width: 8%;
        float: right;
    }
</style>