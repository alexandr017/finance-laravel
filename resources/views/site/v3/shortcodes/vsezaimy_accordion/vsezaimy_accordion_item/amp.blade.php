<div class="hitem">
    <?php $str = \Illuminate\Support\Str::random(5); ?>
    <input type="checkbox" id="{{$str}}" class="itop-label">
    <label class="itop" for="{{$str}}" data-open="&#9650;" data-close="&#9660;">{!! $title !!}</label>
    <div class="imore">{!! $content !!}</div>
</div>