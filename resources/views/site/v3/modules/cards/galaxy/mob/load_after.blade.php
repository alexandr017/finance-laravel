
<div class="panel-cart">
    <hr class="accordion-hr">


    @if(isset($card->approval_indicator))
        <div class="approval-line no-print">
            <div class="tt">Одобрение <img loading="lazy" src="/old_theme/img/icon-help2.png" alt="Одобрение" class="def_load icon-help approval_button"></div>
            <div class="progressbar">
                <div class="progress progress-bar bg-success progress-bar-striped" style="width: {{$card->approval_indicator}}%" ></div>
            </div>
        </div>
    @endif

    @if(isset($card->informer_scale))


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

    @endif

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
        @if($section_type != 5)
            @if($card->company_id != 0)
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
            @endif
        @else
            @if(isset($ratingValue))
                @if($ratingValue != 0 || $ratingValue != null)
                    <div class="col-md-{{$class}} col-sm-{{$class}}">
                        <span class="cpt">Отзывы</span>
                        <div class="spidometr def_bg" data-src="/old_theme/img/scala.png">
                            <span style="transform: rotate(<?=(int)($ratingValue*36)?>deg);-webkit-transform:rotate(<?=(int)($ratingValue*36)?>deg);-ms-transform: rotate(<?=(int)($card->ratingValue*36)?>deg);" class="arrow-spidometr def_bg" data-src="/old_theme/img/arrow_spidometr.png"></span>
                        </div><div class="val-rating">{{$ratingValue}}/5</div>
                    </div>
                @endif
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
        <a href="#" class="print_card"><i class="fa fa-print"></i> Распечатать</a>
        <span>
                                <a href="#" data-id="{{$card->id}}" class="favorite add_to_favorite"><i class="fa fa-star"></i> <span class="fav">В избранное</span></a>
                                </span>
        @if(isset($card->support_link)) @if($card->support_link!=null)<a href="{{$card->support_link}}" target="_blank"><i class="fa fa-phone"></i> Служба поддержки</a>@endif @endif
        @if(isset($card->account_link)) @if($card->account_link!=null)<a href="{{$card->account_link}}" target="_blank"><i class="fa fa-user"></i> Личный кабинет</a>@endif @endif
        @if(isset($card->promocodes)) @if($card->promocodes!=null)<a href="{{$card->promocodes}}" target="_blank"><i class="fa fa-tags"></i> Промокоды</a>@endif @endif

    </div>
</div><?php /* end panel */ ?>