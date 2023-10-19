<div class="vab">
    <div class="vertical_tabs_block">
        <div class="left-block col_cnt_3">
            <ul>
                @foreach($content['titles'] as $key=>$title)
                    <li data-id="{!! $key !!}" class="active">{!! $title !!}</li>
                @endforeach
            </ul>
        </div>
        <div class="right-block col_cnt_9">
            @foreach($content['descs'] as $key=>$desc)
                <?php
                $add_class = ($content['titles'][$key] == 'Документы') ? 'documents_tab' : '';
                ?>
                @if($key==0)
                    <div data-id="{!! $key !!}" class="rtext show {!! $add_class !!}">{!! $desc !!}</div>
                @else
                    <div data-id="{!! $key !!}" class="rtext {!! $add_class !!}">{!! $desc !!}</div>
                @endif
            @endforeach
        </div>
    </div>
</div>