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
                                        <a href="{{$card->link_to_entity}}" target="_blank"><img loading="lazy" src="{{$card->logo}}" alt="{{$card->title}}"></a>
                                    @else
                                        <img loading="lazy" src="{{$card->logo}}" alt="{{$card->title}}">
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
{{--                                @if($card->category_id != 3)--}}
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
                                        $idUserCompanies = response::getIdUserCompanies();
                                        if(in_array($card->company_id, $idUserCompanies)) {
                                            echo '<span class="verified-icon vzo_icons def_bg" data-src="/old_theme/img/icon-veryfied.png" data-title="Официальный представитель на сайте"></span>';
                                        }
                                        ?></div>

                                    @if(isset($card->ratingValue))
                                        <div class="rating-line">
                                        <?php $showEntityReviewsLink = $card->link_to_reviews_page != null && str_replace('https://finance.ru', '', $card->link_to_reviews_page) != '/' . $card->link_to_reviews_page; ?>
                                        @if ($showEntityReviewsLink)
                                            {!! App\Models\System::rating($card->ratingValue) !!}
                                            <div class="text-rating">
                                                <a target="_blank" href="{{$card->link_to_reviews_page}}">{{$card->ratingCount}} {{System::endWords($card->ratingCount, ['отзыв', 'отзыва', 'отзывов'])}}</a> ({{$card->ratingValue}} из 5)
                                            </div>
                                        @endif
                                        </div>
                                    @endif


                                    @if(isset($card->header_1))
                                    <div class="row three-block">
                                        <div class="col-md-4">
                                            <i class="fa fa-check-circle"></i><span>{{response::cardHeader1($card->header_1,$card->category_id)}}</span>
                                        </div>
                                        @if(isset($card->header_2))
                                        <div class="col-md-4">
                                            <i class="fa fa-check-circle"></i><span>{{response::cardHeader2($card->header_2,$card->category_id)}}</span>
                                        </div>
                                        @if(isset($card->header_3))
                                        @endif
                                        <div class="col-md-4">
                                            <i class="fa fa-check-circle"></i><span>{{response::cardHeader3($card->header_3,$card->category_id)}}</span>
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="refresh-item">
                                        <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i> <span>Обновлено</span><br><span>{{fake_update_offer(strtotime($card->created_at))}}</span>
                                    </div>
                                </div>


                                    @if($card->icons != null)
                                        <div class="vzo_icons_wrap">
                                            <?php
                                            $all_vzo_icons = \Config::get('icons');
                                            $current_vzo_icons = explode(',', $card->icons);
                                            ?>
                                            @foreach ($current_vzo_icons as $current_item_icon)
                                                @if (isset($all_vzo_icons[$current_item_icon]))
                                                    <span class="sprite vzo_icons def_bg" data-src="/images/ic/icon-{{$current_item_icon}}.png" data-title="{{$all_vzo_icons[$current_item_icon]['title']}}"></span>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif

                                        <?php $amp = strpos(Request::url(), '/amp') ?>
                                        @if(file_exists( base_path().'/resources/views/frontend/cards/card/fields/'.$card->category_id.'.blade.php'))
                                            @include("frontend.cards.card.fields.$card->category_id")
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
                            <div class="row spidometrs spd-{{$card->category_id}}">
                                <?php
                                    $columsCount = 1;
                                    if(isset($card->ratingValue)){
                                        if($card->ratingValue != 0 || $card->ratingValue != null) $columsCount++;
                                    } elseif(isset($ratingValue)) if($ratingValue != 0 || $ratingValue != null) $columsCount++; 
                                    if( isset($card->approval_indicator) ) $columsCount++;
                                    switch ($columsCount) {
                                        case '1': $class = 12; break;
                                        case '2': $class = 6; break;
                                        case '3': $class = 4; break;
                                        default: $class = 12; break;
                                    }

                                ?>
                                <div class="col-md-{{$class}} col-sm-{{$class}}">
                                    <span class="cpt">К5М</span>
                                    <div class="spidometr def_bg" data-src="/old_theme/img/scala.png">
                                        <span style="transform: rotate({{$card->km5*16}}deg);" class="arrow-spidometr def_bg" data-src="/old_theme/img/arrow_spidometr.png"></span>
                                    </div><div class="val-rating">{{@str_replace('.0','',$card->km5)}}/10</div>
                                </div>
                                @if(isset($card->ratingValue))
                                    @if($card->ratingValue > 0)
                                        <div class="col-md-{{$class}} col-sm-{{$class}}">
                                            <span class="cpt">Отзывы</span>
                                            <div class="spidometr def_bg" data-src="/old_theme/img/scala.png">
                                                <span style="transform: rotate(<?=(int)($card->ratingValue*36)?>deg);-webkit-transform:rotate(<?=(int)($card->ratingValue*36)?>deg);-ms-transform: rotate(<?=(int)($card->ratingValue*36)?>deg);" class="arrow-spidometr def_bg" data-src="/old_theme/img/arrow_spidometr.png"></span>
                                            </div><div class="val-rating">{{$card->ratingValue}}/5</div>
                                        </div>
                                    @endif
                                @endif
                                @if(isset($card->approval_indicator))
                                <div class="col-md-{{$class}} col-sm-{{$class}}">
                                    <span class="cpt">Одобрение</span>
                                    <div class="spidometr def_bg" data-src="/old_theme/img/scala.png">
                                        <span style="transform: rotate({{180*$card->approval_indicator/100}}deg);-webkit-transform:rotate({{180*$card->approval_indicator/100}}deg);-ms-transform: rotate({{180*$card->approval_indicator/100}}deg);" class="arrow-spidometr def_bg" data-src="/old_theme/img/arrow_spidometr.png"></span>
                                    </div><div class="val-rating">{{$card->approval_indicator}}/100%</div>
                                </div>
                                @endif
                            </div>
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
                            <div class="cl-list d-flex space-around no-print">
                                <span class="cl-list-bnt print_card"><i class="fa fa-print"></i> Распечатать</span>
                                <span data-id="{{$card->id}}" class="cl-list-bnt favorite add_to_favorite"><i class="fa fa-star"></i> <span class="fav">В избранное</span></span>
                                @if(isset($card->support_link)) @if($card->support_link!=null)<a href="{{$card->support_link}}" target="_blank"><i class="fa fa-phone"></i> Служба поддержки</a>@endif @endif
                                @if(isset($card->account_link)) @if($card->account_link!=null)<a href="{{$card->account_link}}" target="_blank"><i class="fa fa-user"></i> Личный кабинет</a>@endif @endif
                                @if(isset($card->promocodes)) @if($card->promocodes!=null)<a href="{{$card->promocodes}}" target="_blank"><i class="fa fa-tags"></i> Промокоды</a>@endif @endif
                            </div>
                        </div><?php /* end panel */ ?>
                    </div><?php /* end carts */ ?>