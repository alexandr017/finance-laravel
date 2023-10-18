<div id="card-{{$card->id}}" class="one-offer">
    <div class="d-flex card-mn card-mn-simple">
        <div class="card-mn-main-details">
            <div class="simple-card-mn-logo-name">
                <p class="card-mn-label card-mn-name">{{$card->title}}</p>
                <?php $showEntityLink = $card->link_to_entity != null && str_replace('https://finance.ru', '', $card->link_to_entity) != '/' . \Request::path() && !isset($hideEntityLink); ?>
                <div class="card-mn-review-name-block">
                    @if($showEntityLink)
                        @if(Request::path() == 'loans' || (isset($loans) && $loans == true))
                            <?php $link = ($card->link_type == 1) ? $card->link_1 : $card->link_2; ?>
                            <a href="{{$link}}" target="_blank"><img loading="lazy" src="{{$card->logo}}" alt="{{$card->title}}"></a>
                        @else
                            <a href="{{$card->link_to_entity}}" target="_blank"><img loading="lazy" src="{{$card->logo}}" alt="{{$card->title}}"></a>
                        @endif
                    @else
                        <img loading="lazy" src="{{$card->logo}}" alt="{{$card->title}}">
                    @endif
                </div>
            </div>
            <div>
                <p class="card-mn-label">Макс. сумма займа</p>
                @if(isset($card->sum_max) && $card->sum_max != null)
                    <b class="simple-card-mn-sum"><span class="sorting-field-3">{{number_format($card->sum_max, 0, '.', ' ')}}</span> руб</b>
                @endif
            </div>
            <div>
                <p class="card-mn-label">Ставка в день</p>
                @if(isset($card->percent)) @if($card->percent !== null)
                    <b> {{$card->percent}}% </b>
                @endif @endif
            </div>
            <div>
                <p class="card-mn-label">Возраст</p>
                <b class="simple-card-mn-age">
                    @if(isset($card->age_min)) @if($card->age_min != null)
                        от {{$card->age_min}}
                    @endif @endif
                    @if(isset($card->age_max)) @if($card->age_max != null)
                        до {{$card->age_max}}
                    @endif @endif
                    лет
                </b>
            </div>
            <div>
                <p class="card-mn-label">Оценка</p>
                @if(isset($card->ratingValue) && $card->ratingValue != null)
                    <b class="sorting-field-1">{{$card->ratingValue}}</b>
                @endif
            </div>
            <div>
                <p class="card-mn-label">Отзывов</p>
                @if(isset($card->ratingCount) && $card->ratingCount != null)
                    <b class="sorting-field-2">{{$card->ratingCount}}</b>
                @endif
            </div>
            <div>
                <p class="card-mn-label">Процент одобрений</p>
                @if(isset($card->approval_indicator) && $card->approval_indicator != null)
                    <b>{{$card->approval_indicator}}%</b>
                @endif
            </div>
        </div>
        <?php
        $link = ($card->link_type == 1) ? $card->link_1 : $card->link_2;
        $tmpLink = \DB::table('hide_links')->where(['in' => preg_replace('/^\//','',str_replace('https://finance.ru','', $link))])->first();
        if ($tmpLink != null) {
            $link = $tmpLink->out;
        }
        ?>

        <div class="card-mn-license">
            <a data-id="{{$card->id}}" href="{{$link}}" target="_blank" class="hdl form-btn1 no-print {{$card->yandex_event}}">Подать заявку</a>
        </div>
    </div>
</div><?php /* end carts */ ?>
