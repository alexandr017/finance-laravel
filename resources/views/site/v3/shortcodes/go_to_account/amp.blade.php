<div class="go_to_account">
    <div class="go_to_account_block">
        <div class="go_to_account_img">
            <?php $imgSize = img_size($logo); ?>
            <amp-img src="{{$logo}}" alt="{{$alt}}" width="{{$imgSize['width']}}px" height="{{$imgSize['height']}}px" layout="fixed"></amp-img>
        </div>
        <div class="go_to_account_text">
            <p>{!! $content !!}</p>
        </div>
    </div>
    <div class="link2_code_wrap text-center">
        <a class="form-btn1 {{$goal_name_0}}" target="_blank" href="{{$link}}">Перейти</a>
        @if($link2 != null)
            <a class="form-btn1 to_issue_button {{$goal_name}}" target="_blank" href="{{$link2}}">Оформить</a>
        @endif
    </div>
</div>