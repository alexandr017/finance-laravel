    <p class="name-line border-left border-right border-top bg-grey"><b>{{$card->title}}</b></p>
    <?php $logo_path = (strstr($card->logo,'vsezaimyonline')) ? $card->logo : 'https://finance.ru' . $card->logo; ?>
    <p class="vzo-image-wrap border-left border-right bg-grey"><img src="{{$logo_path}}" alt="{{$card->title}}"></p>
    <p class="rating-line border-left border-right text-center bg-grey">
        <a href="@if($card->group_url!='/')/@endif{{$card->group_url}}@if($card->group_url!='/')/@endif{{$card->companies_alias}}/reviews">{{$card->ratingCount}}  {{System::endWords($card->ratingCount, ['отзыв', 'отзыва', 'отзывов'])}}</a>
        ({{$card->ratingValue}} из 5)
    </p>
    @if(isset($card->approval_indicator))
        <p class="border-left border-right bg-grey"><b class="label">Одобрение:</b> {{$card->approval_indicator}}/100%</p>
    @endif
    <p class="border-left border-right bg-grey"><b class="label">К5М:</b> {{@str_replace('.0','',$card->km5)}}/10</p>
    @if(file_exists( base_path().'/resources/views/frontend/cards/card/fields-turbo/'.$card_category_id.'.blade.php'))
    @include("frontend.cards.card.fields-turbo.$card_category_id")
    @endif
    <?php if($card->link_type == 1) $link = $card->link_1; else $link = $card->link_2; ?>
    <?php if(!strstr($link,'vsezaimyonline')) $link = 'https://finance.ru' . $link; ?>
    <p class="border-left border-right bg-grey">
        <a href="{{$link}}" target="_blank" class="form-btn1" data-goals="offer">  ОФОРМИТЬ</a>
    </p>

    @if(isset($card->additional))
        @if($card->additional != null)
            <?php
            $c_additional = str_replace("\r", '', $card->additional);
            $additionalArr = explode("\n", $c_additional);
            ?>
            <p class="lv-list border-bottom border-left border-right bg-grey">
                @foreach($additionalArr as $additional)
                    <?php if($additional == '') continue ?>
                        <img class="img-inline" src="/old_theme/img/check.png" alt="Преимущества">{{$additional}}<br>
                @endforeach
            </p>
            <br>
        @endif
    @endif
    <?php /*
    <style>
        .border-top{border-top: 1px solid #00b6f7}
        .border-left{border-left: 1px solid #00b6f7}
        .border-right{border-right: 1px solid #00b6f7}
        .border-bottom{border-bottom: 1px solid #00b6f7}
        .bg-grey{background: #f6f6f6;margin: 0 !important;padding: 5px  15px;}
        .bg-grey.border-bottom{margin-bottom: 15px !important}
        .img-inline{float: left;width: 20px !important;padding-right: 4px;top: 3px;}
        .text-center{text-align:center}

    </style>
*/ ?>