<?php /* займи */ ?>
@if(Auth::id() == 12467)

@endif
<div class="companies_blocks zajm_block offers-list">
    @foreach($cards as $card)
        @include('frontend.companies.hubs_includes.blocks.card_body.'.$card->category_id, ['card' => $card])
    @endforeach
</div>