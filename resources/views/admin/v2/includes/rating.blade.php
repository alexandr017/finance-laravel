<div class="form-group">
    <label for="rating_value">Значение рейтинг</label>
    <input type="number" class="form-control" name="rating_value" id="rating_value" step="0.01" min="3" max="5"
           @if(old('rating_value'))
               value="{{old('rating_value')}}"
           @else
               @if(isset($item))
                   value="{{$item->rating_value}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="rating_count">Количество голосов</label>
    <input type="number" class="form-control" name="rating_count" id="rating_count" step="1"
           @if(old('rating_count'))
               value="{{old('rating_count')}}"
           @else
               @if(isset($item))
                   value="{{$item->rating_count}}"
        @endif
        @endif
    >
</div>
