<?php /* рко */ ?>
<div class="companies-flex-item">
    <div class="showed-line">
        <div class="showed-wrapper showed-wrapper-1">
            <div class="small-img-wrap">
                <img src="{{$card->logo}}" alt="{{$card->title}}">
            </div>
            <a class="company_title" href="{{$card->link_to_entity}}">{{$card->title}}</a>
        </div>
        <div class="showed-wrapper showed-wrapper-2">
            <span>{!! $card->km5 !!}</span>
        </div>
        <div class="showed-wrapper showed-wrapper-3">
            @if(isset($card->ratingValue))
                <span>{!! $card->ratingValue !!}</span>
            @endif
        </div>
        <div class="showed-wrapper showed-wrapper-4">
            @if(isset($card->ratingCount))
                <span>{!! $card->ratingCount !!}</span>
            @endif
        </div>
        <div class="showed-wrapper showed-wrapper-5">
            <span>{!! number_format($card->maintenance,0,'.',' ') !!}</span>
        </div>
        <div class="showed-wrapper showed-wrapper-6">
            <?php if($card->link_type == 1) $link = $card->link_1; else $link = $card->link_2; ?>
            <br><a data-id="{!! $card->card_id!!}" href="{!! $link!!}" target="_blank" class="hdl form-btn1 rko-hub">Оформить</a>
        </div>
    </div>
    @if($card->opened != null || $card->speed_opened != null || $card->docs != null || $card->scale_1 != null || $card->scale_2 != null || $card->scale_3 != null || $card->scale_4 != null || $card->scale_5 != null || $card->opened != null || $card->speed_opened != null || $card->docs != null)
        <span class="bvc-read">Подробнее <i class="fa fa-angle-down"></i></span>
    @endif
    <?php $isFullWidth =  $card->scale_1 == null && $card->scale_2 == null && $card->scale_3 == null && $card->scale_4 == null && $card->scale_5 == null ?>
    <div class="hidden-line @if($isFullWidth) block @endif">
        <div class="category_params_1">
            @if($card->opened != null)
                <div class="line-prop">
                    <span class="line-prop-title fa-icon fa-clock-o">Стоим. открытия</span>
                    <span class="line-prop-value">{!! number_format($card->opened,0,'.',' ') !!} рублей</span>
                </div>
            @endif
            @if($card->speed_opened != null)
                <div class="line-prop">
                    <span class="line-prop-title fa-icon fa-hourglass-o">Скор. открытия</span>
                    <span class="line-prop-value">{!! $card->speed_opened !!}</span>
                </div>
            @endif
            @if($card->docs != null)
                <div class="line-prop">
                    <span class="line-prop-title fa-icon fa-address-card">Документы</span>
                    <span class="line-prop-value">{!! $card->docs !!}</span>
                </div>
            @endif
        </div>
        <div class="category_params_2">
            @if($card->scale_1 != null)
                <div class="line-scale">
                    <span class="line-scale-title fa-icon fa-cogs">Обслуживание счета</span>
                    <span class="line-scale-print">
                        <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$card->scale_1}}"></span>
                    </span>
                    <span class="line-scale-value">{!! $card->scale_1 !!}/10</span>
                </div>
            @endif
            @if($card->scale_2 != null)
                <div class="line-scale">
                    <span class="line-scale-title fa-icon fa-money">Денежные операции</span>
                    <span class="line-scale-print">
                        <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$card->scale_2}}"></span>
                    </span>
                    <span class="line-scale-value">{!! $card->scale_2 !!}/10</span>
                </div>
            @endif
            @if($card->scale_3 != null)
                <div class="line-scale">
                    <span class="line-scale-title fa-icon fa-plus-circle">Дополнительные услуги</span>
                    <span class="line-scale-print">
                        <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$card->scale_3}}"></span>
                    </span>
                    <span class="line-scale-value">{!! $card->scale_3 !!}/10</span>
                </div>
            @endif
            @if($card->scale_4 != null)
                <div class="line-scale">
                    <span class="line-scale-title fa-icon fa-handshake-o">Надежность банка</span>
                    <span class="line-scale-print">
                        <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$card->scale_4}}"></span>
                    </span>
                    <span class="line-scale-value">{!! $card->scale_4 !!}/10</span>
                </div>
            @endif
            @if($card->scale_5 != null)
                <div class="line-scale">
                    <span class="line-scale-title fa-icon fa-hand-peace-o">Доступность для клиента</span>
                    <span class="line-scale-print">
                        <span class="progress progress-bar bg-success progress-bar-striped lsv-{{$card->scale_5}}"></span>
                    </span>
                    <span class="line-scale-value">{!! $card->scale_5 !!}/10</span>
                </div>
            @endif
        </div>
    </div>
</div>