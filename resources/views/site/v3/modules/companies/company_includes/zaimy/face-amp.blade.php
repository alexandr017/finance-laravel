<div class="silver-company-block">

    <div class="rating-line micro">
        <?php $ratingValue = \App\Algorithms\Frontend\Banks\BankReviews::getRatingByReviews($reviews); ?>
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

    @if(!$company->closed && isset($cards[0]))
        <div class="scb-group">
            <span class="scb-label"></i> Сумма</span>
            <div class="scb-value">от {{number_format($cards[0]->sum_min, 0, '.', ' ')}} @if(isset($cards[0]->sum_max)) @if($cards[0]->sum_max != null) до {{number_format($cards[0]->sum_max, 0, '.', ' ')}} руб. @endif @endif</div>
            <span class="scb-label">Срок</span>
            <div class="scb-value">от {{$cards[0]->term_min}} @if(isset($cards[0]->term_max)) @if($cards[0]->sum_max != null) до {{$cards[0]->term_max}} дней @endif @endif</div>
            <span class="scb-label">Ставка в день</span>
            <div class="scb-value">{{$cards[0]->percent}}%</div>
        </div>

    <div class="scales">
        @if($cards[0]->scale_1 != null)
            <div class="line-scale">
                Условия займов ({{$cards[0]->scale_1}}/10)
                <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_1}}"></span>
            </span>
            </div>
        @endif
        @if($cards[0]->scale_2 != null)
            <div class="line-scale">
                Удобство для заемщика ({{$cards[0]->scale_2}}/10)
                <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_2}}"></span>
            </span>
            </div>
        @endif
        @if($cards[0]->scale_3 != null)
            <div class="line-scale">
                Оформление и погашение ({{$cards[0]->scale_3}}/10)
                <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_3}}"></span>
            </span>
            </div>
        @endif
        @if($cards[0]->scale_4 != null)
            <div class="line-scale">
                Надежность компании ({{$cards[0]->scale_4}}/10)
                <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_4}}"></span>
            </span>
            </div>
        @endif
        @if($cards[0]->scale_5 != null)
            <div class="line-scale">
                Доступность для заемщиков ({{$cards[0]->scale_5}}/10)
                <span class="line-scale-print">
                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$cards[0]->scale_5}}"></span>
            </span>
            </div>
        @endif
    </div>
    @endif

    <p>{!! str_replace(['<p>','</p>'], '', Shortcode::compile(System::nofollow($company->text_before))) !!}</p>

    @if(isset($cards[0]))
        <table class="company-face-table">
            <tr>
                <th>Сумма</th>
                <td>
                    @if(isset($cards[0]->sum_min)) @if($cards[0]->sum_min != null)
                        от {{number_format($cards[0]->sum_min, 0, '.', ' ')}} @if(isset($cards[0]->sum_max)) @if($cards[0]->sum_max != null) до {{number_format($cards[0]->sum_max, 0, '.', ' ')}} руб. @endif @endif
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
                    echo number_format($res, 0, '.', ' ') . ' руб.';
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
                        @if($cards[0]->poor_ch==1) Да @else Нет @endif
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
        <a data-id="{{$cards[0]->id}}" class="company-form-btn" @if($cards[0]->link_type==1) href="{{$cards[0]->link_1}}" @else href="{{$cards[0]->link_2}}" @endif target="_blank">Оформить</a>
    @endif
</div>