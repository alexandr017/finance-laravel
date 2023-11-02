@extends('admin.layouts.app')
@section('title', 'Список листингов')
@section('h1', 'Список листингов')

@section('content')

<a href="{{route('admin.cards.listings.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить листинг</a>
{!! Form::select('category_id',$categories,$selected_category,['id'=>'category_id','class' => '']) !!}
<br>
<br>
<form class="clearfix" method="POST" action="/admin/cards/listing-search-by-id">
    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
    <div class="row">
        <label for="post_id" class="col-md-2 col-form-label">Поиск по ID листинга:</label>
        <div class="col-md-9">
            <input class="form-control" type="text" name="id" value="" id="id" required="true">
        </div>
        <button type="submit" class="col-md-1 btn btn-success"><i class="fa fa-search"></i> Найти</button>
    </div>
</form>
<br>
<br>

<table id="rowtbl" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>h1</th>
        <th>Ссылка</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($items as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->h1 }}</td>
        <td>{{ $item->alias }}</td>
        <td>@if($item->status) <span class="badge badge-success">Включена</span> @else <span class="badge badge-warning">Отключена</span>@endif</td>
        <td>
{{--            <a href="/{{$item->alais}}" target="_blank" class="btn btn-info btn-xs" title="Открыть"><i class="fa fa-eye"></i></a>--}}
            <a href="{{route('admin.cards.listings.edit', $item->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
            <a href="{{route('admin.cards.listing-cards.edit', $item->id) }}" class="btn btn-primary btn-xs" title="Привязка карточек"><i class="fa fa-id-card-o"></i></a>
            <form action="{{ route('admin.cards.listings.destroy',$item->id) }}" method="post" class="inline">
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


{{$items->appends(request()->input())->links()}}

<script>
    $('#category_id').on('change',function(){
        var id = $(this).find(":selected").attr('value');
        location.replace('/admin/cards/listings?category_id='+id);
    })
</script>

@endsection
