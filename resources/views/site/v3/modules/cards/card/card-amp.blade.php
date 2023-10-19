<div class="one-offer shadow @if($card->promo == 1) spec-offer @endif @if($card->label != 0)label label{{$card->label}} @endif">
                        @if(@$card->promo == 1)
                        <div class="title-top"><i class="fa fa-star-o"></i> Специальное предложение</div>
                        @endif

                        <div class="top-cart">
                            <div class="name-line h4"><?php
                                $showEntityLink = $card->link_to_entity != null && str_replace('https://finance.ru', '', $card->link_to_entity) != '/' . $card->link_to_entity;
                                if ($showEntityLink) {
                                    echo '<a class="org-card" target="_blank" href="'. $card->link_to_entity .'">' . $card->title . '</a>';
                                } else {
                                    echo $card->title;
                                }
                                $idUserCompanies = getIdUserCompanies();
                                if(in_array($card->company_id, $idUserCompanies)) {
                                    echo '<span class="verified-icon vzo_icons def_bg" data-src="/old_theme/img/icon-veryfied.png" data-title="Официальный представитель на сайте"></span>';
                                }
                                ?></div>

                            @if(isset($card->ratingValue))
                                <div class="rating-line">
                                    <?php $showEntityReviewsLink = $card->link_to_reviews_page != null && str_replace('https://finance.ru', '', $card->link_to_reviews_page) != '/' . $card->link_to_reviews_page; ?>
                                    @if ($showEntityReviewsLink)
                                        {!! RatingParser::printImgRatingByValueForAMP($card->ratingValue) !!}
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
                                        <i class="fa fa-refresh"></i> <span>Обновлено</span><br><span>{{fake_update_offer(strtotime($card->created_at))}}</span>
                                    </div>    
                                </div>

                        <div class="row mob-relative">
                            <div class="col-md-4 mob-mar">
                                <amp-img width="250" height="120" layout="fixed" src="{{$card->logo}}" alt="{{$card->title}}"></amp-img>
                                @if(isset($card->approval_indicator))
                                <div class="bor">
                                    <div class="approval-line no-print">
                                        <div class="tt">Одобрение</div>
                                        <div class="progressbar">
                                            <div class="progress progress-bar bg-success progress-bar-striped" style="width: {{$card->approval_indicator}}%" ></div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="bor">
                                    <div class="tt">К5М = {{@str_replace('.0','',$card->km5)}}/10</div>
                                </div>

                            </div><?php /* col-md-4 */ ?>

                            <div class="col-md-8 mob-initial">
                                
                                @if(file_exists( base_path().'/resources/views/site/v3/modules/cards/card/fields/'.$card->category_id.'.blade.php'))
                                @include("site.v3.modules.cards.card.fields.$card->category_id")
                                @endif
                                @if(isset($card->additional))
                                @if($card->additional != null)
                                <?php
                                    $c_additional = str_replace("\r", '', $card->additional);
                                    //dd($c_additional);
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
						<?php if($card->link_type == 1) $link = $card->link_1; else $link = $card->link_2; ?>
                                <a href="{{$link}}" target="_blank" class="form-btn1 {{$card->yandex_event}}"> <i class="fa fa-lock"></i> Оформить</a>
                        
                    </div><?php /* end carts */ ?>