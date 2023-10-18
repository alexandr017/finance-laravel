
<div class="form-group">
    <label for="post_id"><i class="red"></i> Запись</label>
    <select name="post_id" id="post_id" class="form-control">
        @foreach($posts as $id => $h1)
            <option value="{{$id}}" @if(isset($item) && $item->post_id == $id) selected @endif>{{$h1}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="parent_id">ID родительского отзыва</label>
    <input type="text" class="form-control" name="parent_id" id="parent_id"
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
    <label for="name"><i class="red">*</i> Имя</label>
    <input type="text" class="form-control" name="name" id="name" required
           @if(old('name'))
               value="{{old('name')}}"
           @else
               @if(isset($item))
                   value="{{$item->name}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="user_id">ID пользователя</label>
    <input type="text" class="form-control" name="user_id" id="user_id"
           @if(old('user_id'))
               value="{{old('user_id')}}"
           @else
               @if(isset($item))
                   value="{{$item->user_id}}"
        @endif
        @endif
    >
</div>


<div class="form-group">
    <label for="email"><i class="red">*</i> Email</label>
    <input type="email" class="form-control" name="email" id="email" required
           @if(old('email'))
               value="{{old('email')}}"
           @else
               @if(isset($item))
                   value="{{$item->email}}"
        @endif
        @endif
    >
</div>


<div class="form-group">
    <label for="content"><i class="red">*</i> Контент</label>
    <?php
    $content = old('content')
        ? old('content')
        : (isset($item) ? $item->content : '');
    ?>
    <textarea class="form-control" name="content" id="content">{{$content}}</textarea>
</div>


<div class="form-group">
    <label for="status"><i class="red ">*</i> Статус</label>
    <select name="status" id="status" class="form-control" required>
        <option value="1" @if(isset($item) && $item->status == 1) selected @endif>Включен</option>
        <option value="0" @if(isset($item) && $item->status == 0) selected @endif>Отключен</option>
    </select>
</div>
