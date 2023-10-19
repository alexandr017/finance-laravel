<?php /* rko */ ?>

<div class="companies_blocks rko_block offers-list">
    @foreach($cards as $card)
        @include('frontend.companies.hubs_includes.blocks.card_body.'.$card->category_id, ['card' => $card])
    @endforeach
</div>