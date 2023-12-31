                    <div id="card-{{$card->id}}" class="one-offer @if($card->promo == 1) spec-offer @endif @if($card->label != 0)label label{{$card->label}} @endif">
                        @if(@$card->promo == 1)
                        <div class="title-top"><i class="fa fa-star-o"></i> Специальное предложение</div>
                        @endif

                        <div class="row mob-relative">
                            <div class="col-md-4 mob-mar">
                                <div class="bor">
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
                                    <?php
                                        $showEntityLink =
                                            $card->link_to_entity != null &&
                                            str_replace('https://finance.ru', '', $card->link_to_entity) !=  '/' . \Request::path() &&
                                            !isset($hideEntityLink);
                                    ?>
                                    @if($showEntityLink)
                                        <a href="{{$card->link_to_entity}}" target="_blank"><img loading="lazy" width="250" height="120" src="{{$card->logo}}" alt="{{$card->title}}"></a>
                                    @else
                                        <img loading="lazy" width="250" height="120" src="{{$card->logo}}" alt="{{$card->title}}">
                                    @endif
                                </div>

                                @if(isset($card->approval_indicator))
                                <div class="bor">
                                    <div class="approval-line no-print">
                                        <div class="tt">Одобрение <img loading="lazy" src="/old_theme/img/icon-help2.png" alt="Одобрение" class="icon-help approval_button"></div>
                                        <div class="progressbar">
                                            <div class="progress progress-bar bg-success progress-bar-striped" style="width: {{$card->approval_indicator}}%" ></div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <?php $link = ($card->link_type == 1) ? $card->link_1 : $card->link_2; ?>
                        		<a data-id="{{$card->id}}" href="{{$link}}" target="_blank" class="hdl form-btn1 no-print {{$card->yandex_event}}">  Оформить</a>
{{--                                @if($card->category_id != 3 && $card->category_id !=10)--}}
{{--                                <button data-id="{{$card->id}}" class="compare add_to_compare"><span>+ к сравнению</span></button>--}}
{{--                                @endif--}}
{{--                                <span  data-id="{{$card->id}}" class="complaint"><i class="fa fa-warning"></i> <span>Подать жалобу</span></span>--}}
                            </div><?php /* col-md-4 */ ?>

                            <div class="col-md-8 mob-initial">

                                <div class="top-cart">

                                    <div class="name-line"><?php
                                        $showEntityLink =
                                            $card->link_to_entity != null &&
                                            str_replace('https://finance.ru', '', $card->link_to_entity) !=  '/' . \Request::path() &&
                                            !isset($hideEntityLink);
                                        if ($showEntityLink) {
                                            echo '<a class="org-card" target="_blank" href="'. $card->link_to_entity .'">' . $card->title . '</a>';
                                        } else {
                                            echo $card->title;
                                        }
                                        ?></div>

                                    @if(isset($card->ratingValue))
                                        <div class="rating-line">
                                        <?php $showEntityReviewsLink = $card->link_to_reviews_page != null && str_replace('https://finance.ru', '', $card->link_to_reviews_page) != '/' . $card->link_to_reviews_page; ?>
                                        @if ($showEntityReviewsLink)
                                            {!! App\Algorithms\System::rating($card->ratingValue) !!}
                                            <div class="text-rating">
                                                <a target="_blank" href="{{$card->link_to_reviews_page}}">{{$card->ratingCount}} {{System::endWords($card->ratingCount, ['отзыв', 'отзыва', 'отзывов'])}}</a> ({{$card->ratingValue}} из 5)
                                            </div>
                                        @endif
                                        </div>
                                    @endif


                                    @if(isset($card->header_1))
                                    <div class="row three-block">
                                        <div class="col-md-4">
                                            <i class="fa fa-check-circle"></i><span>{{cardHeader1($card->header_1,$card->category_id)}}</span>
                                        </div>
                                        @if(isset($card->header_2))
                                        <div class="col-md-4">
                                            <i class="fa fa-check-circle"></i><span>{{cardHeader2($card->header_2,$card->category_id)}}</span>
                                        </div>
                                        @if(isset($card->header_3))
                                        @endif
                                        <div class="col-md-4">
                                            <i class="fa fa-check-circle"></i><span>{{cardHeader3($card->header_3,$card->category_id)}}</span>
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="refresh-item">
                                        <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i> <span>Обновлено</span><br><span>{{fake_update_offer(strtotime($card->created_at))}}</span>
                                    </div>
                                </div>


                                    @if($card->icons != null && $card->category_id != 11)
                                        <div class="vzo_icons_wrap">
                                            <?php
                                            $all_vzo_icons = \Config::get('icons');
                                            $current_vzo_icons = explode(',', $card->icons);
                                            ?>
                                            @foreach ($current_vzo_icons as $current_item_icon)
                                                @if (isset($all_vzo_icons[$current_item_icon]))
                                                    <span class="sprite vzo_icons" style="background: url(/images/ic/icon-{{$current_item_icon}}.png)" data-title="{{$all_vzo_icons[$current_item_icon]['title']}}"></span>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif

                                        <?php $amp = strpos(Request::url(), '/amp') ?>
                                        @if(file_exists( base_path().'/resources/views/site/v3/modules/cards/card/fields/'.$card->category_id.'.blade.php'))
                                            @include("site.v3.modules.cards.card.fields.$card->category_id")
                                        @endif


                                @if(isset($card->additional))
                                @if($card->additional != null)
                                <?php
                                    $c_additional = str_replace("\r", '', $card->additional);
                                    $additionalArr = explode("\n", $c_additional);
                                    ?>

                                <ul class="lv-list">
                                    @foreach($additionalArr as $additional)
                                    <?php if($additional == '') continue ?>
                                    <li>{{$additional}}</li>
                                    @endforeach
                                </ul>
                                @endif
                                @endif

                            </div><!-- end col-md-6 -->
                        </div><!-- end row -->

						<span class="cart_more no-print">Подробнее <i class="fa fa-angle-down"></i></span>
                        <div class="panel-cart">
                            <hr class="accordion-hr">

                            @if(isset($card->text)) @if($card->text!=null)<div class="accordion-p">{!!$card->text!!}</div>@endif @endif
                            <?php /*
                            @if(isset($card->downloads))
                            <?php $downloadsArr = json_decode($card->downloads);?>
                            @if($downloadsArr != null)
                            <ul class="docs-list no-print">
                                @foreach($downloadsArr as $d_key => $downloadItem)
                                <li><i class="fa fa-download"></i> <a href="{{$downloadItem->href}}" target="_blank">{{$downloadItem->label}}</a></li>
                                @endforeach
                            </ul>
                            @endif @endif
                            */ ?>
                            <div class="cl-list d-flex space-around no-print">
                                <?php /*
                                <span class="cl-list-bnt print_card"><i class="fa fa-print"></i> Распечатать</span>
                                <span data-id="{{$card->id}}" class="cl-list-bnt favorite add_to_favorite"><i class="fa fa-star"></i> <span class="fav">В избранное</span></span>
                                */ ?>
                                @if(isset($card->support_link)) @if($card->support_link!=null)<a href="{{$card->support_link}}" target="_blank"><i class="fa fa-phone"></i> Служба поддержки</a>@endif @endif
                                @if(isset($card->account_link)) @if($card->account_link!=null)<a href="{{$card->account_link}}" target="_blank"><i class="fa fa-user"></i> Личный кабинет</a>@endif @endif
                                @if(isset($card->promocodes)) @if($card->promocodes!=null)<a href="{{$card->promocodes}}" target="_blank"><i class="fa fa-tags"></i> Промокоды</a>@endif @endif
                            </div>
                        </div><?php /* end panel */ ?>
                    </div><?php /* end carts */ ?>