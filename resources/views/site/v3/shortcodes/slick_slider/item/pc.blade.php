<div class="sliderItem">
    @if($href != null)
    <a href="{{$href}}" target="_blank"><img loading="lazy" class="sliderItemImg" src="{{$src}}" alt="{{$alt}}"></a>
    @else
    <img loading="lazy" class="sliderItemImg" src="{{$src}}" alt="{{$alt}}">
    @endif
</div>