@extends ('admin.layouts.app')
@section ('title', 'Редактирование страницы отзывов категорийной страницы для банка')
@section ('h1', 'Редактирование страницы отзывов категорийной страницы для банка')

@section('content')

<form action="{{ route('admin.banks.categories.reviews.update',[$bankID, $parentPageID]) }}" method="post">

    {{ method_field('POST') }}

    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

    @include('admin.includes.partials.seo-fields-without-url')

    <div class="form-group">
        <label for="content">Контент <span class="input_counter"></span></label>
        <?php
        $content = old('content')
            ? old('content')
            : (isset($item) ? $item->content : '');
        ?>
        <textarea class="form-control" name="content" id="content">{{$content}}</textarea>
    </div>


    <div class="form-group">
        <label for="status"><i class="red">*</i> Статус</label>
        <?php
        $current_status = old('status')
            ? old('status')
            : (isset($item) ? $item->status : 1);
        ?>
        {!! Form::select('status',[0 => 'Выключено', 1 => 'Включено'],$current_status,['id'=>'status','class' => 'form-control','required' => true]) !!}
    </div>


    <script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="/admin-assets/tinymce/wysiwyg.js"></script>
    <script>
        tInit('#content');
    </script>

    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

</form>

<div class="clearfix"></div>
<br>
@stop
