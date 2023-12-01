@extends ('admin.layouts.app')
@section ('title', 'Редактирование записи - #'.$post->id)
@section ('h1', 'Редактирование записи - #'.$post->id)
@section('content')

@if(isset($url[0]))
<a class="btn btn-default btn-xs" href="/{{$url[0]->url}}" target="_blank"><i class="fa fa-eye"></i> {{url('/')}}/{{$url[0]->url}}</a>
@else
<p class="alert alert-warning">Внимание! Для данной записи не удалось получить ссылку. <br>Попробуйте пересохранить запись. Если проблема не изчезнет: удалите запись и создайте заново.</p>
@endif

<a href="/admin/posts/posts/edit/{{$post->id}}/comments" class="btn btn-primary btn-xs"><i class="fa fa-commenting-o"></i> Комментарии к данной записи</a><br><br>

<link href="/admin-assets/select2/select2.min.css" rel="stylesheet" />
<script src="/admin-assets/select2/select2.min.js"></script>

<form action="/admin/posts/posts/edit_save" method="post">
    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
    <input type="hidden" name="id" value="{{$post->id}}">

    <div class="form-group">
        <label for="title"><i>*</i> Title:</label>
        <input type="text" class="form-control" name="title" id="title" required="true" value="{{$post->title}}">
    </div>

    <div class="form-group">
        <label for="h1"><i>*</i> H1:</label>
        <input type="text" class="form-control" name="h1" id="h1" required="true" value="{{$post->h1}}">
    </div>

    <div class="form-group">
        <label for="h1_in_category">Заголовок на странице категорий:</label>
        <input type="text" class="form-control" name="h1_in_category" id="h1_in_category" value="{{$post->h1_in_category}}">
    </div>

    <div class="form-group">
        <label for="alias"><i>*</i> Постоянная ссылка:</label> <span class="btn btn-default btn-xs translate"><i class="fa fa-language"></i></span>
        <input type="text" class="form-control" name="alias" id="alias" required="true" value="{{$post->alias}}">
    </div>

    <div class="form-group">
        <label for="breadcrumb">Хлебные крошки:</label>
        <textarea class="form-control" name="breadcrumb" id="breadcrumb">{{$post->breadcrumb}}</textarea>
    </div>
    <div class="form-group">
        <label for="main_photo">Главное фото(в конце пути ставить ?img - если фото и ?video - если видео(видео ставить как шорткод)):</label>
        <input type="text" class="form-control" name="main_photo" id="main_photo" value="{{$post->main_photo}}">
    </div>
    <div class="form-group">
        <label for="expert_anchor">Якорь на экспертное мнение:</label>
        <input type="text" class="form-control" name="expert_anchor" id="expert_anchor" value="{{$post->expert_anchor}}">
    </div>

    <div class="form-group">
        <label for="tags">Теги:</label>
        {{Form::select('tags[]',$tagsArr,$tagsSelectedArr,['id'=>'tags','class' => 'form-control','multiple'=>true])}}
    </div>

    <div class="form-group">
        <label for="pcid"><i>*</i> Категория:</label>
        {{Form::select('pcid',$postsCategoriesArr, $post->pcid,['id'=>'pcid','class' => 'form-control','required' => true])}}
    </div>

    <div class="form-group">
        <label for="lead"><i>*</i> Лид:</label>
        <textarea class="form-control" name="lead" id="lead">{{$post->lead}}</textarea>
    </div>

    <div class="form-group">
        <label for="short_content"><i>*</i> Краткое описание:</label>
        <textarea class="form-control" name="short_content" id="short_content" required="true">{{$post->short_content}}</textarea>
    </div>

    <div class="form-group">
        <label for="thumbnail">Миниатюра записи:</label>
        <input type="text" class="form-control" name="thumbnail" id="thumbnail" value="{{$post->thumbnail}}">
    </div>

    <div class="form-group">
        <label for="og_img">Изображение OpenGraph:</label>
        <input class="form-control" type="text" value="{{$post->og_img}}" name="og_img" id="og_img">
    </div>

    <div class="form-group">
        <label for="content">Контент:</label>
        <textarea class="form-control" name="content" id="content">{{$post->content}}</textarea>
    </div>

    <div class="form-group">
        <label for="infographic">Инфографика:</label>
        <input type="text" class="form-control" name="infographic" id="infographic" value="{{$post->infographic}}">
    </div>

    <div class="form-group">
        <label for="show_in_slider">Показывать в слайдере:</label>
        {{Form::select('show_in_slider',['1'=>'Показывать','0'=>'Скрыть'],$post->show_in_slider,['id'=>'show_in_slider','class' => 'form-control'])}}
    </div>

    <div class="form-group">
        <label for="author_id">Автор:</label>
        {{Form::select('author_id',$authorsArr,$post->author_id,['id'=>'author_id','class' => 'form-control'])}}
    </div>
    <div class="form-group">
        <label for="individual_signature">Индивидуальная подпись</label>
        <textarea class="form-control" name="individual_signature" id="individual_signature">{{$post->individual_signature}}</textarea>
    </div>
    <div class="form-group">
        <label for="the_author_answers">Автор отвечает:</label>
        {{Form::select('the_author_answers',['1'=>'Да','0'=>'Нет'],$post->the_author_answers,['id'=>'the_author_answers','class' => 'form-control'])}}
    </div>

    <div class="form-group">
        <label for="date">Дата публикации:</label>
        <input type="date" class="form-control" name="date" id="date" value="<?php echo str_replace(' 00:00:00','',$post->date) ?>">
    </div>



    <div class="form-group">
        <label for="related">Читайте также:</label>
        <?php
            $related = null;
            if(($post->related != '0') && ($post->related != '')){
                $related = explode(',',$post->related);
                if(count($related)>0){
                    foreach ($related as $key => $value) {
                        $related[$key] = (int) $value;
                    }
                }
            }
        ?>

        {{Form::select('related[]',$postsArr,$related,['id'=>'related','class' => 'form-control','multiple'=>true])}}
        <style type="text/css">
        .select2-container--default .select2-selection--multiple .select2-selection__choice{color: #242628}
        </style>
    </div>

    @if(\Auth::id() == 12467)
    <div class="form-group">
        <label for="time_pub">Время публикации:</label>
        <input type="time" class="form-control" name="time_pub" id="time_pub" value="{{$post->time_pub}}" />
    </div>
    @endif

    <div class="form-group">
        <label for="meta_description">Мета - описание:</label>
        <textarea class="form-control" name="meta_description" id="meta_description">{{$post->meta_description}}</textarea>
    </div>

    <div class="form-group">
        <label for="valid_until">Действует до:</label>
        @if($post->valid_until != null)
        <input type="date" class="form-control" name="valid_until" id="valid_until" value="<?php echo str_replace(' 00:00:00','',$post->valid_until) ?>" />
        @else
        <input type="date" class="form-control" name="valid_until" id="valid_until" value="" />
        @endif
    </div>


    <div class="form-group">
        <label for="studied_the_topic">Изучали тему:</label>
        @if($post->studied_the_topic != null)
        <input type="text" class="form-control" name="studied_the_topic" id="studied_the_topic" value="{{$post->studied_the_topic}}" />
        @else
        <input type="text" class="form-control" name="studied_the_topic" id="studied_the_topic" value="" />
        @endif
    </div>

    <div class="form-group">
        <label for="read_the_sources">Прочитали источников:</label>
        @if($post->read_the_sources != null)
        <input type="text" class="form-control" name="read_the_sources" id="read_the_sources" value="{{$post->read_the_sources}}" />
        @else
        <input type="text" class="form-control" name="read_the_sources" id="read_the_sources" value="" />
        @endif
    </div>

    <div class="form-group">
        <label for="write_articles">Писали статью:</label>
        @if($post->write_articles != null)
        <input type="text" class="form-control" name="write_articles" id="write_articles" value="{{$post->write_articles}}" />
        @else
        <input type="text" class="form-control" name="write_articles" id="write_articles" value="" />
        @endif
    </div>


    <div class="form-group">
        <label for="table_of_contents">Содержимое для сайдбара (Разделители - ":" и новая строка):</label>
        <textarea rows="10" class="form-control" name="table_of_contents" id="table_of_contents">{{$post->table_of_contents}}</textarea>
    </div>

    <div class="form-group">
        <?php
        $selected_item = isset($post) ? $post->company_id : null;
        ?>
        <label for="company_id">Компания:</label>
        {{Form::select('company_id',$companiesArr,$selected_item,['id'=>'company_id','class'=>'form-control'])}}
    </div>


    <div class="form-group">
        <label for="bank_id">Банк</label>
        <?php
        $current_bank = old('bank_id')
            ? old('bank_id')
            : (isset($post) ? $post->bank_id : null);
        ?>
        {!! Form::select('bank_id',$banksArr,$current_bank,['id'=>'bank_id','class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="pinned">Закрепленная:</label>
        {{Form::select('pinned',['1'=>'Закреплена','0'=>'Не закреплена'],$post->pinned,['id'=>'pinned','class' => 'form-control'])}}
    </div>

    <div class="form-group">
        <label for="status">Статус:</label>
        {{Form::select('status',['1'=>'Включена','0'=>'Выключена'],$post->status,['id'=>'status','class' => 'form-control'])}}
    </div>

    <a href="/content-preview" target="_blank" id="showContentPreview" class="btn btn-default">Предварительный просмотр</a>
    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-refresh"></i> Обновить</button>
</form>

@if(count($postsUpdates) != 0)
<div style="clear: both;border: 1px solid #bec5cc;margin-top: 70px;padding: 10px;">
    <h4>Последние редакции:</h4>
    <ul>
    @foreach($postsUpdates as $item)
        <li>{{$item->first_name}} {{$item->last_name}} - {{$item->created_at}}</li>
    @endforeach
    </ul>
</div>
@endif

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
