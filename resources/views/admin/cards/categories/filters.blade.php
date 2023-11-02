@extends ('admin.layouts.app')
@section ('title', 'Фильтры для категории карточек - #'.$id)
@section ('h1', 'Фильтры для категории карточек - #'.$id)

@section('content')

<style type="text/css">
.panel-heading input{height: 38px;padding: 8px 12px;font-size: 14px;line-height: 1.42857143;color: #666666;
    background-color: #ffffff;background-image: none;border: 1px solid #cccccc;width: calc(100% - 85px);
}
</style>

@foreach($filters as $filter)
<div class="panel panel-primary">
    <div class="panel-heading">
        <button class="btn btn-success add-item"><i class="fa fa-plus"></i></button>
        <input class="group-name" value="{{$filter->group_name}}" placeholder="Отображаемое имя группы">
        <button class="btn btn-danger remove-group"><i class="fa fa-trash"></i></button>
    </div>
    <div class="panel-body">
        <table class="table">
            @foreach($filter->values as $value)
            <tr>
                <td><input class="form-control lab" value="{{$value[0]->label}}" placeholder="Отображаемое имя"></td>
                <td><input class="form-control link" value="{{$value[0]->link}}"  placeholder="Ссылка"></td>
                <td><button class="btn btn-warning remove-item"><i class="fa fa-trash"></i></button></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endforeach

<button class="btn btn-success add-group"><i class="fa fa-plus"></i> Добавить группу</button>





<form action="/admin/cards/categories/edit/filter_save" method="POST">
    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
    <input type="hidden" name="id" value="{{$id}}">
    <textarea style="display: none" name="filters_json" id="filters_json"></textarea>


    <button type="submit" class="btn btn-primary pull-right">Обновить</button>
</form>





<script type="text/javascript">








// add-item
$(document).on('click','.add-item',function(e){
    e.preventDefault();
    var code = '<tr>'+
            '<td><input class="form-control lab" value="" placeholder="Отображаемое имя"></td>'+
            '<td><input class="form-control link" value=""  placeholder="Ссылка"></td>'+
            '<td><button class="btn btn-warning remove-item"><i class="fa fa-trash"></i></button></td>'+
        '</tr>';
    $(this).parent().parent().find('table').append(code);
});


// remove-item
$(document).on('click','.remove-item',function(e){
    e.preventDefault();
    $(this).parent().parent().remove();
});


// add-group
$(document).on('click','.add-group',function(e){
    e.preventDefault();
    var code = '<div class="panel panel-primary">'+
                '<div class="panel-heading">'+
                    '<button class="btn btn-success add-item"><i class="fa fa-plus"></i></button>'+
                    '<input class="group-name" value="" placeholder="Отображаемое имя группы">'+
                    '<button class="btn btn-danger remove-group"><i class="fa fa-trash"></i></button>'+
                '</div>'+
                '<div class="panel-body">'+
                    '<table class="table">'+
                    '</table>'+
                '</div>'+
            '</div>';
    $(this).before(code);
});

//remove-group
$(document).on('click','.remove-group',function(e){
    e.preventDefault();
    $(this).parent().parent().remove();
});




$('form').on('submit',function(){

    var result = [];
    $('.panel').each(function(){
        resTmp = {};
        tmp = [];

        group_name = $(this).find('.group-name').val();

        $(this).find('table tr').each(function(){
            temp = {};
            label = $(this).find('.lab').val();
            link = $(this).find('.link').val();
            temp['label'] = label;
            temp['link'] = link;

            tmp.push([temp]);
        });

        resTmp['group_name'] = group_name;
        resTmp['values'] = tmp;

        result.push(resTmp);
    });

    var json = JSON.stringify(result);
    $("#filters_json").val(json);

    return true;


});

</script>

<div class="clearfix"></div>


        
         
@stop
