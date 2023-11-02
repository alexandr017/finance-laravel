@extends ('admin.layouts.app')
@section ('title', 'Создание листинга')
@section ('h1', 'Создание листинга')

@section('content')
<form action="{{ route('admin.cards.listings.store')}}" method="post">

    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

    @include('admin.cards.listings._form')

    <button type="submit" class="btn btn-success pull-right"><i class="fas fa-save"></i> Сохранить</button>

</form>

<div class="clearfix"></div>
<br>
@stop

