@extends('admin.layouts.app')
@section('title', 'Список информационных страниц банка')
@section('h1', 'Список информационных страниц банка')

@section('content')

<a href="{{route('admin.banks.info-pages.create', $bankID)}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить страницу</a>
<br>
<br>

<table id="rowtbl" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>h1</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($items as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->h1 }}</td>
        <td>@if($item->status) <span class="badge badge-success">Включена</span> @else <span class="badge badge-warning">Отключена</span>@endif</td>
        <td>
            <?php if($item->pageAlias == 'gorjachaja-linija') $item->pageAlias = 'hotline'; ?>
            <a href="/banks/{{ $item->bankAlias }}/{{ $item->pageAlias }}" target="_blank" class="btn btn-info btn-xs" title="Открыть"><i class="fa fa-eye"></i></a>
            <a href="{{route('admin.banks.info-pages.edit', [$bankID, $item->id]) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
            <form action="{{ route('admin.banks.info-pages.destroy', [$bankID, $item->id]) }}" method="post" class="inline">
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

@endsection
