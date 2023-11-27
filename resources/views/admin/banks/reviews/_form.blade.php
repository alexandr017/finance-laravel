<div class="form-group">
    <label for="bank_id"><i class="red">*</i> Банк</label>
    <?php
    $current_bank_id = old('bank_id')
        ? old('bank_id')
        : (isset($item) ? $item->bank_id : $bankID ?? null);
    ?>
    {!! Form::select('bank_id',$banks,$current_bank_id,['id'=>'bank_id','class' => 'form-control','required' => true]) !!}
</div>

<div class="form-group">
    <label for="bank_category_id"><i class="red">*</i> Категория</label>
    <?php
    $current_category_id = old('bank_category_id')
        ? old('bank_category_id')
        : (isset($item) ? $item->bank_category_id : $categoryID ?? null);
    ?>
    {!! Form::select('bank_category_id',$categories,$current_category_id,['id'=>'bank_category_id','class' => 'form-control','required' => true]) !!}
</div>

<div class="form-group">
    <label for="product_id"><i class="red">*</i> Продукты</label>
    <?php
    $current_product_id = old('product_id')
        ? old('product_id')
        : (isset($item) ? $item->product_id : null);
    ?>

    {!! Form::select('product_id',$products,$current_product_id,['id'=>'product_id','class' => 'form-control','required' => true]) !!}
</div>


<div class="form-group">
    <label for="author"><i>*</i> Автор:</label>
    <input class="form-control" type="text" name="author" id="author" required
           @if(old('author'))
           value="{{old('author')}}"
           @else
           @if(isset($item))
           value="{{$item->author}}"
            @endif
            @endif
    >
</div>
<div class="form-group">
    <label for="review"><i>*</i> Отзыв:</label>
    <?php
    $current_review = old('review')
        ? old('review')
        : (isset($item) ? $item->review : '');
    ?>
    <textarea  class="form-control" name="review" id="review" required="true">{{$current_review}}</textarea>
</div>
<div class="form-group">
    <label for="rating">Рейтинг:</label>
    <input type="number" id="rating" class="form-control" min="1" max="5" step="0.5" name="rating"
           @if(old('rating'))
           value="{{old('rating')}}"
           @else
           @if(isset($item))
           value="{{$item->rating}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="pros">Плюсы:</label>
    <?php
    $current_pros = old('pros')
        ? old('pros')
        : (isset($item) ? $item->pros : '');
    ?>
    <textarea  class="form-control" name="pros" id="pros">{{$current_pros}}</textarea>
</div>
<div class="form-group">
    <label for="minuses">Минусы:</label>
    <?php
    $current_minuses = old('minuses')
        ? old('minuses')
        : (isset($item) ? $item->minuses : '');
    ?>
    <textarea  class="form-control" name="minuses" id="minuses">{{$current_minuses}}</textarea>
</div>
<div class="form-group">
    <label for="answer">Ответ:</label>
    <?php
    $current_answer = old('answer')
        ? old('answer')
        : (isset($item) ? $item->answer : '');
    ?>
    <textarea  class="form-control" name="answer" id="answer">{{$current_answer}}</textarea>
</div>


<div class="form-group">
    <label for="parent_id">ID родительского отзыва:</label>
    <input class="form-control" type="number" name="parent_id" id="parent_id"
           @if(old('parent_id'))
           value="{{old('parent_id')}}"
           @else
           @if(isset($item))
           value="{{$item->parent_id}}"
            @endif
            @endif
    >
</div>



<div class="form-group">
    <label for="status"><i class="red">*</i> Статус</label>
    <?php
    $current_status = old('status')
        ? old('status')
        : (isset($item) ? $item->status : 1);
    ?>
    {!! Form::select('status',[0 => 'Выключено', 1 => 'Включено'],$current_status,['id'=>'status','class' => 'form-control','required' => true]) !!}
</div>


<link href="/admin-assets/select2/select2.min.css" rel="stylesheet" />
<script src="/admin-assets/select2/select2.min.js"></script>

<script>
    window.currentBank = null;
    window.currentBankCategoryId = null;

    $(document).ready(function() {
        $('#bank_id').select2();
        $('#bank_category_id').select2();
        $('#product_id').select2();
    });

    // $('#bank_id').on('change', function(){
    //     window.currentBank = $(this).val();
    //     loadProducts();
    // });
    //
    // $('#bank_category_id').on('change', function(){
    //     window.currentBankCategoryId = $(this).val();
    //     loadProducts();
    // });
    //
    // function loadProducts() {
    //     $.ajax({
    //         url: '/admin/banks/reviews/load?bank_id='+ window.currentBank + '&bank_category_id=' + window.currentBankCategoryId,
    //         method: 'get',
    //         //dataType: 'html',
    //         success: function(data){
    //             // console.log(data);
    //             // console.log(JSON.parse(data));
    //             $('#product_id').html('');
    //             $.each(data, function (key, value) {
    //                 $('#product_id').append('<option value=' + value.id + '>' + value.h1 + '</option>');
    //             });
    //         }
    //     });
    // }
</script>
