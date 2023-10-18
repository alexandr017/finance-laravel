<div class="fdsb text-center">Полезное об автокредите</div>
<div class="ic-db-wrap">
    <ul>
        <?php $i = 0; ?>
        @foreach($db_news as $item)
        @if($i < 9)
        <li>
            <a href="/autocredit/baza-znanij/{{$item->alias}}.html" target="_blank">{{Shortcode::compile($item->h1)}}</a>
        </li>
        @else
        <li class="d_n">
            <a href="/autocredit/baza-znanij/{{$item->alias}}.html" target="_blank">{{Shortcode::compile($item->h1)}}</a>
        </li>
        @endif
        <?php $i++; ?>
        @endforeach
    </ul>
    @if($i > 9)
    <div class="text-center"><span class="show_more_db"><i class="fa fa-arrow-down"></i> Показать все</span></div>
    @endif
</div>