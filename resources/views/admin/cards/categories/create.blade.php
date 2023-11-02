@extends ('admin.layouts.app')
@section ('title', 'Создание категории карточек')
@section('h1','Создание  категории карточек')

@section('content')


<div class="alert alert-info" role="alert"><p>Внимние! Если URL alias категории совпадает с адресом главной страницы, СЕО-теги стоит задавать в <a href="/admin/options/index_page">данном разделе.</a></p></div>

<form method="POST" action="/admin/cards/categories/create_save">
    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

    <div class="form-group">
        <label for="title"><i>*</i> Title:</label>
        <input class="form-control" type="text" name="title" value="" id="title" required="true">
    </div>
    <div class="form-group">
        <label for="h1"><i>*</i> H1:</label>
        <input class="form-control" type="text" value="" name="h1" id="h1" required="true">
    </div>
    <div class="form-group">
        <label for="alias"><i>*</i> Постоянная ссылка:</label> <span class="btn btn-default btn-xs translate"><i class="fa fa-language"></i></span>
        <input class="form-control" type="text" value="" name="alias" id="alias" required="true">
    </div>
    <div class="form-group">
        <label for="h2">H2:</label>
        <input class="form-control" type="text" value="" name="h2" id="h2">
    </div>
    <div class="form-group">
        <label for="breadcrumb">Хлебные крошки:</label>
        <input class="form-control" type="text" value="" name="breadcrumb" id="breadcrumb" placeholder="Унаследовать от 'h1'">
    </div>
    <div class="form-group">
        <label for="img"><i>*</i> Изображение:</label>
        <input class="form-control" type="text" value="" name="img" id="img" required="true">
    </div>
    <div class="form-group">
        <label for="og_img">Изображение OpenGraph:</label>
        <input class="form-control" type="text" value="" name="og_img" id="og_img">
    </div>
    <div class="form-group">
        <label for="infographic">Идентификатор инфографики:</label>
        <input class="form-control" type="text" value="#" name="infographic" id="infographic">
    </div>
    <div class="form-group">
        <label for="text_before">Текст перед карточками:</label>
        <textarea  class="form-control" type="text" value="" name="text_before" id="text_before"></textarea>
    </div>
    <div class="form-group">
        <label for="text_after">Текст после карточек:</label>
        <textarea  class="form-control" type="text" value="" name="text_after" id="text_after"></textarea>
    </div>
    <div class="form-group">
        <label for="city">Страница со списком городов:</label>
        {{Form::select('city',['0'=>'Отключена',1=>'Включена'],0,['class'=>'form-control','id'=>'city'])}}
    </div>
    <div class="form-group">
        <label for="meta_description">Мета - описание:</label>
        <textarea class="form-control" name="meta_description" id="meta_description"></textarea>
    </div>


    <div class="form-group">
        <label for="icon_for_sidebar">Иконка для сайбара банков:</label>
        <input class="form-control" type="text" name="icon_for_sidebar" id="icon_for_sidebar">
    </div>

    <div class="form-group">
        <label for="popular_banks">Популярные банки через запятую (111,44,55):</label>
        <input class="form-control" type="text" name="popular_banks" id="popular_banks">
    </div>
    
    <div class="form-group">
        <label for="links_for_sidebar">Ссылки на популярные банки:</label>
        <textarea class="form-control" name="links_for_sidebar" id="links_for_sidebar"></textarea>
    </div>

    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-floppy-o"></i> Создать</button>

</form>

<div class="clearfix"></div>

<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>
<script>
tInit('#text_before');
tInit('#text_after');
</script>

@stop
