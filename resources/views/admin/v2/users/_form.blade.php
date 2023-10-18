
<div class="form-group">
    <label for="first_name"><i class="red">*</i> Имя</label>
    <input type="text" class="form-control" name="first_name" id="first_name" required
           @if(old('first_name'))
               value="{{old('first_name')}}"
           @else
               @if(isset($item))
                   value="{{$item->first_name}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="last_name"><i class="red">*</i> Фамилия</label>
    <input type="text" class="form-control" name="last_name" id="last_name" required
           @if(old('last_name'))
               value="{{old('last_name')}}"
           @else
               @if(isset($item))
                   value="{{$item->last_name}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="middle_name">Отчество</label>
    <input type="text" class="form-control" name="middle_name" id="middle_name"
           @if(old('middle_name'))
               value="{{old('middle_name')}}"
           @else
               @if(isset($item))
                   value="{{$item->middle_name}}"
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
    <label for="employee_id"><i class="red"></i> Сотдрудник</label>
    <select name="employee_id" id="employee_id" class="form-control">
        @foreach($employees as $id => $name)
            <option value="{{$id}}" @if(isset($item) && $item->employee_id == $id) selected @endif>{{$name}}</option>
        @endforeach
    </select>
</div>



<div class="form-group">
    <label for="role_id"><i class="red"></i> Роль</label>
    <select name="role_id" id="role_id" class="form-control">
        @foreach($roles as $id => $h1)
            <option value="{{$id}}" @if(isset($item) && $item->role_id == $id) selected @endif>{{$h1}}</option>
        @endforeach
    </select>
</div>



<div class="form-group">
    <label for="password">Пароль</label>
    <input type="text" class="form-control" name="password" id="password" value="">
</div>

<div class="form-group">
    <label for="last_active">Последняя активность</label>
    <input type="text" class="form-control" name="last_active" id="last_active" readonly
           @if(old('last_active'))
               value="{{old('last_active')}}"
           @else
               @if(isset($item))
                   value="{{$item->last_active}}"
        @endif
        @endif
    >
</div>


