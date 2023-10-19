<div class="row rgotu">
    @foreach ($authors as $value)
    <div class='col-50-percent' id="{{str_slug($value->name)}}">
        <div class='gfbx'>
            <amp-img src='{!! $value->photo !!}' alt='{!! $value->name !!}'></amp-img>
            {!! $value->name !!}
        </div>
        <p class='gbx'>{!! $value->text !!}</p>
    </div>
    @endforeach
</div>