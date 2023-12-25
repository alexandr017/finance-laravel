@if(!is_mobile_device())
@include('site.v3.modules.cards.card.fields.10.pc')
@else
@include('site.v3.modules.cards.card.fields.10.mob')
@endif