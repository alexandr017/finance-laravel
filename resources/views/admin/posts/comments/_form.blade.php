<input type="number" name="id" value="{{ $postComments->id ?? 0 }}" hidden>

<div class="form-group">
    <label for="pid"><i>*</i> Запись:</label>
    {{Form::select('pid',$postsArr,$postComments->pid ?? null,['id'=>'pid','class' => 'form-control','required' => true])}}
</div>

<div class="form-group">
    <label for="author_name">Имя автора:</label>
    <input type="text" class="form-control" name="author_name" id="author_name"
           @if(old('author_name'))
               value="{{old('author_name')}}"
           @else
               @if(isset($postComments))
                   value="{{$postComments->author_name}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="author_email">Email автора:</label>
    <input type="text" class="form-control" name="author_email" id="author_email"
           @if(old('author_email'))
               value="{{old('author_email')}}"
           @else
               @if(isset($postComments))
                   value="{{$postComments->author_email}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="comment"><i>*</i> Комментарий:</label>
    <?php
    $comment = old('comment')
        ? old('comment')
        : (isset($postComments) ? $postComments->comment : '');
    ?>
    <textarea class="form-control" rows="8" name="comment" id="comment">{{$comment}}</textarea>
</div>

<div class="form-group">
    <label for="uid">ID Пользователя:</label>
    <input type="text" class="form-control" name="uid" id="uid"
           @if(old('uid'))
               value="{{old('uid')}}"
           @else
               @if(isset($postComments))
                   value="{{$postComments->uid}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="parent">ID Родитетельского комментария:</label>
    <input type="parent" class="form-control" name="parent" id="parent"
           @if(old('parent'))
               value="{{old('parent')}}"
           @else
               @if(isset($postComments))
                   value="{{$postComments->parent}}"
            @endif
            @endif
    >
</div>
<div class="form-group">
    <label for="vzo_author">Выбрать автора из авторов Финансов:</label>
    {{Form::select('vzo_author',$vzoAuthors,$postComments->vzo_author ?? null,['id'=>'vzo_author','class' => 'form-control','key'=>true,'placeholder'=>''])}}
</div>
<div class="form-group">
    <label for="status"><i>*</i> Статус:</label>
    {{Form::select('status',['1'=>'Включен','0'=>'Выключен'],$postComments->status ?? old('status') ?? 1,['id'=>'status','class' => 'form-control'])}}
</div>