<?php /* mfo */ ?>
<div class="companies-flex-item">
    <div class="showed-line">
        <div class="showed-wrapper showed-wrapper-1">
            <div class="small-img-wrap">
                <img loading="lazy" src="{!! $card->logo!!}" alt="{!! $card->title!!}">
            </div>
            <a class="company_title" href="/mfo{!! $card->link_to_entity!!}">{!! $card->title!!}</a>
        </div>
        <div class="showed-wrapper showed-wrapper-2">
            <span>{!! $card->informer_scale !!}</span>
        </div>
        <div class="showed-wrapper showed-wrapper-3">
            <span>{!! $card->approval_indicator !!}</span>
        </div>
        <div class="showed-wrapper showed-wrapper-4">
            <span>{!! $card->km5 !!}</span>
        </div>
        <div class="showed-wrapper showed-wrapper-5">
            <span>{!! $card->ratingValue !!}</span>
        </div>
        <div class="showed-wrapper showed-wrapper-6">
            <span>{!! $card->ratingCount !!}</span>
        </div>
        <div class="showed-wrapper showed-wrapper-7">
            <span>@if($card->header_1 !=0){!! number_format($card->header_1, 0, '.', ' ') !!}@endif</span>
        </div>
        <div class="showed-wrapper showed-wrapper-8">
            <?php if($card->link_type == 1) $link = $card->link_1; else $link = $card->link_2; ?>
            <br><a data-id="{!! $card->card_id!!}" href="{!! $link!!}" target="_blank" class="hdl form-btn1 zaim-hub">Оформить</a>
        </div>
    </div>
    @if($card->term_min != null || $card->percent != null || $card->poor_ch != null || $card->docs != null || $card->scale_1 != null || $card->scale_2 != null || $card->scale_3 != null || $card->scale_4 != null || $card->scale_5 != null)
    <span class="bvc-read">Подробнее <i class="fa fa-angle-down"></i></span>
    @endif
    <?php $isFullWidth =  $card->scale_1 == null && $card->scale_2 == null && $card->scale_3 == null && $card->scale_4 == null && $card->scale_5 == null ?>
    <div class="hidden-line @if($isFullWidth) block @endif">
        <div class="category_params_1">
            @if($card->term_min != null || $card->term_max != null)
            <div class="line-prop">
                <span class="line-prop-title fa-icon fa-calendar">Срок</span>
                <span class="line-prop-value">
                    <?php
                    $term_min = isset($card->term_min) ? 'от '.$card->term_min : '';
                    $term_max = isset($card->term_max) ? 'до '.$card->term_max : ''
                    ?>
                    {!! $term_min !!} {!! $term_max !!} дней
                </span>
            </div>
            @endif
            @if($card->percent != null)
            <div class="line-prop">
                <span class="line-prop-title fa-icon fa-percent">Ставка в день</span>
                <span class="line-prop-value">{!! $card->percent!!} %</span>
            </div>
            @endif
            @if($card->age_min != null || $card->age_max != null)
            <div class="line-prop">
                <span class="line-prop-title fa-icon fa-users">Возраст</span>
                <span class="line-prop-value">
                    <?php
                    $age_min = isset($card->age_min) ? 'от '.$card->age_min : '';
                    $age_max = isset($card->age_max) ? 'до '.$card->age_max : ''
                    ?>
                    {!! $age_min !!} {!! $age_max !!} лет
                </span>
            </div>
            @endif
            @if($card->poor_ch != null)
            <div class="line-prop">
                <span class="line-prop-title fa-icon fa-user-secret">Плохая КИ</span>
                <span class="line-prop-value"><?php echo(isset($card->poor_ch) ? '<i class="fa fa-check-square-o"></i>': '<i class="fa fa-times"></i>')?></span>
            </div>
            @endif
            @if($card->docs != null)
            <div class="line-prop">
                <span class="line-prop-title fa-icon fa-id-card-o">Документы</span>
                <span class="line-prop-value">{!! $card->docs!!}</span>
            </div>
            @endif
        </div>
        <div class="category_params_2">
            @if($card->scale_1 != null)
            <div class="line-scale">
                <span class="line-scale-title fa-icon fa-file-text">Условия займов</span>
                <span class="line-scale-print">
                    <span class="progress progress-bar bg-success progress-bar-striped lsv-{!! $card->scale_1!!}"></span>
                </span>
                <span class="line-scale-value">{!! $card->scale_1!!}/10</span>
            </div>
            @endif
            @if($card->scale_2 != null)
            <div class="line-scale">
                <span class="line-scale-title fa-icon fa-user-circle-o">Удобство для заемщика</span>
                <span class="line-scale-print">
                    <span class="progress progress-bar bg-success progress-bar-striped lsv-{!! $card->scale_2!!}"></span>
                </span>
                <span class="line-scale-value">{!! $card->scale_2!!}/10</span>
            </div>
            @endif
            @if($card->scale_3 != null)
            <div class="line-scale">
                <span class="line-scale-title fa-icon fa-share-square-o">Оформление и погашение</span>
                <span class="line-scale-print">
                    <span class="progress progress-bar bg-success progress-bar-striped lsv-{!! $card->scale_3!!}"></span>
                </span>
                <span class="line-scale-value">{!! $card->scale_3!!}/10</span>
            </div>
            @endif
            @if($card->scale_4 != null)
            <div class="line-scale">
                <span class="line-scale-title fa-icon fa-handshake-o">Надежность компании</span>
                <span class="line-scale-print">
                    <span class="progress progress-bar bg-success progress-bar-striped lsv-{!! $card->scale_4!!}"></span>
                </span>
                <span class="line-scale-value">{!! $card->scale_4!!}/10</span>
            </div>
            @endif
            @if($card->scale_5 != null)
            <div class="line-scale">
                <span class="line-scale-title fa-icon fa-hand-peace-o">Доступность для заемщиков</span>
                <span class="line-scale-print">
                    <span class="progress progress-bar bg-success progress-bar-striped lsv-{!! $card->scale_5!!}"></span>
                </span>
                <span class="line-scale-value">{!! $card->scale_5!!}/10</span>
            </div>
            @endif
        </div>
    </div>

</div>