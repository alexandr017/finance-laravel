@extends ('admin.layouts.app')
@section ('title', 'Редактирование дочерней страницы компании ' . $company->breadcrumb)
@section('h1','Редактирование дочерней страницы компании ' . $company->breadcrumb)

@section('content')
    <form method="POST" action="{{ route('admin.children.update', $childrenPage->id) }}">
        {{ method_field('PATCH') }}
        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.companies.children_pages._form')

        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-refresh"></i> Обновить</button>
    </form>

    <div class="clearfix"></div>
@stop
