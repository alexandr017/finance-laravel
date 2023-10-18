@if(!response::check_mobile())
@include('frontend.cards.card.fields.10.pc')
@else
@include('frontend.cards.card.fields.10.mob')
@endif