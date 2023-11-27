@if(!is_mobile_device())
@include('site.v3.modules.cards.card.fields.11.pc')
@else
@include('site.v3.modules.cards.card.fields.11.mob')
@endif