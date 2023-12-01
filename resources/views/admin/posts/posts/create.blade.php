@extends ('admin.layouts.app')
@section ('title', 'Создание записи')
@section ('h1', 'Создание записи')
@section('content')

<link href="/admin-assets/select2/select2.min.css" rel="stylesheet" />
<script src="/admin-assets/select2/select2.min.js"></script>

<form action="/admin/posts/posts/create_save" method="post">
    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

    <div class="form-group">
        <label for="title"><i>*</i> Title:</label>
        <input type="text" class="form-control" name="title" id="title" required="true">
    </div>

    <div class="form-group">
        <label for="h1"><i>*</i> H1:</label>
        <input type="text" class="form-control" name="h1" id="h1" required="true">
    </div>

    <div class="form-group">
        <label for="h1_in_category">Заголовок на странице категорий:</label>
        <input type="text" class="form-control" name="h1_in_category" id="h1_in_category">
    </div>

    <div class="form-group">
        <label for="alias"><i>*</i> Постоянная ссылка:</label> <span class="btn btn-default btn-xs translate"><i class="fa fa-language"></i></span>
        <input type="text" class="form-control" name="alias" id="alias" required="true">
    </div>

    <div class="form-group">
        <label for="breadcrumb">Хлебные крошки:</label>
        <textarea class="form-control" name="breadcrumb" id="breadcrumb"></textarea>
    </div>
    <div class="form-group">
        <label for="main_photo">Главное фото(в конце пути ставить ?img - если фото и ?video - если видео(видео ставить как шорткод)):</label>
        <input type="text" class="form-control" name="main_photo" id="main_photo">
    </div>
    <div class="form-group">
        <label for="expert_anchor">Якорь на экспертное мнение:</label>
        <input type="text" class="form-control" name="expert_anchor" id="expert_anchor">
    </div>

    <div class="form-group">
        <label for="pcid"><i>*</i> Категория:</label>
        {{Form::select('pcid',$postsCategoriesArr,null,['id'=>'pcid','class' => 'form-control','required' => true])}}
    </div>

    <div class="form-group">
        <label for="tags">Теги:</label>
        {{Form::select('tags[]',$tagsArr,null,['id'=>'tags','class' => 'form-control','multiple'=>true])}}
    </div>

    <div class="form-group">
        <label for="lead"><i>*</i> Лид:</label>
        <textarea class="form-control" name="lead" id="lead"></textarea>
    </div>

    <div class="form-group">
        <label for="short_content"><i>*</i> Краткое описание:</label>
        <textarea class="form-control" name="short_content" id="short_content" required="true"></textarea>
    </div>

    <div class="form-group">
        <label for="thumbnail">Миниатюра записи:</label>
        <input type="text" class="form-control" name="thumbnail" id="thumbnail">
    </div>

    <div class="form-group">
        <label for="og_img">Изображение OpenGraph:</label>
        <input class="form-control" type="text" value="" name="og_img" id="og_img">
    </div>

    <?php /*
    @if(\Auth::id() == 12467)
        <div class="form-group testBox">
            <label for="contentTest">Контент:</label>
            <div>
                <button class="btn btn-default btn-xs" id="addTagP" type="button">p</button>
                <button class="btn btn-default btn-xs" id="addTagA" type="button">a</button>
                <button class="btn btn-default btn-xs" id="addTagImg" type="button">img</button> |
                <button class="btn btn-default btn-xs" id="addTagH1" type="button">h1</button>
                <button class="btn btn-default btn-xs" id="addTagH2" type="button">h2</button>
                <button class="btn btn-default btn-xs" id="addTagH3" type="button">h3</button>
                <button class="btn btn-default btn-xs" id="addTagH4" type="button">h4</button>
                <button class="btn btn-default btn-xs" id="addTagH5" type="button">h5</button>
                <button class="btn btn-default btn-xs" id="addTagH6" type="button">h6</button> |
                <button class="btn btn-default btn-xs" id="addTagB" type="button">b</button>
                <button class="btn btn-default btn-xs" id="addTagStrong" type="button">strong</button>
                <button class="btn btn-default btn-xs" id="addTagI" type="button">i</button>
                <button class="btn btn-default btn-xs" id="addTagEm" type="button">em</button>
                <button class="btn btn-default btn-xs" id="addTagS" type="button">s</button>
                <button class="btn btn-default btn-xs" id="addTagSub" type="button">sub</button>
                <button class="btn btn-default btn-xs" id="addTagSup" type="button">sup</button>
                <button class="btn btn-default btn-xs" id="addTagU" type="button">u</button> |
                <button class="btn btn-default btn-xs" id="addTagNoindex" type="button">noindex</button> |
                <button class="btn btn-default btn-xs" id="addTagDiv" type="button">div</button>
                <button class="btn btn-default btn-xs" id="addTagSpan" type="button">span</button>
                <button class="btn btn-default btn-xs" id="addTagBr" type="button">br</button>
                <button class="btn btn-default btn-xs" id="addTagHr" type="button">hr</button> |
                <button class="btn btn-default btn-xs" id="addTagIframe" type="button">iframe</button> |
                <button class="btn btn-default btn-xs" id="addTagIframeDzigurda" type="button">Джигурда для Игоря</button>
                <br>
                <button class="btn btn-default btn-xs" id="find_" type="button" disabled><i class="fa fa-search"></i> Поиск</button>
                <button class="btn btn-default btn-xs" id="replace_" type="button" disabled><i class="fa fa-replace"></i> Замена</button>
                <button class="btn btn-default btn-xs" id="createList" type="button"><i class="fa fa-list"></i> Списки</button>
                <button class="btn btn-default btn-xs" id="removeEmptyLines" type="button">Удалить пустые строки</button>
                <button class="btn btn-default btn-xs" id="clearHTML" type="button"> Очистка форматирования</button>
                <button class="btn btn-default btn-xs" id="ShorcodesListBtn" type="button"> Шорткоды</button>

            </div>


            <div class="tmpListWrap">
                <textarea name="tmpArea" id="tmpArea" cols="30" rows="10" class="form-control"></textarea>
                <p>Скопируй текст после преобразования и вставь в нужное место основного поля</p>
                <button type="button" id="listConverter">Преобразовать</button>
                <button type="button" id="hideList">Скрыть</button>
            </div>

            <div class="shorcodesListWrap">
                <button class="btn btn-default btn-xs" id="AddTestShorcode" type="button"> Тестовый шорткод</button>
                <button class="btn btn-default btn-xs" id="AddLubaShorcode" type="button"> Это люба говорит</button>
                <button class="btn btn-default btn-xs" id="addShorcodeAccordion" type="button">VZO Accordion</button>
            </div>

            <div class="lighter-wrap">
                <div class="backdrop">
                    <div class="highlights"></div>
                </div>
                <textarea class="form-control" name="contentTest" id="contentTest" contenteditable="true" rows="20"></textarea>
            </div>




            <style>

                .testBox{
                    min-height: 500px;
                }

                .tmpListWrap, .shorcodesListWrap{
                    display: none;
                }

                .highlights, textarea {
                    padding: 10px;
                    font-size: 14px;
                }

                .lighter-wrap {
                    display: block;
                    margin: 0 auto;
                    transform: translateZ(0);
                    -webkit-text-size-adjust: none;
                }

                .backdrop {
                    position: absolute;
                    z-index: 1;
                    border: 2px solid #685972;
                    background-color: #fff;
                    overflow: auto;
                    pointer-events: none;
                    transition: transform 1s;
                    width: 100%;
                }

                .highlights {
                    white-space: pre-wrap;
                    word-wrap: break-word;
                    color: transparent;
                    width: 100%;
                    height: 400px;
                }



                mark {
                    border-radius: 3px;
                    color: transparent;
                    padding: 0.12em;
                }

                mark.tag {
                    background-color: #59E575;
                }
                mark.shortcode {
                    background-color: #7e94d7;
                }


                textarea:focus, button:focus {
                    outline: none;
                    box-shadow: 0 0 0 2px #c6aada;
                }

                #contentTest{
                    display: block;
                    position: absolute;
                    z-index: 2;
                    margin: 0;
                    border: 2px solid #74637f;
                    border-radius: 0;
                    color: #444;
                    background-color: transparent;
                    overflow: auto;
                    resize: none;
                    transition: transform 1s;
                    width: 100%;
                    height: 400px;
                }

            </style>

            <script>
                (function ($, document, window, undefined) {
                    var DATANAME = 'shadonghongCaret';

                    var saveSelection =  function() {
                        if(window.getSelection) {
                            var sel = window.getSelection();
                            if(sel.rangeCount > 0) {
                                return sel.getRangeAt(0);
                            }
                        } else if(document.selection) {
                            return document.selection.createRange();
                        }
                        return null;
                    }

                    var initCursor = function(dom) {
                        $(dom).off('mouseup keyup').on('mouseup keyup', function() {
                            //selectedRange = saveSelection();
                            $(this).data(DATANAME, saveSelection());
                        });
                        $(dom).each(function() {
                            if(!$(this).hasfocus) {
                                console.log(1)
                                $(this).focus();
                                var range = saveSelection();
                                range.selectNodeContents(this);
                                range.collapse(false);
                                $(this).data(DATANAME, range);
                                $(this).blur();
                            }
                        });
                    };

                    $.initCursor = initCursor;

                    $.fn.insertAtCursor = function (text) {
                        return this.each(function () {
                            var input = this, scrollPos, strPosStart = 0, strPosEnd = 0, isModernBrowser = ("selectionStart" in input && "selectionEnd" in input), before, after, range, selection, node;

                            if (!((input.tagName && input.tagName.toLowerCase() === "textarea") || (input.tagName && input.tagName.toLowerCase() === "input" && input.type.toLowerCase() === "text"))) {

                                if(!$(input).hasfocus) {
                                    $(input).focus();
                                }

                                if (window.getSelection && window.getSelection().getRangeAt) {
                                    range = $(input).data(DATANAME) || (
                                        initCursor(input),
                                            $(input).data(DATANAME)
                                    );
                                    range.collapse(false);
                                    console.log(range);
                                    node = range.createContextualFragment(text);

                                    var c = node.lastChild;

                                    range.insertNode(node);

                                    if(c){
                                        range.setEndAfter(c);
                                        range.setStartAfter(c);
                                    }

                                    var j = window.getSelection();
                                    j.removeAllRanges();
                                    j.addRange(range);

                                } else if (document.selection && document.selection.createRange) {
                                    document.selection.createRange().pasteHTML(text);
                                }
                            }else {
                                scrollPos = input.scrollTop;

                                if (isModernBrowser) {
                                    strPosStart = input.selectionStart;
                                    strPosEnd = input.selectionEnd;
                                } else {
                                    input.focus();
                                    range = document.selection.createRange();
                                    range.moveStart('character', -input.value.length);
                                    strPosStart = range.text.length;
                                }

                                if (strPosEnd < strPosStart)
                                    strPosEnd = strPosStart;

                                before = (input.value).substring(0, strPosStart);
                                after = (input.value).substring(strPosEnd, input.value.length);
                                input.value = before + text + after;
                                strPosStart = strPosStart + text.length;

                                if (isModernBrowser) {
                                    input.selectionStart = strPosStart;
                                    input.selectionEnd = strPosStart;
                                } else {
                                    range = document.selection.createRange();
                                    range.moveStart('character', strPosStart);
                                    range.moveEnd('character', 0);
                                    range.select();
                                }

                                input.scrollTop = scrollPos;
                            }
                        });
                    };
                })(jQuery, document, window);



                $('#addTagP').click(function(){
                    $("#contentTest").insertAtCursor('<p></p>');
                    $("#contentTest").focus();
                });
                $('#addTagA').click(function(){
                    $("#contentTest").insertAtCursor('<a href="ССЫЛКА">ПОДПИСЬ</a>');
                    $("#contentTest").focus();
                });
                $('#addTagImg').click(function(){
                    $("#contentTest").insertAtCursor('<img src="ПУТЬ" alt="ПОДПИСЬ">');
                    $("#contentTest").focus();
                });

                $('#addTagH1').click(function(){
                    $("#contentTest").insertAtCursor('<h1></h1>');
                    $("#contentTest").focus();
                });

                $('#addTagH2').click(function(){
                    $("#contentTest").insertAtCursor('<h2></h2>');
                    $("#contentTest").focus();
                });

                $('#addTagH3').click(function(){
                    $("#contentTest").insertAtCursor('<h3></h3>');
                    $("#contentTest").focus();
                });

                $('#addTagH4').click(function(){
                    $("#contentTest").insertAtCursor('<h4></h4>');
                    $("#contentTest").focus();
                });

                $('#addTagH5').click(function(){
                    $("#contentTest").insertAtCursor('<h5></h5>');
                    $("#contentTest").focus();
                });

                $('#addTagH6').click(function(){
                    $("#contentTest").insertAtCursor('<h6></h6>');
                    $("#contentTest").focus();
                });

                $('#addTagB').click(function(){
                    $("#contentTest").insertAtCursor('<b></b>');
                    $("#contentTest").focus();
                });

                $('#addTagStrong').click(function(){
                    $("#contentTest").insertAtCursor('<strong></strong>');
                    $("#contentTest").focus();
                });

                $('#addTagI').click(function(){
                    $("#contentTest").insertAtCursor('<i></i>');
                    $("#contentTest").focus();
                });

                $('#addTagEm').click(function(){
                    $("#contentTest").insertAtCursor('<em></em>');
                    $("#contentTest").focus();
                });

                $('#addTagS').click(function(){
                    $("#contentTest").insertAtCursor('<s></s>');
                    $("#contentTest").focus();
                });

                $('#addTagSub').click(function(){
                    $("#contentTest").insertAtCursor('<sub></sub>');
                    $("#contentTest").focus();
                });

                $('#addTagSup').click(function(){
                    $("#contentTest").insertAtCursor('<sup></sup>');
                    $("#contentTest").focus();
                });

                $('#addTagU').click(function(){
                    $("#contentTest").insertAtCursor('<u></u>');
                    $("#contentTest").focus();
                });

                $('#addTagNoindex').click(function(){
                    $("#contentTest").insertAtCursor('<noindex></noindex>');
                    $("#contentTest").focus();
                });

                $('#addTagDiv').click(function(){
                    $("#contentTest").insertAtCursor('<div></div>');
                    $("#contentTest").focus();
                });

                $('#addTagSpan').click(function(){
                    $("#contentTest").insertAtCursor('<span></span>');
                    $("#contentTest").focus();
                });

                $('#addTagBr').click(function(){
                    $("#contentTest").insertAtCursor('<br>');
                    $("#contentTest").focus();
                });

                $('#addTagHr').click(function(){
                    $("#contentTest").insertAtCursor('<hr>');
                    $("#contentTest").focus();
                });

                $('#addTagIframe').click(function(){
                    $("#contentTest").insertAtCursor('<iframe></iframe>');
                    $("#contentTest").focus();
                });

                $('#addTagIframeDzigurda').click(function(){
                    $("#contentTest").insertAtCursor('<iframe width="868" height="488" src="https://www.youtube.com/embed/vGJN3tWDV-M" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
                    $("#contentTest").focus();
                });

                $('#removeEmptyLines').click(function(){
                    var text = $("#contentTest").val();
                    text = text.replace(/(?:(?:\r\n|\r|\n)\s*){2}/gm, "\n");
                    $("#contentTest").val(text);
                    $("#contentTest").focus();
                });

                $('#clearHTML').click(function(){
                    var text = $("#contentTest").val();
                    text = text.replace(/(<\/?\w+)(?:\s(?:[^<>/]|\/[^<>])*)?(\/?>)/gim, '$1$2');
                    $("#contentTest").val(text);
                    $("#contentTest").focus();
                });

                $('#createList').click(function(){

                    $('.tmpListWrap').toggle(200);

                });

                $('#listConverter').click(function(){
                    var text = $('#tmpArea').val();
                    var result = "<ul>\n";
                    var tmpArr = text.split(/\r?\n/);
                    for (i=0; i< tmpArr.length; i++) {
                        if(tmpArr[i] != '') {
                            result += "\t<li>" + tmpArr[i] + "</li>\n";
                        }

                    }
                    result += "<ul>\n";
                    $('#tmpArea').val(result);
                });


                $('#hideList').click(function () {
                    $('.tmpListWrap').hide(200)
                });

                $('#ShorcodesListBtn').click(function(){
                    $('.shorcodesListWrap').toggle(200);
                });


                $('#AddTestShorcode').click(function(){
                    $("#contentTest").insertAtCursor('[test param="1"]<b>Cтрашно очень страшно если бы мы знали что это такое но мы не знаем что это такое</b>[/test]');
                    $("#contentTest").focus();
                });

                $('#AddLubaShorcode').click(function(){
                    $("#contentTest").insertAtCursor('[luba]<b>Довольно таки неплохо мне очень нравится между прочим</b>[/luba]');
                    $("#contentTest").focus();
                });

                $('#addShorcodeAccordion').click(function(){
                    $("#contentTest").insertAtCursor('[vsezaimy_accordion][vsezaimy_accordion_item title="Название кнопки аккордиона"]Скрытый текст аккордиона[/vsezaimy_accordion_item][/vsezaimy_accordion]');
                    $("#contentTest").focus();
                });




            </script>


            <script>
                var $container = $('.lighter-wrap');
                var $backdrop = $('.backdrop');
                var $highlights = $('.highlights');
                var $textarea = $('#contentTest');

                // yeah, browser sniffing sucks, but there are browser-specific quirks to handle that are not a matter of feature detection
                var ua = window.navigator.userAgent.toLowerCase();
                var isIE = !!ua.match(/msie|trident\/7|edge/);
                var isWinPhone = ua.indexOf('windows phone') !== -1;
                var isIOS = !isWinPhone && !!ua.match(/ipad|iphone|ipod/);

                function applyHighlights(text) {
                    text = text
                        //.replace(/\n$/g, '\n\n')
                        .replace(/\</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/&lt;[^&g\t;]{1,500}&gt;/gim, '<mark class="tag">$&</mark>')
                        .replace(/\[[^\[]{1,500}\]/gim, '<mark class="shortcode">$&</mark>');

                    if (isIE) {
                        // IE wraps whitespace differently in a div vs textarea, this fixes it
                        text = text.replace(/ /g, ' <wbr>');
                    }

                    return text;
                }

                function handleInput() {
                    var text = $textarea.val();
                    var highlightedText = applyHighlights(text);
                    $highlights.html(highlightedText);
                }

                function handleScroll() {
                    var scrollTop = $textarea.scrollTop();
                    $backdrop.scrollTop(scrollTop);

                    var scrollLeft = $textarea.scrollLeft();
                    $backdrop.scrollLeft(scrollLeft);
                }

                function fixIOS() {
                    // iOS adds 3px of (unremovable) padding to the left and right of a textarea, so adjust highlights div to match
                    $highlights.css({
                        'padding-left': '+=3px',
                        'padding-right': '+=3px'
                    });
                }

                function bindEvents() {
                    $textarea.on({
                        'input': handleInput,
                        'scroll': handleScroll
                    });

                }

                if (isIOS) {
                    fixIOS();
                }

                bindEvents();
                handleInput();

            </script>
        </div>
    @endif
            */ ?>


    <div class="form-group">
        <label for="content">Контент:</label>
        <textarea class="form-control" name="content" id="content"></textarea>
    </div>

    <div class="form-group">
        <label for="infographic">Инфографика:</label>
        <input type="text" class="form-control" name="infographic" id="infographic">
    </div>

    <div class="form-group">
        <label for="show_in_slider">Показывать в слайдере:</label>
        {{Form::select('show_in_slider',['1'=>'Показывать','0'=>'Скрыть'],0,['id'=>'show_in_slider','class' => 'form-control'])}}
    </div>


    <div class="form-group">
        <label for="author_id">Автор:</label>
        {{Form::select('author_id',$authorsArr,null,['id'=>'author_id','class' => 'form-control'])}}
    </div>
    <div class="form-group">
        <label for="individual_signature">Индивидуальная подпись</label>
        <textarea class="form-control" name="individual_signature" id="individual_signature"></textarea>
    </div>
    <div class="form-group">
        <label for="the_author_answers">Автор отвечает:</label>
        {{Form::select('the_author_answers',['1'=>'Да','0'=>'Нет'],0,['id'=>'the_author_answers','class' => 'form-control'])}}
    </div>

    <div class="form-group">
        <label for="date">Дата публикации:</label>
        <input type="date" class="form-control" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" />
    </div>

    <div class="form-group">
        <label for="time_pub">Время публикации:</label>
        <input type="time" class="form-control" name="time_pub" id="time_pub" value="<?php echo date('h:i'); ?>" />
    </div>

    <div class="form-group">
        <label for="meta_description">Мета - описание:</label>
        <textarea class="form-control" name="meta_description" id="meta_description"></textarea>
    </div>

    <div class="form-group">
        <label for="related">Читайте также:</label>
        {{Form::select('related[]',$postsArr,null,['id'=>'related','class' => 'form-control','multiple'=>true])}}
        <style type="text/css">
        .select2-container--default .select2-selection--multiple .select2-selection__choice{color: #242628}
        </style>
    </div>

    <div class="form-group">
        <label for="valid_until">Действует до:</label>
        <input type="date" class="form-control" name="valid_until" id="valid_until" value="" />
    </div>


    <div class="form-group">
        <label for="studied_the_topic">Изучали тему:</label>
        <input type="text" class="form-control" name="studied_the_topic" id="studied_the_topic" value="" />
    </div>

    <div class="form-group">
        <label for="read_the_sources">Прочитали источников:</label>
        <input type="text" class="form-control" name="read_the_sources" id="read_the_sources" value="" />
    </div>

    <div class="form-group">
        <label for="write_articles">Писали статью:</label>
        <input type="text" class="form-control" name="write_articles" id="write_articles" value="" />
    </div>



    <div class="form-group">
        <label for="table_of_contents">Содержимое для сайдбара (Разделители - ":" и новая строка):</label>
        <textarea rows="10" class="form-control" name="table_of_contents" id="table_of_contents"></textarea>
    </div>

    <div class="form-group">
        <?php
        $selected_item = isset($item) ? $item->company_id : null;
        ?>
        <label for="company_id">Компания:</label>
        {{Form::select('company_id',$companiesArr,$selected_item,['id'=>'company_id','class'=>'form-control'])}}
    </div>

    <div class="form-group">
        <label for="bank_id">Банк</label>
        <?php
        $current_bank = old('bank_id')
            ? old('bank_id')
            : (isset($item) ? $item->bank_id : null);
        ?>
        {!! Form::select('bank_id',$banksArr,$current_bank,['id'=>'bank_id','class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="pinned">Закрепленная:</label>
        {{Form::select('pinned',['1'=>'Закреплена','0'=>'Не закреплена'],1,['id'=>'pinned','class' => 'form-control'])}}
    </div>

    <div class="form-group">
        <label for="status">Статус:</label>
        {{Form::select('status',['1'=>'Включена','0'=>'Выключена'],1,['id'=>'status','class' => 'form-control'])}}
    </div>

    <a href="/content-preview" target="_blank" id="showContentPreview" class="btn btn-default">Предварительный просмотр</a>
    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-floppy-o"></i> Добавить</button>
</form>

<div class="clearfix"></div>

<?php /*
<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>
*/ ?>
<!-- <script src="https://cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script> -->
<script>
    window.CKEDITOR_selector = 'content';
    $(document).ready(function() {
        //tInit('#content');
        $('#tags').select2();
        $('#related').select2();
        $('#company_id').select2();
        $('#bank_id').select2();
    });
</script>
<script src="/admin-assets/ckeditor/ckeditor.js"></script>
<script src="/admin-assets/ckeditor/config.js"></script>

<script>

    $('#showContentPreview').click(function(e){

        var content = CKEDITOR.instances['content'].getData();
        //var content = $("#cke_content").val();
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: '/admin/content-preview',
            data: {'_token': token, 'content' : content}
        });

        return true;
    });
</script>


@stop
