@extends('admin.layouts.app')
@section('title', 'Список всех отзывов для банков')
@section('h1', 'Список всех отзывов для банков')

@section('content')

<table id="rowtbl" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>Банк</th>
        <th>Категория</th>
        <th>Имя</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($items as $item)
        <? $item->bankCategoryID = $item->bankCategoryID == null ? 0 : $item->bankCategoryID  ?>
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->bankName }}</td>
        <td>{{ $item->bankCategoryH1 }}</td>
        <td>{{ $item->author }}</td>
        <td>@if($item->status) <span class="badge badge-success">Включена</span> @else <span class="badge badge-warning">Отключена</span>@endif</td>
        <td>
            <a href="{{route('admin.banks.reviews.edit', [$item->bankID ?? 0, $item->bankCategoryID ?? 0, $item->id ?? 0]) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
            <form action="{{ route('admin.banks.reviews.destroy', [$item->bankID ?? 0, $item->bankCategoryID ?? 0, $item->id ?? 0]) }}" method="post" class="inline">
                {{ method_field('DELETE') }}
                <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                <button class="btn btn-danger btn-xs rest-destroy" title="Удалить"><i class="fa fa-trash"></i></button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
{{$items->links()}}
<div class="clearfix"></div>

@endsection
