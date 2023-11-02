@extends ('admin.layouts.app')
@section ('title', 'Редактирование категории карточек - #'.$cardsCategories->id)
@section('h1','Редактирование категории карточек - #'.$cardsCategories->id)

@section('content')

<a href="/admin/cards/listings/?category_id={{$cardsCategories->id}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Дочерние листинги</a>
<br>
<br>



<form method="POST" action="/admin/cards/categories/edit_save">
    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
    <input type="hidden" name="id"  value="{{$cardsCategories->id}}">

    <div class="form-group">
        <label for="title"><i>*</i> Title:</label>
        <input class="form-control" type="text" name="title" value="{{$cardsCategories->title}}" id="title" required="true">
    </div>
    <div class="form-group">
        <label for="h1"><i>*</i> H1:</label>
        <input class="form-control" type="text" value="{{$cardsCategories->h1}}" name="h1" id="h1" required="true">
    </div>
    <div class="form-group">
        <label for="alias"><i>*</i> Постоянная ссылка:</label> <span class="btn btn-default btn-xs translate"><i class="fa fa-language"></i></span>
        <input class="form-control" type="text" value="{{$cardsCategories->alias}}" name="alias" id="alias">
    </div>
    <div class="form-group">
        <label for="h2">H2:</label>
        <input class="form-control" type="text" value="{{$cardsCategories->h2}}" name="h2" id="h2">
    </div>
    <div class="form-group">
        <label for="breadcrumb">Хлебные крошки:</label>
        <input class="form-control" type="text" name="breadcrumb" id="breadcrumb" placeholder="Унаследовать от 'h1'" value="{{$cardsCategories->breadcrumb}}">
    </div>
    <div class="form-group">
        <label for="img"><i>*</i> Изображение:</label>
        <input class="form-control" type="text" value="{{$cardsCategories->img}}" name="img" id="img" required="true">
    </div>
    <div class="form-group">
        <label for="og_img">Изображение OpenGraph:</label>
        <input class="form-control" type="text" value="{{$cardsCategories->og_img}}" name="og_img" id="og_img">
    </div>
    <div class="form-group">
        <label for="infographic">Идентификатор инфографики:</label>
        <input class="form-control" type="text" value="{{$cardsCategories->infographic}}" name="infographic" id="infographic">
    </div>    
    <div class="form-group">
        <label for="text_before">Текст перед карточками:</label>
        <textarea  class="form-control" type="text" name="text_before" id="text_before">{{$cardsCategories->text_before}}</textarea>
    </div>
    <div class="form-group">
        <label for="text_after">Текст после карточек:</label>
        <textarea  class="form-control" type="text" name="text_after" id="text_after">{{$cardsCategories->text_after}}</textarea>
    </div>
    <div class="form-group">
        <label for="city">Страница со списком городов:</label>
        {{Form::select('city',['0'=>'Отключена',1=>'Включена'],$cardsCategories->city,['class'=>'form-control','id'=>'city'])}}
    </div>
    <div class="form-group">
        <label for="meta_description">Мета - описание:</label>
        <textarea class="form-control" type="text" name="meta_description" id="meta_description">{{$cardsCategories->meta_description}}</textarea>
    </div>

    <div class="form-group">
        <label for="icon_for_sidebar">Иконка для сайбара банков:</label>
        <input class="form-control" type="text" name="icon_for_sidebar" id="icon_for_sidebar" value="{{$cardsCategories->icon_for_sidebar}}">
    </div>

    <div class="form-group">
        <label for="popular_banks">Популярные банки через запятую (111,44,55):</label>
        <input class="form-control" type="text" name="popular_banks" id="popular_banks" value="{{$cardsCategories->popular_banks}}">
    </div>

    <div class="form-group">
        <label for="links_for_sidebar">Ссылки на популярные банки:</label>
        <textarea class="form-control" name="links_for_sidebar" id="links_for_sidebar">{{$cardsCategories->links_for_sidebar}}</textarea>
    </div>

    <div class="form-group">
        <label for="card_categories">Список ID категорий для карточек (через запятую):</label>
        <input class="form-control" type="text" value="{{$cardsCategories->card_categories}}" name="card_categories" id="card_categories">
    </div>

    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-refresh"></i> Обновить</button>

</form>

<div class="clearfix"></div>

<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>
<script>
tInit('#text_before');
tInit('#text_after');
</script>

@stop
