@extends ('admin.layouts.app')
@section ('title', 'Редактирование автора - #'.$author->id)
@section ('h1', 'Редактирование автора - #'.$author->id)
@section('content')

<form action="{{ route('admin.posts.authors.update', $author) }}" method="POST">

    {{ method_field('PATCH') }}

    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

    @include('admin.posts.authors._form')

    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-refresh"></i> Обновить</button>
</form>


<div class="clearfix"></div>

<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>
<script>
    tInit('#content');
</script>

@stop
