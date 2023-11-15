@if(count($cards)>3)
	@if($page->total_compare_label != null)
		<h2 class="fdsb listing-h2 text-center" id="comparison">{{$page->total_compare_label}}</h2>
	@else
		<h2 class="fdsb listing-h2 text-center" id="comparison">Итоговое сравнение расчетных счетов для ИП и ООО</h2>
	@endif
<table class="total_cards_table">
	<thead>
		<tr>
			<th class="display_none"></th>
			<th>@if(isset($tag_name))

					@if($tag_name!='') Расчетные счета
					@if($page->city_id != 0)
						{{mb_convert_case($tag_name, MB_CASE_TITLE)}}
					@else
						{{mb_strtolower($tag_name)}}
					@endif
					@else
						Название
					@endif
				@endif
			</th>
			<th>Открытие</th>
			<th class="display_none"></th>
			<th>Обслуживание</th>
			<th class="display_none"></th>
			<th>Платежка</th>
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
        		<a class="rko" href="{{$link}}" target="_blank">{{$card->title}}</a>
        	</td>
			<td class="display_none">{{$card->opened}}</td>
			<td class="text-center">{{number_format($card->opened, 0, '.', ' ')}} ₽</td>
			<td class="display_none">{{$card->maintenance}}</td>
			<td class="text-center">{{$card->maintenance}} ₽</td>
			<td class="display_none">{{$card->count_payment}}</td>
			<td class="text-center">{{$card->count_payment}} ₽</td>
            <?php $j++; ?>
		</tr>
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