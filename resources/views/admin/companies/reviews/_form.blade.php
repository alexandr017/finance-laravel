<input type="number" name="id" value="{{ $review->id ?? 0 }}" hidden>

<div class="form-group">
    <label for="author"><i>*</i> Автор:</label>
    <input class="form-control" type="text" name="author" id="author" required
           @if(old('author'))
               value="{{old('author')}}"
           @else
               @if(isset($review))
                   value="{{$review->author}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="review"><i>*</i> Отзыв:</label>
    <?php
    $reviewText = old('review')
        ? old('review')
        : (isset($review) ? $review->review : '');
    ?>
    <textarea  class="form-control" name="review" id="review" required>{{ $reviewText }}</textarea>

</div>

<div class="form-group">
    <label for="rating">Рейтинг:</label>
    <input type="number" id="rating" class="form-control" min="1" max="5" step="0.5" name="rating"
           @if(old('rating'))
               value="{{old('rating')}}"
           @else
               @if(isset($review))
                   value="{{$review->rating}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="company_id"><i>*</i> Компания:</label>
    <?php
    $company_id = old('company_id')
        ? old('company_id')
        : ($review->company_id ?? null);
    ?>
    {{Form::select('company_id',$companiesArr,$company_id,['id'=>'company_id','class'=>'form-control','required'=>true])}}
</div>

<div class="form-group">
    <label for="pros">Плюсы:</label>
    <?php
    $pros = old('pros')
        ? old('pros')
        : (isset($review) ? $review->pros : '');
    ?>
    <textarea  class="form-control" name="pros" id="pros">{{ $pros }}</textarea>
</div>

<div class="form-group">
    <label for="minuses">Минусы:</label>
    <?php
    $minuses = old('minuses')
        ? old('minuses')
        : (isset($review) ? $review->minuses : '');
    ?>
    <textarea  class="form-control" name="minuses" id="minuses">{{ $minuses }}</textarea>
</div>

<div class="form-group">
    <label for="answer">Ответ:</label>
    <?php
    $answer = old('answer')
        ? old('answer')
        : (isset($review) ? $review->answer : '');
    ?>
    <textarea  class="form-control" name="answer" id="answer">{{ $answer }}</textarea>
</div>

<div class="form-group">
    <label for="parent_id">ID родительского отзыва:</label>
    <input class="form-control" type="number" name="parent_id" id="parent_id"
           @if(old('parent_id'))
               value="{{old('parent_id')}}"
           @else
               @if(isset($review))
                   value="{{$review->parent_id}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="status">Статус:</label>
    {{Form::select('status',['1'=>'Включена','0'=>'Выключена'],$review->status ?? 1,['id'=>'status','class' => 'form-control'])}}
</div>
