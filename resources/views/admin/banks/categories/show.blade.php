@extends ('admin.layouts.app')
@section ('title', 'Редактирование')
@section ('h1', 'Редактирование')

@section('content')



<form action="/admin/banks/categories/{{$item->id}}" method="post">

    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

    <h1>{{$item->h1}}</h1>

    <div class="form-group">
        <label for="bank_id"><i class="red">*</i> Банк</label>
        <?php
        $current_bank = old('bank_id')
            ? old('bank_id')
            : (isset($item) ? $item->bank_id : null);
        ?>
        {!! Form::select('bank_id',$banks,$current_bank,['id'=>'bank_id','class' => 'form-control','required' => true]) !!}
    </div>

    <div class="form-group">
        <label for="category_id"><i class="red">*</i> Категория</label>
        <?php
        $current_category_id = old('category_id')
            ? old('category_id')
            : (isset($item) ? $item->category_id : null);
        ?>
        {!! Form::select('category_id',$categories,$current_category_id,['id'=>'category_id','class' => 'form-control','required' => true]) !!}
    </div>



    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

</form>

<div class="clearfix"></div>
<br>
@stop
