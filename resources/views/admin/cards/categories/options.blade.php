@extends ('admin.layouts.app')
@section ('title', 'Опции для категории карточек - #'.$id)
@section ('h1', 'Опции для категории карточек - #'.$id)

@section('content')



<div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">Список опций</h3></div>
        <div class="panel-body">
            <span>Добавить новый элемент</span> <button class="btn btn-success" id="addItem"><i class="fa fa-plus"></i></button>
            <div id="fileds">
                <div class="row">
                    <div class="col-md-5">Уникальное id - название</div>
                    <div class="col-md-5">Отобраемая метка</div>
                    <div class="col-md-2"></div>
                    <br><br>
                </div>
                @foreach($options as $option)
                <div class="row">
                    <div class="col-md-5"><input type="text" class="form-control idt" value="{{$option->id_title}}"></div>
                    <div class="col-md-5"><input type="text" class="form-control lab" value="{{$option->label}}"></div>
                    <div class="col-md-2"><button class="removeItem btn btn-danger"><i class="fa fa-remove"></i></button></div>
                    <br><br>
                </div>
                @endforeach
            </div>
        </div>
    </div>


<form action="/admin/cards/categories/edit/options_save" method="POST">
    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
    <input type="hidden" name="id" value="{{$id}}">
    <textarea style="display: none" name="options_json" id="options_json"></textarea>
    <button type="submit" class="btn btn-primary pull-right">Обновить</button>
</form>



<script type="text/javascript">

$('#addItem').on('click',function(e){
    e.preventDefault();
    var code = '<div class="row">'+
        '<div class="col-md-5"><input type="text" class="form-control idt"></div>'+
        '<div class="col-md-5"><input type="text" class="form-control lab"></div>'+
        '<div class="col-md-2"><button class="removeItem btn btn-danger"><i class="fa fa-remove"></i></button></div>'+
    '<br><br></div>';
    $('#fileds').append(code);
});

$(document).on('click','.removeItem',function(e){
    e.preventDefault();
    $(this).parent().parent().remove();
});

$('form').on('submit',function(){
    var idTitles = [];
    $('.idt').each(function(){
        idTitles.push($(this).val());
    });
    var LabelArr = [];
    $('.lab').each(function(){
        LabelArr.push($(this).val());
    });

    var res = [];
    var tmp = {};
    var count = idTitles.length;
    for(var i=0; i<count; i++){
        tmp ['id_title'] = idTitles[i];
        tmp ['label'] = LabelArr[i];
        res.push(tmp);
        tmp = {};
    }
    var json = JSON.stringify(res);
    $('#options_json').val(json);
});

</script>

<div class="clearfix"></div>


        
         
@stop
