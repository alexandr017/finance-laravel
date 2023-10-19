<div class="time_line_wrap">
    @foreach($innerItems as $item)
        <div class="time_line_item">
            <span class="t_l_bold">{!! $item['bold_text'] !!}</span>
            <p class="t_l_text">{!! $item['content'] !!}</p>
        </div>
    @endforeach
</div>