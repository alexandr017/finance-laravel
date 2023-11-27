@if($company->group_id == 1)
    <div class="silver-company-block">
        <p class="pupdate">
            <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}}</span>
        </p>
        @if(isset($cards[0]))
            <img loading="lazy" src="{{$cards[0]->logo}}" alt="{{$cards[0]->title}}" class="logo-company">
            <div class="k5m-wrap">К5М = {{$cards[0]->km5}}/10 <img loading="lazy" src="/old_theme/img/icon-help2.png" alt="Рейтинг К5М" class="icon-help k5m_button"></div>
        @endif

        <div class="rating-line micro">
            <?php
            $realCount = 0; $ratingValue = 0; $ratingValueTmp = 0;
            foreach ($reviews as  $review) {
                if($review->rating != null){
                    $ratingValueTmp += $review->rating;
                    $realCount++;
                }
            }
            if($realCount != 0){
                $ratingValue = round($ratingValueTmp / $realCount,2);
            } else {
                $ratingValue = 0;
            }
            ?>
            {!! App\Algorithms\System::rating($ratingValue) !!}
            <div class="text-rating">
                @if(!$company->reviews_page)
                    <a rel="nofollow" href="#reviews"><span>{{count($reviews)}}</span> {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}</a>
                @else
                    <a rel="nofollow" href="<?= str_replace('https://'.$_SERVER['SERVER_NAME'], '', URL::current()) ?>/reviews"><span>{{count($reviews)}}</span> {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}</a>
                @endif
            </div>
            <div class="val-rating">(<span>{{$ratingValue}}</span> из <span>5</span>)</div>
        </div>

        {!! Shortcode::compile(System::nofollow($company->text_before)) !!}

        @if(isset($cards[0]))
            @if($cards[0]->icon_after_name != null)
                <div class="pay-icons zaym_cards">
                    <?php
                    $icons = $cards[0]->icon_after_name;
                    $iconsArr = explode(',',$icons);
                    foreach ($iconsArr as $key => $value) {
                        echo "<span  data-icon=\"$value\" class=\"zaym-pic pic$value\"></span>";
                    }
                    ?>
                </div>
            @endif
        @endif

        @if(isset($cards[0]))
            <div class="scb-group">
                <span class="scb-label"><i class="fa fa-money"></i> Сумма</span>
                <div class="scb-value">от {{number_format($cards[0]->sum_min, 0, '.', ' ')}} @if(isset($cards[0]->sum_max)) @if($cards[0]->sum_max != null) до {{number_format($cards[0]->sum_max, 0, '.', ' ')}} ₽ @endif @endif</div>
                <span class="scb-label"><i class="fa fa-calendar"></i> Срок</span>
                <div class="scb-value">от {{$cards[0]->term_min}} @if(isset($cards[0]->term_max)) @if($cards[0]->sum_max != null) до {{$cards[0]->term_max}} дней @endif @endif</div>
                <span class="scb-label"><i class="fa fa-percent"></i> Ставка в день</span>
                <div class="scb-value">{{$cards[0]->percent}}%</div>
            </div>
        @endif

        <div class="scales">
            @if($company->scale_1 != null)
                <div class="line-scale">
                    Условия займов ({{$company->scale_1}}/10)
                    <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$company->scale_1}}"></span>
            </span>
                </div>
            @endif
            @if($company->scale_2 != null)
                <div class="line-scale">
                    Удобство для заемщика ({{$company->scale_2}}/10)
                    <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$company->scale_2}}"></span>
            </span>
                </div>
            @endif
            @if($company->scale_3 != null)
                <div class="line-scale">
                    Оформление и погашение ({{$company->scale_3}}/10)
                    <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$company->scale_3}}"></span>
            </span>
                </div>
            @endif
            @if($company->scale_4 != null)
                <div class="line-scale">
                    Надежность компании ({{$company->scale_4}}/10)
                    <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$company->scale_4}}"></span>
            </span>
                </div>
            @endif
            @if($company->scale_5 != null)
                <div class="line-scale">
                    Доступность для заемщиков ({{$company->scale_5}}/10)
                    <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$company->scale_5}}"></span>
            </span>
                </div>
            @endif
        </div>

        {!! $company->company_advantages !!}

        @if(isset($cards[0]))
            <table class="company-face-table">
                <tr>
                    <th>Сумма</th>
                    <td>
                        @if(isset($cards[0]->sum_min)) @if($cards[0]->sum_min != null)
                            от {{number_format($cards[0]->sum_min, 0, '.', ' ')}} @if(isset($cards[0]->sum_max)) @if($cards[0]->sum_max != null) до {{number_format($cards[0]->sum_max, 0, '.', ' ')}} ₽ @endif @endif
                        @endif @endif
                    </td>
                </tr>
                <tr>
                    <th>Ставка в день</th>
                    <td>
                        @if(isset($cards[0]->percent)) @if($cards[0]->percent != null)
                            {{$cards[0]->percent}}%
                        @endif @endif
                    </td>
                </tr>
                <tr>
                    <th>Переплата, от</th>
                    <td>
                        <?php
                        $m_min = (isset($cards[0]->sum_min)) ? $cards[0]->sum_min : 0;
                        $m_term_min = (isset($cards[0]->term_min)) ? $cards[0]->term_min : 0;
                        $m_percent = (isset($cards[0]->percent)) ? $cards[0]->percent : 0;
                        $res = $m_min * ($m_percent /100) * $m_term_min;
                        echo number_format($res, 0, '.', ' ') . ' ₽';
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Документы</th>
                    <td>
                        @if(isset($cards[0]->docs)) @if($cards[0]->docs != null)
                            {{$cards[0]->docs}}
                        @endif @endif
                    </td>
                </tr>
                <tr>
                    <th>Плохая КИ</th>
                    <td>
                        @if(isset($cards[0]->poor_ch)) @if($cards[0]->poor_ch != null)
                            @if($cards[0]->poor_ch==1) да @else нет @endif
                        @endif @endif
                    </td>
                </tr>
                <tr>
                    <th>Продление</th>
                    <td>
                        @if(isset($cards[0]->extension)) @if($cards[0]->extension != null)
                            {{$cards[0]->extension}}
                        @endif @endif
                    </td>
                </tr>
                <tr>
                    <th>Возраст заемщика</th>
                    <td>
                        @if(isset($cards[0]->age_min)) @if($cards[0]->age_min != null)
                            от {{$cards[0]->age_min}} @if(isset($cards[0]->age_max)) @if($cards[0]->age_max != null) до {{$cards[0]->age_max}} лет @endif  @else @if($cards[0]->age_min == 21) года @else лет @endif  @endif
                        @endif @endif
                    </td>
                </tr>
                <tr>
                    <th>Скорость выплаты</th>
                    <td>
                        @if(isset($cards[0]->payout_speed)) @if($cards[0]->payout_speed != null)
                            {{$cards[0]->payout_speed}}
                        @endif @endif
                    </td>
                </tr>
            </table>
        @endif

        @if(isset($cards[0]))
            <a data-id="{{$cards[0]->id}}" class="form-btn1" @if($cards[0]->link_type==1) href="{{$cards[0]->link_1}}" @else href="{{$cards[0]->link_2}}" @endif target="_blank"> Оформить</a>
            <button id="load_card_for_company" class="form-btn1">Подробнее</button>
        @endif
    </div>
@endif