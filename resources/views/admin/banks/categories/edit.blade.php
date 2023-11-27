@extends ('admin.layouts.app')
@section ('title', 'Редактирование категорийной страницы для банка')
@section ('h1', 'Редактирование категорийной страницы для банка')

@section('content')

    <a href="{{route('admin.banks.products.index', [$bankID,$item->id])}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Продукты</a>
<br><br>
    <a href="{{route('admin.banks.reviews.index', [$bankID,$item->id])}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Отзывы</a>

<br><br>
    @if($reviewsPage == null)
        <a href="{{route('admin.banks.categories.reviews.show', [$bankID,$item->id])}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить страницу отзывов категорийной страницы банка</a>
    @else
        <a target="_blank" href="/banks/{{ $bankAlias }}/{{ $categoryAlias }}/reviews" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Просмотреть страницу отзывов категорийной страницы банка</a>
        <a href="{{route('admin.banks.categories.reviews.show', [$bankID,$item->id, $reviewsPage->id])}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Изменить страницу отзывов категорийной страницы банка</a>
        <form action="{{route('admin.banks.categories.reviews.delete', [$bankID,$item->id, $reviewsPage->id]) }}" method="post" class="inline">
            {{ method_field('DELETE') }}
            <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
            <button class="btn btn-danger btn-xs rest-destroy"><i class="fa fa-trash"></i> Удалить страницу отзывов категорийной страницы банка</button>
        </form>
    @endif
    <br>
    <br>

    <form action="{{ route('admin.banks.categories.update',[$bankID,$item->id]) }}" method="post">

        {{ method_field('PATCH') }}

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.banks.categories._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop
