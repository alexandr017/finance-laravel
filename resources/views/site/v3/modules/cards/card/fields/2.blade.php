@if(!is_mobile_device())
    @include('site.v3.modules.cards.card.fields.2desc')
@else
    @include('site.v3.modules.cards.card.fields.2mob')
@endif
