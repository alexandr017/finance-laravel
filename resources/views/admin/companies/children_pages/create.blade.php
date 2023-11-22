@extends ('admin.layouts.app')
@section ('title', 'Создание дочерней страницы компании ' . $company->breadcrumb)
@section('h1', 'Создание дочерней страницы компании ' . $company->breadcrumb)

@section('content')

    <form method="POST" action="{{ route('admin.companies.children.store', $company->id) }}">
        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.companies.children_pages._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-floppy-o"></i> Добавить</button>
    </form>

    <div class="clearfix"></div>
@stop
