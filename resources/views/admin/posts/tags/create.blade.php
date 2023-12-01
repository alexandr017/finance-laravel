@extends ('admin.layouts.app')
@section ('title', 'Создание тега для записей')
@section ('h1', 'Создание тега для записей')

@section('content')
<form action="{{ route('admin.posts.tags.store')}}" method="post">

    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

    @include('admin.posts.tags._form')

    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

</form>

<div class="clearfix"></div>
<br>
@stop

