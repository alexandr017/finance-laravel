@extends ('admin.layouts.app')
@section ('title', 'Редактирование банка')
@section ('h1', 'Редактирование банка')

@section('content')

    <a href="{{route('admin.banks.categories.index', [$item->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Список категорийных страниц</a>
    <a href="{{route('admin.banks.info-pages.index', [$item->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Список информационных страниц</a>
    <br>
    <br>
    
    <form action="{{ route('admin.banks.banks.update',$item->id) }}" method="post">

        {{ method_field('PATCH') }}

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.banks.bank._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop
