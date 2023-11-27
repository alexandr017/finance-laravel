@extends('admin.layouts.app')
@section('title', 'Список отзывов для категории банка')
@section('h1', 'Список отзывов для категории банка')

@section('content')

<a href="{{route('admin.banks.reviews.create', [$bankID, $categoryID])}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить отзыв</a>
<br>
<br>

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
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->bankName }}</td>
        <td>{{ $item->bankCategoryH1 }}</td>
        <td>{{ $item->author }}</td>
        <td>@if($item->status) <span class="badge badge-success">Включена</span> @else <span class="badge badge-warning">Отключена</span>@endif</td>
        <td>
            <a href="{{route('admin.banks.reviews.edit', [$bankID,$categoryID, $item->id]) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
            <form action="{{ route('admin.banks.reviews.destroy', [$bankID,$categoryID, $item->id]) }}" method="post" class="inline">
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
