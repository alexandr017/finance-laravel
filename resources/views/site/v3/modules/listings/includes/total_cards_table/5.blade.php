@if(count($cards)>3)
    @if($page->total_compare_label != null)
        <h2 class="fdsb listing-h2 text-center" id="comparison">{{$page->total_compare_label}}</h2>
    @else
        <h2 class="fdsb listing-h2 text-center" id="comparison">Итоговое сравнение кредитных карт</h2>
    @endif
    <table class="total_cards_table">
        <thead>
        <tr>
            <th class="display_none"></th>
            <th>@if(isset($tag_name))
                @if($tag_name!='')Кредитные карты
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
            <th>Максимальный лимит</th>
            <th class="display_none"></th>
            <th>Беспроцентный период</th>
            <th class="display_none"></th>
            <th>Процентная ставка в год</th>
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
                <td class="display_none">{{$card->limit_max}}</td>
                <td class="text-center">{{number_format($card->limit_max, 0, '.', ' ')}} руб.</td>
                <td class="display_none">{{$card->none_percent_period}}</td>
                <td class="text-center">{{$card->none_percent_period}} {{System::endWords($card->none_percent_period,['день','дня','дней'])}}</td>
                <td class="display_none">
                    @if(isset($card->percent_max))
                        @if($card->percent_max !== null)
                            от {{$card->percent_min}} до {{$card->percent_max}}%
                        @else
                            {{$card->percent_min}}%
                        @endif
                    @else
                        {{$card->percent_min}}%
                    @endif
                </td>
                <td class="text-center">
                    @if(isset($card->percent_max))
                        @if($card->percent_max !== null)
                            от {{$card->percent_min}} до {{$card->percent_max}}%
                        @else
                            {{$card->percent_min}}%
                        @endif
                    @else
                        {{$card->percent_min}}%
                    @endif
                </td>
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