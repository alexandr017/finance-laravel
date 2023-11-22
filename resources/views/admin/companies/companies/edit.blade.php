@extends ('admin.layouts.app')
@section ('title', 'Редактирование страницы организации')
@section ('h1', 'Редактирование страницы организации')

@section('content')
    <a href="{{ route('admin.companies.children.index', $company->id) }}" class="btn btn-success btn-xs">Дочерние страницы компании</a>
    <a href="{{ route('admin.companies.reviews_by_company', $company->id) }}" class="btn btn-success btn-xs">Отзывы компании</a>

    <br><br>

    <form method="POST" action="{{ route('admin.companies.update', $company->id) }}">
        {{ method_field('PATCH') }}
        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.companies.companies._form')

        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-refresh"></i> Обновить</button>
    </form>

    <div class="clearfix"></div>
@stop


