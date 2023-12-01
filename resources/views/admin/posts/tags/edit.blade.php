@extends ('admin.layouts.app')
@section ('title', 'Редактирование тегов для записей')
@section ('h1', 'Редактирование тегов для записей')

@section('content')

    <form action="{{ route('admin.posts.tags.update',$item->id) }}" method="post">

        {{ method_field('PATCH') }}

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.posts.tags._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop
