<div class="expert_opinion" id="{{str_slug($expert->name)}}-{{$expert->id}}">
    <span class="eo_title">Экспертное мнение</span>
    <div class="eo_flex_wrap">
        <div class="ep_text_wrap">
            {!! $content !!}
            <button class="form-btn1 ep_btn">Читать</button>
        </div>
        <div class="ep_photo_wrap">
            <img loading="lazy" class="eo_img" src="{{$expert->photo}}" alt="{{$expert->name}}">
            <span class="ep_name">{{$expert->name}}</span>
            <span class="ep_work_place">{{$expert->work_place}}</span>
        </div>
    </div>
</div>