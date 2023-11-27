@extends ('admin.layouts.app')
@section ('title', 'Создание продукта для банка')
@section ('h1', 'Создание продукта для банка')

@section('content')
    <form action="{{ route('admin.banks.products.store', [$bankID, $categoryID])}}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.banks.products._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop

