@extends ('admin.layouts.app')
@section ('title', 'Редактирование категории записей - #'.$row->id)
@section ('h1', 'Редактирование категории записей - #'.$row->id)
@section('content')

@if(isset($url[0]))
<a class="btn btn-default btn-xs" href="/{{$url[0]->url}}" target="_blank"><i class="fa fa-eye"></i> {{url('/')}}/{{$url[0]->url}}</a>
@else
<p class="alert alert-warning">Внимание! Для данной категории не удалось получить ссылку. <br>Попробуйте пересохранить Категорию. Если проблема не изчезнет: удалите категорию и создайте заново.</p>
@endif
<br><br>


<form action="/admin/posts/categories/edit_save" method="post">
    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
    <input type="hidden" name="id" value="{{ $row->id }}">

    <div class="form-group">
        <label for="title"><i>*</i> Title:</label>
        <input type="text" class="form-control" name="title" id="title" required="true" value="{{ $row->title }}">
    </div>

    <div class="form-group">
        <label for="h1"><i>*</i> H1:</label>
        <input type="text" class="form-control" name="h1" id="h1" required="true" value="{{ $row->h1 }}">
    </div>  

    <div class="form-group">
        <label for="alias"><i>*</i> Постоянная ссылка:</label> <span class="btn btn-default btn-xs translate"><i class="fa fa-language"></i></span>
        <input type="text" class="form-control" name="alias_category" id="alias" required="true" value="{{ $row->alias_category }}">
    </div>

    <div class="form-group">
        <label for="breadcrumbs">Хлебные крошки:</label>
        <textarea class="form-control" name="breadcrumbs" id="breadcrumbs">{{$row->breadcrumbs}}</textarea>
    </div>

    <div class="form-group">
        <label for="text">Контент:</label>
        <textarea class="form-control" name="text" id="text">{{$row->text}}</textarea>
    </div>

    <div class="form-group">
        <label for="meta_description">Мета - описание:</label>
        <textarea class="form-control" name="meta_description" id="meta_description">{{$row->meta_description}}</textarea>
    </div>

    <div class="form-group">
        <label for="show_date_publish_in_posts">Выводить дату публикации в записях:</label>
        {{Form::select('show_date_publish_in_posts',[1=>'Да',0=>'Нет'],$row->show_date_publish_in_posts,['id'=>'show_date_publish_in_posts','class' => 'form-control'])}}
    </div>

    <div class="form-group">
        <label for="show_author_in_posts">Выводить автора в записях:</label>
        {{Form::select('show_author_in_posts',[1=>'Да',0=>'Нет'],$row->show_author_in_posts,['id'=>'show_author_in_posts','class' => 'form-control'])}}
    </div>

    <div class="form-group">
        <label for="show_comments_in_posts">Выводить комментарии в записях:</label>
        {{Form::select('show_comments_in_posts',[1=>'Да',0=>'Нет'],$row->show_comments_in_posts,['id'=>'show_comments_in_posts','class' => 'form-control'])}}
    </div>


    <div class="form-group">
        <label for="sidebar_menu">Привязка к сайдбару:</label>
        {{Form::select('sidebar_menu',[0 => 'Не привязано', 1 => 'Новости', 2 => 'Статьи', 3 => 'Бизнес'],$row->sidebar_menu,['id'=>'sidebar_menu','class' => 'form-control'])}}
    </div>

    <div class="form-group">
        <label for="sidebar_order">Порядок в сайдбаре:</label>
        <input class="form-control" type="number" min="-10000" max="100000" step="1" value="{{$row->sidebar_order}}" id="sidebar_order" name="sidebar_order">
    </div>

    <div class="form-group">
        <label for="short_name">Кратное название рубрики:</label>
        <input type="text" class="form-control" name="short_name" id="short_name" value="{{$row->short_name}}">
    </div>

    <div class="form-group">
        <label for="icon">Иконка рубрики:</label>
        <input type="text" class="form-control" name="icon" id="icon" value="{{$row->icon}}">
    </div>


    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-refresh"></i> Обновить</button>
</form>

<div class="clearfix"></div>


<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>
<script>
tInit('#text');
</script>


@stop
