@extends ('admin.layouts.app')
@section ('title', 'Расстановка листингов для карточки')
@section ('h1', 'Расстановка листингов для карточки')

@section('content')
    <form action="/admin/cards/new-listings/{{$card->id}}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        <h4>Карточка: {{$card->id}} - {{$card->title}}</h4>

        <span class="btn btn-default" id="setToAll">Установить на все</span>
        <span class="btn btn-default" id="unsetToAll">Снять со всех</span>
        <input class="form-control" placeholder="339, 340,341, 343" style="max-width: 300px;display: inline-block;margin-left: 60px;" type="text" value="" id="listCheckboxesFromExel">
        <span class="btn btn-default" id="setCheckboxes">Проставить по ID</span>

        <div id="form-controll">
            @foreach($allNewListingsArr as $key => $listing)
                <div class="checkbox width-50"><label><input id="listing-{{$key}}" name="listings[]" value="{{$key}}" type="checkbox" @if(isset($selectedListingsArr[$key])) checked="true" @endif><span>{{$key}}</span> {{$listing}}</label></div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

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
                $('#listing-' + id).prop('checked', true);
            });
        });

    </script>
@stop
