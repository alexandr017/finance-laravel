<div class="row rgotu">
    @foreach ($authors as $value)
    <div class='col-50-percent' id="{{str_slug($value->name)}}">
        <div class='gfbx'>
            <img loading="lazy" src='{!! $value->photo !!}' alt='{!! $value->name !!}'>
            {!! $value->name !!}
            <br>
            {!! $value->links !!}
        </div>
        <p class='gbx'>{!! $value->text !!}</p>
    </div>
    @endforeach
</div>