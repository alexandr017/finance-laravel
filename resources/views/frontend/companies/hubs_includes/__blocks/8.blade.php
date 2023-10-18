<?php /* дебетовые карты */ ?>

<div class="companies_blocks debit_cards_block offers-list">
    @foreach($cards as $card)
        @include('frontend.companies.hubs_includes.blocks.card_body.'.$card->category_id, ['card' => $card])
    @endforeach
</div>