<?php /* займи */ ?>
<div class="ltable-wrap">
    <table class="ltable">
        <thead>
        <tr>
            <th>МКК/МФК</th>
            <th class="max-60">Требуемый кредитный рейтинг</th>
            <th class="max-60">Процент одобрений</th>
            <?php /*
    <th class="max-130">Отзывы</th>
    <th class="display_none"></th>
    */ ?>
            <th class="max-60">Средний К5М</th>
            <th class="max-60">Оценка</th>
            <th class="max-60">Отзывов</th>
            <th class="max-130">Максимальная сумма займа</th>
            <th class="display_none"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($cards as $card)
            @if($card->km5 != null)
                <tr>
                    <td>
                        <div class="small-img-wrap">
                           <amp-img width="125" height="60" layout="fixed" src="{!! $card->logo!!}" alt="{!! $card->title!!}"></amp-img>
                        </div>
                        <div>
                            @if($card->km5 != null)
                            <div><a href="{!! $card->link_to_entity!!}">{!! $card->title!!}</a></div>
                            @else
                            <div>{{$card->h1}}</div>
                            @endif
                            <br>
                            <?php if($card->link_type == 1) $link = $card->link_1; else $link = $card->link_2; ?>
                            @if($link != null)
                                <br><a data-id="{!! $card->card_id!!}" href="{!! $link!!}" target="_blank" class="hdl form-btn1 zaim-hub hub-list">  Оформить</a><br>
                            @endif
                        </div>
                    </td>
                    <td class="text-center">{!! $card->informer_scale!!}</td>
                    <td class="text-center">{!! $card->approval_indicator!!}</td>
                    <td class="text-center">{!! $card->km5!!}</td>
                    <td class="text-center">{!! $card->ratingValue!!}</td>
                    <td class="text-center">{!! $card->ratingCount!!}</td>
                    <td class="text-center">@if($card->header_1 !=0){!! number_format($card->header_1, 0, '.', ' ')!!}@endif</td>
                    <td class="display_none">{!! $card->header_1!!}</td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>
