<div id="card-{{$card->id}}"
     class="one-offer @if($card->promo == 1) spec-offer @endif @if($card->label != 0)label label{{$card->label}} @endif">
    @if(@$card->promo == 1)
        <div class="title-top"><i class="fa fa-star-o"></i> Специальное предложение</div>
    @endif
    <div class="d-flex beta-card">
        <div class="beta-card-logo-review-block">
            <?php
            $showEntityLink =
                $card->link_to_entity != null &&
                str_replace('https://finance.ru', '', $card->link_to_entity) != '/' . \Request::path() &&
                !isset($hideEntityLink);
            ?>
{{--            <a href="{{$card->link_to_entity}}" target="_blank" class="beta-card-name">{{$card->title}}</a>--}}
            @if($showEntityLink)
                <a href="{{$card->link_to_entity}}" target="_blank"><img loading="lazy" src="{{$card->logo}}" alt="{{$card->title}}"></a>
            @else
                <img loading="lazy" src="{{$card->logo}}" alt="{{$card->title}}">
            @endif
            <div class="beta-card-review-name-block">
{{--            <div class="display_none beta-card-name-block-mb">--}}
                <a href="{{$card->link_to_entity}}" target="_blank" class="beta-card-name">{{$card->title}}
{{--                    <span class="verified-icon vzo_icons def_bg" data-src="/old_theme/img/icon-veryfied.png" data-title="Официальный представитель на сайте"></span>--}}
                </a>
{{--            </div>--}}
            @if(isset($card->ratingValue))
                <div class="rating-line">
                    <?php $showEntityReviewsLink = $card->link_to_reviews_page != null && str_replace('https://finance.ru', '', $card->link_to_reviews_page) != '/' . $card->link_to_reviews_page; ?>
                    @if ($showEntityReviewsLink)
                        {!! App\Algorithms\System::rating($card->ratingValue) !!}
                        <div class="text-rating">
                            <a target="_blank"
                               href="{{$card->link_to_reviews_page}}">{{$card->ratingCount}} {{System::endWords($card->ratingCount, ['отзыв', 'отзыва', 'отзывов'])}}</a>
                            ({{$card->ratingValue}} из 5)
                        </div>
                    @endif
                </div>
            @endif
            </div>
            <div class="refresh-item">
                <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                <span>Обновлено</span><br><span>{{fake_update_offer(strtotime($card->created_at))}}</span>
            </div>
{{--            @if($card->category_id != 3)--}}
{{--                <button data-id="{{$card->id}}" class="compare add_to_compare">+ к сравнению<i class="fa fa-balance-scale"></i></button>--}}
{{--            @endif--}}
        </div>
        <div class="beta-card-main-details">
            <div>
                @if(isset($card->km5))
                    <p class="beta-card-label beta-card-open-km-rating">
                        <img src="/old_theme/img/popup1.png" alt="" class="beta-card-km-img">К5М
                    </p>
                    <b> {{@str_replace('.0','',$card->km5)}} </b>
                @endif
            </div>
            <div>
                @if(isset($card->sum_max) && $card->sum_max != null)
                    <p class="beta-card-label">Сумма</p>
                    {{--                @if(isset($card->sum_min)) @if($card->sum_min !== null)--}}
                    {{--                    <b>от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max)) @if($card->sum_max != null)--}}
                    {{--                        до {{number_format($card->sum_max, 0, '.', ' ')}} ₽</b>@endif @endif--}}
                    {{--                @endif @endif--}}
                    <b>до {{number_format($card->sum_max, 0, '.', ' ')}} ₽</b>
                @endif
            </div>
            <div>
                @if(isset($card->percent)) @if($card->percent !== null)
                <p class="beta-card-label">Ставка</p>
                   <b> {{$card->percent}}% </b>
                @endif @endif
            </div>
            <div>
                <p class="beta-card-label">Срок</p>
{{--                @if(isset($card->term_min)) @if($card->term_min !== null)--}}
{{--                    <b> от {{$card->term_min}} @if(isset($card->term_max)) @if($card->sum_max != null)--}}
{{--                            до {{$card->term_max}}  @endif @endif дней</b>--}}
{{--                @endif @endif--}}
                @if(isset($card->term_max)) @if($card->sum_max != null)
                    <b>до {{$card->term_max}} дней</b>
                @endif @endif
            </div>
        </div>
        <?php
        $link = ($card->link_type == 1) ? $card->link_1 : $card->link_2;
        ?>
        <div class="beta-card-license">
            <a data-id="{{$card->id}}" href="{{$link}}" target="_blank" class="hdl form-btn1 no-print {{$card->yandex_event}}">Подать заявку</a>
            @if(isset($card->license))
                @if($card->license != null)
                <span class="beta-card-label">{{$card->license}}</span>
                @endif
            @endif
        </div>
    </div>
    <span class="beta-card-more-details">Подробные условия <i class="fa fa-chevron-up" aria-hidden="true"></i></span>
    <div class="beta-card-details-block display_none">
        <ul class="nav">
            <li class="active"><a href="#beta-card-conditions">Условия и ставки</a></li>
            <li><a href="#beta-card-docs">Требования и документы</a></li>
        </ul>
        <div class="beta-card-tab-content">
            <div id="beta-card-conditions" class="active">
                @if(isset($card->sum_min)) @if($card->sum_min !== null)
                    <div class="beta-card-gray-row beta-card-row">
                        <span class="beta-card-details">Сумма займа</span>
                        <b> от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max)) @if($card->sum_max != null)
                            до {{number_format($card->sum_max, 0, '.', ' ')}} ₽ @endif @endif </b>
                    </div>
                @endif @endif
                @if(isset($card->percent)) @if($card->percent !== null)
                    <div class="beta-card-row">
                        <span class="beta-card-details">Ставка в день</span>
                        <b> {{$card->percent}}% </b>
                    </div>
                @endif @endif
                @if(isset($card->term_min)) @if($card->term_min !== null)
                    <div class="beta-card-gray-row beta-card-row">
                        <span class="beta-card-details">Срок</span>
                        <b> от {{$card->term_min}} @if(isset($card->term_max)) @if($card->sum_max != null)
                                до {{$card->term_max}}  @endif @endif дней </b>
                    </div>
                @endif @endif
                <div class="beta-card-row">
                    <span class="beta-card-details">Переплата от</span>
                    <b>
                    <?php
                    $m_min = (isset($card->sum_min)) ? $card->sum_min : 0;
                    $m_term_min = (isset($card->term_min)) ? $card->term_min : 0;
                    $m_percent = (isset($card->percent)) ? $card->percent : 0;
                    $res = $m_min * ($m_percent / 100) * $m_term_min;
                    echo number_format($res, 0, '.', ' ') . ' ₽';
                    ?>
                    </b>
                </div>
                @if(isset($card->pay_method)) @if($card->pay_method !== null)
                    <div class="beta-card-gray-row beta-card-row">
                        <span class="beta-card-details">Способ выплаты</span>
                        <b>
                        <?php
                            echo '<div class="beta-card-row-value">' . $card->pay_method . '</div>';
                        ?>
                        </b>
                    </div>
                @endif @endif
                @if(isset($card->payment_method)) @if($card->payment_method !== null)
                    <div class="beta-card-row">
                        <span class="beta-card-details">Способ погашения</span>
                        <b>
                        <?php
                            echo '<div class="beta-card-row-value">' . $card->payment_method . '</div>';
                        ?>
                        </b>
                    </div>
                @endif @endif
            </div>
            <div id="beta-card-docs" class="beta-card-tab-pane">
                @if(isset($card->age_min)) @if($card->age_min !== null)
                    <div class="beta-card-gray-row beta-card-row">
                        <span class="beta-card-details">Возраст</span>
                        <b>от {{$card->age_min}} @if(isset($card->age_max)) @if($card->age_max != null)
                            до {{$card->age_max}} лет @endif  @else @if($card->age_min == 21) года @else
                                лет @endif  @endif</b>
                    </div>
                @endif @endif
                @if(isset($card->docs)) @if($card->docs !== null)
                    <div class="beta-card-row">
                        <span class="beta-card-details">Документы</span>
                        <b>{{$card->docs}}</b>
                    </div>
                @endif @endif
                @if(isset($card->identification)) @if($card->identification !== null)
                    <div class="beta-card-gray-row beta-card-row">
                        <span class="beta-card-details">Идентификация</span>
                        <b> {{$card->identification}} </b>
                    </div>
                @endif @endif
                @if(isset($card->review_speed)) @if($card->review_speed !== null)
                    <div class="beta-card-row">
                        <span class="beta-card-details">Скорость рассмотрения заявки</span>
                        <b>{{$card->review_speed}}</b>
                    </div>
                @endif @endif
                @if(isset($card->payout_speed)) @if($card->payout_speed !== null)
                    <div class="beta-card-gray-row beta-card-row">
                        <span class="beta-card-details">Скорость выплаты</span>
                        <b>{{$card->payout_speed}}</b>
                    </div>
                @endif @endif
                @if(isset($card->investors)) @if($card->investors !== null)
                    <div class="beta-card-row">
                        <span class="beta-card-details">Инвесторам</span>
                        <b>{{$card->investors}}</b>
                    </div>
                @endif @endif
            </div>
        </div>
        <div class="beta-card-icons-slider display_none">
            <?php
            $all_vzo_icons = \Config::get('icons');
            $current_vzo_icons = explode(',', $card->icons);
            ?>
            @foreach ($current_vzo_icons as $current_item_icon)
                @if (isset($all_vzo_icons[$current_item_icon]))
                    <div><img class="" src="/images/ic/icon-{{$current_item_icon}}.png" alt="{{$all_vzo_icons[$current_item_icon]['name']}}"><br><span>{{$all_vzo_icons[$current_item_icon]['name']}}</span></div>
                @endif
            @endforeach
        </div>
        <span class="cart_more no-print">О компании <i class="fa fa-angle-down"></i></span>
        <div class="panel-cart">
            <hr class="accordion-hr">
            @if(isset($card->text)) @if($card->text!=null)<div class="accordion-p">{!!$card->text!!}</div>@endif @endif
            @if(isset($card->downloads))
                <?php $downloadsArr = json_decode($card->downloads);?>
                @if($downloadsArr != null)
                    <ul class="docs-list no-print">
                        @foreach($downloadsArr as $d_key => $downloadItem)
                            <li><i class="fa fa-download"></i> <a href="{{$downloadItem->href}}" target="_blank">{{$downloadItem->label}}</a></li>
                        @endforeach
                    </ul>
                @endif @endif
        </div>
        <div class="cl-list d-flex space-around no-print">
            <span class="cl-list-bnt print_card"><i class="fa fa-print"></i> Распечатать</span>
            <span data-id="{{$card->id}}" class="cl-list-bnt favorite add_to_favorite"><i class="fa fa-star"></i> <span class="fav">В избранное</span></span>
            @if(isset($card->support_link)) @if($card->support_link!=null)<a href="{{$card->support_link}}" target="_blank"><i class="fa fa-phone"></i> Служба поддержки</a>@endif @endif
            @if(isset($card->account_link)) @if($card->account_link!=null)<a href="{{$card->account_link}}" target="_blank"><i class="fa fa-user"></i> Личный кабинет</a>@endif @endif
            @if(isset($card->promocodes)) @if($card->promocodes!=null)<a href="{{$card->promocodes}}" target="_blank"><i class="fa fa-tags"></i> Промокоды</a>@endif @endif
        </div>
    </div>
</div><?php /* end carts */ ?>