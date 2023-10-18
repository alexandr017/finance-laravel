<div id="card-{{$card->id}}" class="one-offer @if($card->promo == 1) spec-offer @endif @if($card->label != 0)label label{{$card->label}} @endif">
    @if(@$card->promo == 1)
        <div class="title-top"><i class="fa fa-star-o"></i> Специальное предложение</div>
    @endif

    <div class="refresh-item">
        <?php $dateUpdate = \App\Algorithms\Frontend\Cards\CardDate::setUpdateDate($card->created_at); ?>
        <i class="fa fa-refresh"></i> <span>Обновлено</span><br><span>{{$dateUpdate}}</span>
    </div>

    @if(isset($cards) && isset($i))
        @if(count($cards) > 10)
            @if($i < 10)
                <span class="cart-number">{{++$i}}</span>
            @endif
        @elseif(count($cards) < 10 && count($cards) > 5)
            @if($i < 5)
                <span class="cart-number">{{++$i}}</span>
            @endif
        @endif
    @endif

    <div class="name-line">{{$card->title}}</div>

    <div class="rating-line text-center">
        @if($section_type != 5)
            @if($card->company_id != 0)
                @if(isset($card->ratingValue))
                    @if($card->ratingValue != null)
                        @if($card->companies_alias != '')
                            {!! App\Models\System::rating($card->ratingValue) !!}
                            <div class="text-rating">
                                @if($card->reviews_page == 1)
                                    <a target="_blank" href="@if($card->group_url!='/')/@endif{{$card->group_url}}@if($card->group_url!='/')/@endif{{$card->companies_alias}}/reviews">
                                @else
                                    <a target="_blank" href="@if($card->group_url!='/')/@endif{{$card->group_url}}@if($card->group_url!='/')/@endif{{$card->companies_alias}}#reviews">
                                @endif
                                {{$card->ratingCount}}  {{System::endWords($card->ratingCount, ['отзыв', 'отзыва', 'отзывов'])}}
                                </a> ({{$card->ratingValue}} из 5)
                            </div>
                        @endif
                    @endif
                @endif
            @endif
        @else
            {!! App\Models\System::rating($ratingValue) !!}
            <?php $card->ratingValue = $ratingValue; ?>
            <div class="text-rating">
                @if(!$company->reviews_page)
                    <a href="#reviews">
                @else
                    <a target="_blank" href="{{URL::current()}}/reviews">
                @endif
                    {{count($reviews)}}  {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}
                    </a> ({{$ratingValue}} из 5)
            </div>
        @endif
    </div>

    <img class="card-logo" loading="lazy" src="{{$card->logo}}" alt="{{$card->title}}">

    <?php $link = ($card->link_type == 1) ? $card->link_1 : $card->link_2; ?>
    <a data-id="{{$card->id}}" href="{{$link}}" target="_blank" class="hdl form-btn1 no-print {{$card->yandex_event}}"> <i class="fa fa-lock"></i> Оформить</a>

    @if($card->category_id != 3)
        <button data-id="{{$card->id}}" class="compare add_to_compare"><span>+ к сравнению</span></button>
    @endif
    <span  data-id="{{$card->id}}" class="complaint"><i class="fa fa-warning"></i> <span>Подать жалобу</span></span>


    @if(file_exists( base_path().'/resources/views/frontend/cards/card/mob/fields/'.$card->category_id.'.blade.php'))
        @include("frontend.cards.card.mob.fields.$card->category_id")
    @endif



    <span class="cart_more no-print">Подробнее <i class="fa fa-angle-down"></i></span>

</div><?php /* end carts */ ?>