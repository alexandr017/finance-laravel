<p class="short-code short-code-block-with-icon">
    <span class="scbwi-icon-wrap" @if($background != null) style="background:{!! $background !!}" @endif>
        <i @if($color != null) style="color:{!! $color !!}" @endif class="fa {!! $icon !!}"></i>
    </span>
    {!! $content !!}
</p>