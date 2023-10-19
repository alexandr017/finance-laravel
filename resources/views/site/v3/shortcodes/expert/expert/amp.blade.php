<div class="expert_opinion" id="{{str_slug($expert->name)}}-{{$expert->id}}">
    <div class="h2 text-center">Экспертное мнение</div>
    <amp-img class="eo_img" src="{{$expert->photo}}" alt="{{$expert->name}}" width="150" height="150"></amp-img>
    <span class="ep_name">{{$expert->name}}</span>
    <span class="ep_work_place">{{$expert->work_place}}</span>
    <div class="ep_text_wrap">
        {!! $content !!}
    </div>
</div>