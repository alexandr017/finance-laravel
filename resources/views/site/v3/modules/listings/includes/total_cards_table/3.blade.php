@if(count($cards)>3)
	@if($page->total_compare_label != null)
		<h2 class="fdsb listing-h2 text-center" id="comparison">{{$page->total_compare_label}}</h2>
	@else
		<h2 class="fdsb listing-h2 text-center" id="comparison">Итоговое сравнение</h2>
	@endif
<table class="total_cards_table">
	<thead>
		<tr>
			<th class="display_none"></th>
			<th>{{$page->h1}}</th>
			<th>Максимальная сумма</th>
			<th class="display_none"></th>
			<th>Максимальный срок</th>
			<th class="display_none"></th>
			<th>Процентная ставка</th>
		</tr>
	</thead>
	<tbody>
    <?php $j = 1; ?>
		@foreach($cards as $card)
		<tr>
			<td class="display_none">{{$j}}</td>
			<td>
			<?php if($card->link_type == 1) $link = $card->link_1; else $link = $card->link_2; ?>
        		<a class="zalogi" href="{{$link}}" target="_blank" @if(!$amp) onclick="yaCounter38176370.reachGoal('{{$card->yandex_event}}'); return true;"@endif>{{$card->title}}</a>
        	</td>
			<td class="display_none">{{$card->sum_max}}</td>
			<td class="text-center">{{number_format($card->sum_max, 0, '.', ' ')}} руб.</td>
			<td class="display_none">{{$card->term_max}}</td>
			<td class="text-center">{{$card->term_max}} дней</td>
			<td class="text-center">{{$card->percent_min}}%</td>
		</tr>
        <?php $j++; ?>
		@endforeach
	</tbody>		
</table>
@endif
@section('additional-scripts')
<link rel="stylesheet" type="text/css" href="/admin-assets/dataTables/datatables.min.css">
<script src="/admin-assets/dataTables/datatables.min.js" defer></script>
<script>
$(document).ready(function(){
    $('.total_cards_table').DataTable( {
        "order": [[ 0, "asc" ]],
        "language": {"url": "/admin-assets/dataTables/datatables.json"},
        drawCallback: function(settings){
            var info = this.api().page.info();
            if(info.recordsTotal <= 10){
                $('.dataTables_info').remove();
                $('.dataTables_paginate').remove();
            }
        }
    } );
});
</script>
@endsection