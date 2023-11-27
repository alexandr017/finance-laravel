@extends ('admin.layouts.app')
@section ('title', 'Редактирование отзыва банка')
@section ('h1', 'Редактирование отзыва банка')

@section('content')

<form action="{{ route('admin.banks.reviews.update', [$bankID, $categoryID, $item->id]) }}" method="post">

    {{ method_field('PATCH') }}

    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

    @include('admin.banks.reviews._form')

    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

</form>

<div class="clearfix"></div>
<br>
@stop
