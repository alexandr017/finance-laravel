@extends ('admin.layouts.app')
@section ('title', 'Редактирование')
@section ('h1', 'Редактирование')

@section('content')



    <form action="/admin/banks/reviews/{{$item->id}}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        <h1>{{$item->h1}}</h1>

        <p>{{$item->review}}</p>


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
            <label for="bank_category_id"><i class="red">*</i> Категория</label>
            <?php
            $current_category_id = old('bank_category_id')
                ? old('bank_category_id')
                : (isset($item) ? $item->bank_category_id : null);
            ?>
            {!! Form::select('bank_category_id',$categories,$current_category_id,['id'=>'bank_category_id','class' => 'form-control','required' => true]) !!}
        </div>


        <div class="form-group">
            <label for="product_id">Продукт</label>
            <?php
            $current_product_id = old('product_id')
                ? old('product_id')
                : (isset($item) ? $item->product_id : null);
            ?>
            {!! Form::select('product_id',$products,$current_product_id,['id'=>'product_id','class' => 'form-control']) !!}
        </div>


        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>

    <link href="/admin-assets/select2/select2.min.css" rel="stylesheet" />
    <script src="/admin-assets/select2/select2.min.js"></script>

    <script>

        $(document).ready(function() {
            $('#bank_id').select2();
            $('#bank_category_id').select2();
            $('#product_id').select2();
        });
    </script>
@stop
