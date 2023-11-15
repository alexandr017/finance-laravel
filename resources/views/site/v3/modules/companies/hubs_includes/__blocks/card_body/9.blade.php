<div class="companies-flex-item">
    <div class="showed-line">
        <div class="showed-wrapper showed-wrapper-1">
            <div class="small-img-wrap">
                <img src="{{$card->logo}}" alt="{{$card->title}}">
            </div>
            <div class="company_title">
                <a href="{{$card->link_to_entity}}">{{$card->title}}</a>
            </div>
        </div>
        <div class="showed-wrapper showed-wrapper-2">
            <span>{!! $card->km5 !!}</span>
        </div>
        <div class="showed-wrapper showed-wrapper-3">
            <span>{!! $card->ratingValue !!}</span>
        </div>
        <div class="showed-wrapper showed-wrapper-4">
            <span>{!! $card->ratingCount !!}</span>
        </div>
        <div class="showed-wrapper showed-wrapper-5">
            <span>@if(GlobalAlgorithms::getMaxNumberWithPercentFromStr($card->cache_back) != null) {{GlobalAlgorithms::getMaxNumberWithPercentFromStr($card->cache_back)}}% @endif</span>
        </div>
        <div class="showed-wrapper showed-wrapper-6">
            <?php if($card->link_type == 1) $link = $card->link_1; else $link = $card->link_2; ?>
            <br><a data-id="{!! $card->card_id!!}" href="{!! $link!!}" target="_blank" class="hdl form-btn1 cashback-hub" @if(!$amp)>Оформить</a>
        </div>
    </div>
    @if($card->category_id == 6)
    @if($card->scale_1 != null || $card->scale_2 != null || $card->scale_3 != null || $card->scale_4 != null || $card->scale_5 != null ||
    $card->opened != null || $card->age_min != null || $card->docs != null || $card->cache_back != null || $card->percent_on_balance != null)
    <span class="bvc-read">Подробнее <i class="fa fa-angle-down"></i></span>
    @endif
    @endif
    @if($card->category_id == 5)
    @if($card->scale_1 != null || $card->scale_2 != null || $card->scale_3 != null || $card->scale_4 != null || $card->scale_5 != null ||
    $card->opened != null || $card->percent_min != null || $card->none_percent_period != null || $card->age_min != null || $card->docs != null)
    <span class="bvc-read">Подробнее <i class="fa fa-angle-down"></i></span>
    @endif
    @endif
    <?php $isFullWidth =  $card->scale_1 == null && $card->scale_2 == null && $card->scale_3 == null && $card->scale_4 == null && $card->scale_5 == null ?>
    <div class="hidden-line @if($isFullWidth) block @endif">
        <div class="category_params_1">
            @if($card->category_id == 6) <?php /* debit cards */ ?>
            @if($card->opened != null)
            <div class="line-prop">
                <span class="line-prop-title fa-icon fa-clock-o">Стоим. открытия </span>
                <span class="line-prop-value">{!! number_format($card->opened,0,'.',' ') !!} ₽</span>
            </div>
            @endif
            @if($card->age_min != null || $card->age_max != null)
            <div class="line-prop">
                <span class="line-prop-title fa-icon fa-users">Возраст </span>
                <span class="line-prop-value">
                            <?php
                            $age_min = isset($card->age_min) ? 'от ' . $card->age_min : '';
                            $age_max = isset($card->age_max) ? 'до ' . $card->age_max : ''
                            ?>
                                {!! $age_min !!} {!! $age_max !!} лет
                            </span>
            </div>
            @endif
            @if($card->cache_back != null)
            <div class="line-prop">
                <span class="line-prop-title fa-icon fa-thumbs-up">Кэшбэк </span>
                <span class="line-prop-value">{!! $card->cache_back !!}</span>
            </div>
            @endif
            @if($card->percent_on_balance != null)
            <div class="line-prop">
                <span class="line-prop-title fa-icon fa-percent">На остаток </span>
                <span class="line-prop-value">{!! $card->percent_on_balance !!} %</span>
            </div>
            @endif
            @if($card->docs != null)
            <div class="line-prop">
                <span class="line-prop-title fa-icon fa-id-card-o">Документы </span>
                <span class="line-prop-value">{!! $card->docs !!}</span>
            </div>
            @endif
            @else <?php /* credit cards */ ?>
            @if($card->opened != null)
            <div class="line-prop">
                <span class="line-prop-title fa-icon fa-clock-o">Стоим. открытия </span>
                <span class="line-prop-value">{!! $card->opened !!} ₽</span>
            </div>
            @endif
            @if($card->percent_min != null || $card->percent_min != null)
            <div class="line-prop">
                <span class="line-prop-title fa-icon fa-percent">Ставка в год </span>
                <span class="line-prop-value">
                                <?php
                                $percent_min = isset($card->percent_min) ? 'от '.$card->percent_min : '';
                                $percent_max = isset($card->percent_max) ? 'до '.$card->percent_max : ''
                                ?>
                                {!! $percent_min !!} {!! $percent_max !!} %
                            </span>
            </div>
            @endif
            @if($card->none_percent_period != null)
            <div class="line-prop">
                <span class="line-prop-title fa-icon fa-calendar">Без процентов </span>
                <span class="line-prop-value">{!! $card->none_percent_period !!} {{System::endWords($card->none_percent_period,['день','дня','дней'])}}</span>
            </div>
            @endif
            @if($card->age_min != null || $card->age_max != null)
            <div class="line-prop">
                <span class="line-prop-title fa-icon fa-users">Возраст </span>
                <span class="line-prop-value">
                            <?php
                            $age_min = isset($card->age_min) ? 'от '.$card->age_min : '';
                            $age_max = isset($card->age_max) ? 'до '.$card->age_max : ''
                            ?>
                                {!! $age_min !!} {!! $age_max !!} лет
                            </span>
            </div>
            @endif
            @if($card->docs != null)
            <div class="line-prop">
                <span class="line-prop-title fa-icon fa-address-card">Документы </span>
                <span class="line-prop-value">{!! $card->docs !!}</span>
            </div>
            @endif
            @endif



        </div>
        <div class="category_params_2">
            @if($card->scale_1 != null)
            <div class="line-scale">
                <span class="line-scale-title fa-icon fa-file-text">Условия кэшбэка</span>
                <span class="line-scale-print">
                                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$card->scale_1}}"></span>
                            </span>
                <span class="line-scale-value">{{$card->scale_1}}/10</span>
            </div>
            @endif
            @if($card->scale_2 != null)
            <div class="line-scale">
                <span class="line-scale-title fa-icon fa-percent">Размер кэшбэка</span>
                <span class="line-scale-print">
                                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$card->scale_2}}"></span>
                            </span>
                <span class="line-scale-value">{{$card->scale_2}}/10</span>
            </div>
            @endif
            @if($card->scale_3 != null)
            <div class="line-scale">
                <span class="line-scale-title fa-icon fa-user-circle-o">Удобство для держателя</span>
                <span class="line-scale-print">
                                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$card->scale_3}}"></span>
                            </span>
                <span class="line-scale-value">{{$card->scale_3}}/10</span>
            </div>
            @endif
            @if($card->scale_4 != null)
            <div class="line-scale">
                <span class="line-scale-title fa-icon fa-plus-circle">Дополнительные услуги</span>
                <span class="line-scale-print">
                                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$card->scale_4}}"></span>
                            </span>
                <span class="line-scale-value">{{$card->scale_4}}/10</span>
            </div>
            @endif
            @if($card->scale_5 != null)
            <div class="line-scale">
                <span class="line-scale-title fa-icon fa-handshake-o">Надежность банка</span>
                <span class="line-scale-print">
                                <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$card->scale_5}}"></span>
                            </span>
                <span class="line-scale-value">{{$card->scale_5}}/10</span>
            </div>
            @endif
        </div>
    </div>
</div>