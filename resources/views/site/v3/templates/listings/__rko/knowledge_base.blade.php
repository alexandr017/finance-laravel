<div class="fdsb text-center">Полезное о валютном контроле</div>
<div class="ic-db-wrap">
    <ul>
        <?php $i = 0; ?>
        @foreach($db_news as $item)
            @if($i < 9)
                <li>
                    <a href="/rko/valyutnyj-control/{{$item->alias}}.html" target="_blank">{{Shortcode::compile($item->h1_in_category)}}</a>
                </li>
            @else
                <li class="d_n">
                    <a href="/rko/valyutnyj-control/{{$item->alias}}.html" target="_blank">{{Shortcode::compile($item->h1_in_category)}}</a>
                </li>
            @endif
            <?php $i++; ?>
        @endforeach
    </ul>
    @if($i > 9)
        <div class="text-center"><span class="show_more_db"><i class="fa fa-arrow-down"></i> Показать все</span></div>
    @endif
</div>