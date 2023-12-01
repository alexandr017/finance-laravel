@extends ('admin.layouts.app')
@section ('title', 'Редактирование комментария - #'.$postComments->id)
@section ('h1', 'Редактирование комментария - #'.$postComments->id)
@section('content')


<p class="alert alert-info">Заполните имя и email автора или выберите пользователя.</p>

<link href="/admin-assets/select2/select2.min.css" rel="stylesheet" />
<script src="/admin-assets/select2/select2.min.js"></script>

<form action="{{ route('admin.posts.comments.update', $postComments) }}" method="POST">

    {{ method_field('PATCH') }}

    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

    @include('admin.posts.comments._form')

    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-refresh"></i> Обновить</button>
</form>

<div class="clearfix"></div>

<script type="text/javascript">
$(document).ready(function() {
    $('#pid').select2();
    $('#uid').select2();
});
</script>

@stop
