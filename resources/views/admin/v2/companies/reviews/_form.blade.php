
<div class="form-group">
    <label for="school_id"><i class="red"></i> Школа</label>
    <select name="school_id" id="school_id" class="form-control">
        @foreach($schools as $id => $h1)
            <option value="{{$id}}" @if(isset($item) && $item->school_id == $id) selected @endif>{{$h1}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="title"><i class="red">*</i> Заголовок</label>
    <input type="text" class="form-control" name="title" id="title" required
           @if(old('title'))
               value="{{old('title')}}"
           @else
               @if(isset($item))
                   value="{{$item->title}}"
        @endif
        @endif
    >
</div>


<?php //todo скорее всего неиспользуемые ?>
character_code
sort
code




<div class="form-group">
    <label for="pluses">Плюсы</label>
    <?php
    $pluses = old('pluses')
        ? old('pluses')
        : (isset($item) ? $item->pluses : '');
    ?>
    <textarea class="form-control" name="pluses" id="pluses">{{$pluses}}</textarea>
</div>

<div class="form-group">
    <label for="minuses">Минусы</label>
    <?php
    $minuses = old('minuses')
        ? old('minuses')
        : (isset($item) ? $item->minuses : '');
    ?>
    <textarea class="form-control" name="minuses" id="minuses">{{$minuses}}</textarea>
</div>


<div class="form-group">
    <label for="content"><i class="red"></i> Контент</label>
    <?php
    $content = old('content')
        ? old('content')
        : (isset($item) ? $item->content : '');
    ?>
    <textarea class="form-control" name="content" id="content">{{$content}}</textarea>
</div>


<div class="form-group">
    <label for="rating">Рейтинг</label>
    <input type="number" class="form-control" name="rating" id="rating"
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
    <label for="author_name">Имя автора</label>
    <input type="number" class="form-control" name="author_name" id="author_name" step="0.1" min="3" max="5"
           @if(old('author_name'))
               value="{{old('author_name')}}"
           @else
               @if(isset($item))
                   value="{{$item->author_name}}"
        @endif
        @endif
    >
</div>


<div class="form-group">
    <label for="status"><i class="red ">*</i> Статус</label>
    <select name="status" id="status" class="form-control" required>
        <option value="1" @if(isset($item) && $item->status == 1) selected @endif>Включен</option>
        <option value="0" @if(isset($item) && $item->status == 0) selected @endif>Отключен</option>
    </select>
</div>
