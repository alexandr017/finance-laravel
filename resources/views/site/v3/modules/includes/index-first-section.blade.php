<div class="first-block index def_bg" style="background: url(/old_theme/img/bg/grey-bg-2.webp)">
    <div class="container">
        <h1 class="ckl-title">{{$page->h1}}</h1>
        <p class="index-lead">{!! $page->lead !!}</p>
            <div class="form-block">
                <div class="col1 form-line">
                    <div class="new-select width-100" id="indexFirstSelect">
                        <b class="active-element">Займы</b>
                        <div class="icon-right bottom"></div>
                        <div class="hidden-elements">
                            <span class="line active" data-val="0">Займы</span>
                            <span class="line" data-val="1">Кредиты</span>
                            <span class="line" data-val="2">Кредитные карты</span>
                            <span class="line" data-val="3">Дебетовые карты</span>
                            <span class="line" data-val="4">Ипотеки</span>
                            <span class="line" data-val="5">Вклады</span>
                            <span class="line" data-val="6">РКО</span>
                        </div>
                        <i></i>
                    </div>
                </div>
                <div class="col2 form-line">
                    <div class="new-select width-100" id="indexSecondSelect">
                        <b class="active-element active-element2" data-val="/card">На карту</b>
                        <div class="icon-right bottom"></div>
                        <div class="hidden-elements"></div>
                        <i></i>
                    </div>
                </div>
                <div class="col3">
                    <button class="form-btn1" id="goToPage">Найти</button>
                </div>
            </div>


        <br class="clearfix">
    </div>
</div>