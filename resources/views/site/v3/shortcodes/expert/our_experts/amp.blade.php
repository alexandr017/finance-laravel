<div class="experts_wrap">
    @foreach($experts as $expert)
    <div class="experts_item" id="{{str_slug($expert->name)}}">
        <amp-img class="expert_photo" src="{{$expert->photo}}" alt="{{$expert->name}}" width="150" height="150px"></amp-img>
        <span class="expert_name">{{$expert->name}}</span>
        <p class="expert_info">{!! $expert->full_text !!}</p>
        <a href="mailto:{{$expert->email}}" class="expert_email">{{$expert->email}}</a>
        <div class="exert_social_networks">{!! $expert->social_networks !!}</div>
        <div class="clearfix"></div>
    </div>
    @endforeach
</div>