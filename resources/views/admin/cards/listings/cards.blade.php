@extends ('admin.layouts.app')
@section ('title', 'Расстановка карточек для листинга')
@section ('h1', 'Расстановка карточек для листинга')

@section('content')
    <form action="{{ route('admin.cards.listing-cards.update',$id) }}" method="post">

        {{ method_field('PATCH') }}

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        <span class="btn btn-default" id="setToAll">Установить на все</span>
        <span class="btn btn-default" id="unsetToAll">Снять со всех</span>
        <input class="form-control" placeholder="339, 340,341, 343" style="max-width: 300px;display: inline-block;margin-left: 60px;" type="text" value="" id="listCheckboxesFromExel">
        <span class="btn btn-default" id="setCheckboxes">Проставить по ID</span>

        <div id="form-controll">
            @foreach($cards as $key => $card)
                <div class="checkbox width-50"><label><input id="card-{{$key}}" name="listings[]" value="{{$key}}" type="checkbox" @if(in_array($key, $selected_cards)) checked="true" @endif><span>{{$key}}</span> {{$card}}</label></div>
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

        $('#setCheckboxes').on('click', function(){
            $('#unsetToAll').click();
            //339, 340,341, 343
            var listStr = $('#listCheckboxesFromExel').val();
            var listArr = listStr.split(',');
            listArr.map(function(item){
                var id = item.trim();
                $('#card-' + id).prop('checked', true);
            });
        });

    </script>
@stop
