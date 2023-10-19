<div class="go_to_account">
    <div class="go_to_account_block">
        <div class="go_to_account_img"><img loading="lazy" src="{!! $logo !!}" alt="{!! $alt !!}"></div>
        <div class="go_to_account_text">
            <p>{!! $content !!}</p>
        </div>
    </div>
    <div class="link2_code_wrap text-center">
        <a class="form-btn2" target="_blank" href="{!! $link !!}">Перейти</a>
        @if($link2 != null)
            <a class="form-btn1 to_issue_button" target="_blank" href="{!! $link2 !!}" >Оформить</a>
        @endif
    </div>
</div>