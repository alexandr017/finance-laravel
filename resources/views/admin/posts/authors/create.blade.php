@extends ('admin.layouts.app')
@section ('title', 'Создание автора')
@section ('h1', 'Создание автора')
@section('content')

<form action="{{ route('admin.posts.authors.store') }}" method="POST">
    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

    @include('admin.posts.authors._form')

    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-floppy-o"></i> Добавить</button>
</form>


<div class="clearfix"></div>

<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>
<script>
    tInit('#content');
</script>
@stop
