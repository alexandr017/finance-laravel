@extends ('admin.layouts.app')
@section ('title', 'Редактирование продукта для банка')
@section ('h1', 'Редактирование продукта для банка')

@section('content')
    <a target="_blank" href="/banki/{{ $bankAlias }}/{{$categoryAlias}}/{{ $productAlias }}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Просмотреть страницу продукта банка</a>
    @if($reviewsPage == null)
        <a href="{{route('admin.banks.products.reviews.show', [$bankID,$categoryID,$item->id])}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить страницу отзывов продукта банка</a>
    @else
        <a target="_blank" href="/banki/{{ $bankAlias }}/{{$categoryAlias}}/{{ $productAlias }}/reviews" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Просмотреть страницу отзывов продукта банка</a>
        <a href="{{route('admin.banks.products.reviews.show', [$bankID, $categoryID,$item->id])}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Изменить страницу отзывов продукта банка</a>
        <form action="{{route('admin.banks.products.reviews.delete', [$bankID,$item->id,$categoryID,$reviewsPage->id]) }}" method="post" class="inline">
            {{ method_field('DELETE') }}
            <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
            <button class="btn btn-danger btn-xs rest-destroy"><i class="fa fa-trash"></i> Удалить страницу отзывов продукта банка</button>
        </form>
    @endif
    <br>
    <br><form action="{{ route('admin.banks.products.update', [$bankID,$categoryID,$item->id])}}" method="post">

    {{ method_field('PATCH') }}

    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

    @include('admin.banks.products._form')

    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

</form>

<div class="clearfix"></div>
<br>
@stop


