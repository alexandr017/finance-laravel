@if(!response::check_mobile())
@include('frontend.cards.card.fields.11.pc')
@else
@include('frontend.cards.card.fields.11.mob')
@endif