@if(!response::check_mobile())
    @include('frontend.cards.card.fields.2desc')
@else
    @include('frontend.cards.card.fields.2mob')
@endif
