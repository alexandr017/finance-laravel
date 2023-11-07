<div id="card-{{$card->id}}" class="one-offer @if($card->promo == 1) spec-offer @endif @if($card->label != 0)label label{{$card->label}} @endif">
    @if(@$card->promo == 1)
        <div class="title-top"><i class="fa fa-star-o"></i> Специальное предложение</div>
    @endif
    <div class="d-flex card-mn">
        <div class="card-mn-logo-review-block">
            <?php
            $showEntityLink =
                $card->link_to_entity != null &&
                str_replace('https://finance.ru', '', $card->link_to_entity) != '/' . \Request::path() &&
                !isset($hideEntityLink);
            ?>
            @if($showEntityLink)
                <a href="{{$card->link_to_entity}}" target="_blank"><img loading="lazy" width="250" height="120" src="{{$card->logo}}" alt="{{$card->title}}"></a>
            @else
                <img loading="lazy" width="250" height="120"  src="{{$card->logo}}" alt="{{$card->title}}">
            @endif
            <div class="card-mn-review-name-block">
                <a href="{{$card->link_to_entity}}" target="_blank" class="card-mn-name">{{$card->title}}</a>
                @if(isset($card->ratingValue))
                    <div class="rating-line">
                        <?php $showEntityReviewsLink = $card->link_to_reviews_page != null && str_replace('https://finance.ru', '', $card->link_to_reviews_page) != '/' . $card->link_to_reviews_page; ?>
                        @if ($showEntityReviewsLink)
                            {!! App\Models\System::rating($card->ratingValue) !!}
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

        <div class="card-mn-main-details">
            @if(file_exists( base_path().'/resources/views/site/v3/modules/cards/minimal/fields/'.$card->category_id.'-head.blade.php'))
                @include("site.v3.modules.cards.minimal.fields.$card->category_id-head")
            @endif
        </div>
        <?php
        $link = ($card->link_type == 1) ? $card->link_1 : $card->link_2;
        ?>
        <div class="card-mn-license">
            <a data-id="{{$card->id}}" href="{{$link}}" target="_blank"
               class="hdl form-btn1 no-print {{$card->yandex_event}}">Подать заявку</a>
            @if(isset($card->license) && $card->license != null)
                    <span class="card-mn-label">{{$card->license}}</span>
            @endif
        </div>
    </div>
    <span class="card-mn-more-details">Подробные условия <i class="fa fa-chevron-down" aria-hidden="true"></i></span>
    <div class="card-mn-details-block display_none">
        @if(file_exists( base_path().'/resources/views/site/v3/modules/cards/minimal/fields/'.$card->category_id.'-body.blade.php'))
            @include("site.v3.modules.cards.minimal.fields.$card->category_id-body")
        @endif
            <span class="cart_more no-print">О компании <i class="fa fa-angle-down"></i></span>
        <div class="panel-cart">
            <hr class="accordion-hr">
            @if(isset($card->text) && $card->text != null)<div class="accordion-p">{!!$card->text!!}</div>@endif
            @if(isset($card->downloads) && $card->downloads != null)
                <?php $downloadsArr = json_decode($card->downloads);?>
                    <ul class="docs-list no-print">
                        @foreach($downloadsArr as $d_key => $downloadItem)
                            <li><i class="fa fa-download"></i> <a href="{{$downloadItem->href}}" target="_blank">{{$downloadItem->label}}</a></li>
                        @endforeach
                    </ul>
            @endif
        </div>
        <div class="cl-list d-flex space-around no-print">
{{--            <span class="cl-list-bnt print_card"><i class="fa fa-print"></i> Распечатать</span>--}}
{{--            <span data-id="{{$card->id}}" class="cl-list-bnt favorite add_to_favorite"><i class="fa fa-star"></i> <span class="fav">В избранное</span></span>--}}
            @if(isset($card->support_link) && $card->support_link!=null)<a href="{{$card->support_link}}" target="_blank"><i class="fa fa-phone"></i> Служба поддержки</a>@endif
            @if(isset($card->account_link) && $card->account_link!=null)<a href="{{$card->account_link}}" target="_blank"><i class="fa fa-user"></i> Личный кабинет</a>@endif
{{--            @if(isset($card->promocodes) && $card->promocodes!=null)<a href="{{$card->promocodes}}" target="_blank"><i class="fa fa-tags"></i> Промокоды</a>@endif--}}
        </div>
    </div>
</div><?php /* end carts */ ?>
