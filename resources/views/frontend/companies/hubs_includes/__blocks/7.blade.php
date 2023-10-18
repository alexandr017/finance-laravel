<?php /* кредитные карты */ ?>

<div class="companies_blocks credit_cards_block offers-list">
    @foreach($cards as $card)
        @include('frontend.companies.hubs_includes.blocks.card_body.'.$card->category_id, ['card' => $card])
    @endforeach
</div>