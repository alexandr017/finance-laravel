<?php /* карты с кэшбэком */ ?>

<div class="companies_blocks cards_cache_back_block offers-list">
    @foreach($cards as  $card)
        @include('frontend.companies.hubs_includes.blocks.card_body.9', ['card' => $card])
    @endforeach
</div>