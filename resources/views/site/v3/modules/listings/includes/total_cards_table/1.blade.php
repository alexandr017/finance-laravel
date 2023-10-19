@if(count($cards)>3)
	@if($page->total_compare_label != null)
		<h2 class="fdsb listing-h2 text-center" id="comparison">{{$page->total_compare_label}}</h2>
	@else
		<h2 class="fdsb listing-h2 text-center" id="comparison">Итоговое сравнение</h2>
	@endif
<table class="total_cards_table">
	<?php /* временная тестовая фича */?>
	@if($page->id == 539)
	<caption>Таблица 1. Сравнение сумм, сроков и процентных ставок</caption>
	@endif
	<thead>
		<tr>
			<th class="display_none"></th>
			<th>@if(isset($tag_name))
					Займы
					@if($tag_name!='')
						@if($page->city_id != 0)
							{{mb_convert_case($tag_name, MB_CASE_TITLE)}}
						@else
							{{mb_strtolower($tag_name)}}
						@endif
					@endif
				@endif
			</th>
			<th>Максимальная сумма</th>
			<th class="display_none"></th>
			<th>Максимальный срок</th>
			<th class="display_none"></th>
			<th>Процентная ставка</th>
			<th class="display_none"></th>
		</tr>
	</thead>
	<tbody>
    <?php $j = 1; ?>
		@foreach($cards as $card)
		<tr>
			<td class="display_none">{{$j}}</td>
			<td>
			<?php if($card->link_type == 1) $link = $card->link_1; else $link = $card->link_2; ?>
        		<a class="offer" href="{{$link}}" target="_blank" @if(!$amp) onclick="yaCounter38176370.reachGoal('{{$card->yandex_event}}'); return true;"@endif>{{$card->title}}</a>
        	</td>
			<td class="display_none">{{$card->header_1}}</td>
			<td class="text-center">{{number_format($card->header_1, 0, '.', ' ')}} руб.</td>
			<td class="display_none">{{$card->header_2}}</td>
			<td class="text-center">{{$card->header_2}} {{System::endWords($card->header_2,[' день',' дня',' дней'])}}</td>
			<td class="display_none">{{str_replace('%','',str_replace(',','.',$card->header_3))}}</td>
			<td class="text-center">{{$card->header_3}}%</td>
		</tr>
        <?php $j++; ?>
		@endforeach
	</tbody>		
</table>
@endif
@section('additional-scripts')

<link rel="stylesheet" type="text/css" href="/backend/dataTables/datatables.min.css">
<script src="/backend/dataTables/datatables.min.js" defer></script>
<script>
$(document).ready(function(){
    $('.total_cards_table').DataTable( {
        "order": [[ 0, "asc" ]],
        "language": {"url": "/backend/dataTables/datatables.json"},
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