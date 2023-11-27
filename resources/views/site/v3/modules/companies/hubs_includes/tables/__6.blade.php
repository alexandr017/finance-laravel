<?php /* криптовалюты */ ?>
<div class="ltable-wrap">
<table class="ltable">
<thead>
    <tr>
        <th>Криптабиржа</th>
        <th class="max-130">Отзывы</th>
        <th class="display_none"></th>
    </tr>
</thead>
<tbody>
@foreach($cards as $card)
    <tr>
        <td>
            <div class="small-img-wrap">
            @if(!$amp)
            <img src="{{$card->img}}" alt="{{$card->h1}}">
            @else
            <amp-img width="125" height="60" layout="fixed" src="{{$card->logo}}" alt="{{$card->title}}"></amp-img>
            @endif
            </div><div> <a href="/{{$card->url}}">{{$card->h1}}</a></div>
        </td>
        <td class="display_none">{{$card->ratingCount}}</td>
        <td>
            <div class="rating-line micro">
                {!! App\Algorithms\System::rating($card->ratingValue) !!}<br>
                <div class="text-rating">
                    <span>{{$card->ratingCount}}</span> {{System::endWords($card->ratingCount, ['отзыв', 'отзыва', 'отзывов'])}}
                (<span>{{$card->ratingValue}}</span> из <span>5</span>)
                </div>
            </div>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
@section('additional-scripts')
<link rel="stylesheet" type="text/css" href="/admin-assets/dataTables/datatables.min.css">
<script src="/admin-assets/dataTables/datatables.min.js" defer></script>
<script>
$(document).ready(function(){
    $('.ltable').DataTable( {
        "order": [[ 1, "desc" ]],
        "pageLength": 200,
        "language": {"url": "/admin-assets/dataTables/datatables.json"},
        "fnDrawCallback": function(oSettings) {
            if (oSettings._iDisplayLength > oSettings.fnRecordsDisplay()) {
                $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
            }
        }        
    } );
});
</script>
@endsection