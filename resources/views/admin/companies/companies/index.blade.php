@extends ('admin.layouts.app')
@section ('title', 'Список компаний')
@section('h1','Список компаний')
    

@section('content')
<a href="{{ route('admin.companies.create') }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить компанию</a>
<br>
<br>

<table id="rowtbl" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>h1</th>
        <th>URL</th>
        <th>Категория</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($companies as $company)
            <tr>
                <td>{{ $company->id }}</td>
                <td>{{ $company->h1 }}</td>
                <td>{{ $company->alias }}</td>
                <td>{{ $company->card_category_id }}</td>
                <td>@if($company->status) <span class="label label-success">Активна</span> @else <span class="label label-warning">Отключена</span>@endif</td>
                <td>
                    <a href="/mfo/{{$company->alias}}" class="btn btn-info btn-xs" title="Перейти" target="_blank"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('admin.companies.edit', $company->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" class="inline">
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                        <button class="btn btn-danger btn-xs rest-destroy" title="Удалить"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="clearfix"></div>
     
@stop

