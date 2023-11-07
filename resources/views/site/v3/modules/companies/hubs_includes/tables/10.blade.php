<?php /* Кредиты */ ?>
<div class="ltable-wrap">
    <table class="ltable">
        <thead>
        <tr>
            <th>Банк</th>
            <?php /* <th class="max-130">Отзывы</th>
    <th class="display_none"></th>  */ ?>
            <th class="max-60">Средний К5М</th>
            <th class="max-60">Оценка пользователей</th>
            <th class="max-130">Отзывов</th>
            <th>Максимальная сумма кредита</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cards as $card)
            @if($card->km5 != null)
                <tr>
                    <td>
                        <div class="small-img-wrap">
                            <amp-img width="125" height="60" layout="fixed" src="{{$card->logo}}" alt="{{$card->title}}"></amp-img>
                        </div>
                        @if($card->km5 != null)
                        <div><a href="{!! $card->link_to_entity!!}">{!! $card->title!!}</a></div>
                        @else
                        <div>{{$card->h1}}</div>
                        @endif
                        <?php if($card->link_type == 1) $link = $card->link_1; else $link = $card->link_2; ?>
                        @if($link != null)
                        <br><a data-id="{!! $card->card_id!!}" href="{!! $link!!}" target="_blank" class="hdl form-btn1 credit-hub hub-list">  Оформить</a><br>
                        @endif
                    </td>
                    <td class="text-center">{{$card->km5}}</td>
                    <td class="text-center">@if(isset($card->ratingValue)) {{$card->ratingValue}} @endif</td>
                    <td class="text-center">@if(isset($card->ratingCount)) {{$card->ratingCount}} @endif</td>
                    <td class="text-center">@if($card->header_1 != null) {{number_format($card->header_1, 0, '.', ' ')}} @endif</td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>