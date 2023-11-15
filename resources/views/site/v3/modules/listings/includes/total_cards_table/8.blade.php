@if(count($cards)>3)
    @if($page->total_compare_label != null)
        <h2 class="fdsb listing-h2 text-center" id="comparison">{{$page->total_compare_label}}</h2>
    @else
        <h2 class="fdsb listing-h2 text-center" id="comparison">Итоговое сравнение автокредитов</h2>
    @endif
    <table class="total_cards_table">
        <thead>
        <tr>
            <th class="display_none"></th>
            <th>Автокредиты @if(isset($tag_name)) @if($tag_name!='') {{$tag_name}} @endif @endif</th>
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
                    <a class="creditonline" href="{{$link}}" target="_blank" @if(!$amp) onclick="yaCounter38176370.reachGoal('{{$card->yandex_event}}'); return true;"@endif>{{$card->title}}</a>
                </td>
                <td class="display_none">{{$card->header_1}}</td>
                <td class="text-center">{{number_format($card->header_1, 0, '.', ' ')}} ₽</td>
                <td class="display_none">{{$card->header_2}}</td>
                <td class="text-center">{{$card->header_2}} месяцев</td>
                <td class="display_none">{{str_replace('%','',str_replace(',','.',$card->header_3))}}</td>
                <td class="text-center">{{$card->header_3}}% в год</td>
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