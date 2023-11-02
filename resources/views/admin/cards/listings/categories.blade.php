@extends ('admin.layouts.app')
@section ('title', 'Растановка карточек для листинга')
@section ('h1', 'Растановка карточек для листинга')

@section('content')
<form action="/admin/cards/categories/edit/{{$category_id}}/index_listings" method="post">

    {{ method_field('PATCH') }}

    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

    <span class="btn btn-default" id="setToAll">Установить на все</span>
    <span class="btn btn-default" id="unsetToAll">Снять со всех</span>

    <div id="form-controll">
        @foreach($cards as $key => $card)
        <div class="checkbox width-50"><label><input name="listings[]" value="{{$key}}" type="checkbox" @if(in_array($key, $selected_cards)) checked="true" @endif>{{$card}}</label></div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-success pull-right"><i class="fas fa-save"></i> Сохранить</button>

</form>

<div class="clearfix"></div>
<br>

<style>
    .width-50{width: 49%;display: inline-block;}
</style>

<script>
    $('#setToAll').on('click',function(){
        $('#form-controll input').prop('checked', true);
    });
    $('#unsetToAll').on('click',function(){
        $('#form-controll input').prop('checked', false);
    });

</script>
@stop
