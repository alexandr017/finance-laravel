
<div class="form-group">
    <label for="title"><i class="red">*</i> Название</label>
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

<?php // todo поле для школы называется category_id ? ?>
<div class="form-group">
    <label for="category_id"><i class="red"></i> Школа</label>
    <select name="category_id" id="category_id" class="form-control">
        @foreach($schools as $id => $h1)
            <option value="{{$id}}" @if(isset($item) && $item->category_id == $id) selected @endif>{{$h1}}</option>
        @endforeach
    </select>
</div>

external_id ?

<div class="form-group">
    <label for="statistics_link"><i class="red">*</i> statistics_link</label>
    <input type="url" class="form-control" name="statistics_link" id="statistics_link" required
           @if(old('statistics_link'))
               value="{{old('statistics_link')}}"
           @else
               @if(isset($item))
                   value="{{$item->statistics_link}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="affiliate_link"><i class="red">*</i> affiliate_link</label>
    <input type="url" class="form-control" name="affiliate_link" id="affiliate_link" required
           @if(old('affiliate_link'))
               value="{{old('affiliate_link')}}"
           @else
               @if(isset($item))
                   value="{{$item->affiliate_link}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="direct_link"><i class="red">*</i> direct_link</label>
    <input type="url" class="form-control" name="direct_link" id="direct_link" required
           @if(old('direct_link'))
               value="{{old('direct_link')}}"
           @else
               @if(isset($item))
                   value="{{$item->direct_link}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="duration"><i class="red">*</i> Продолжительность</label>
    <input type="text" class="form-control" name="duration" id="duration" required
           @if(old('duration'))
               value="{{old('duration')}}"
           @else
               @if(isset($item))
                   value="{{$item->duration}}"
        @endif
        @endif
    >
</div>



<div class="form-group">
    <label for="duration_type"><i class="red ">*</i> Продолжительность (еденицы измерения)</label>
    <select name="duration_type" id="duration_type" class="form-control" required>
        <option value="1" @if(isset($item) && $item->duration_type == 0) selected @endif>Кол-во уроков</option>
        <option value="0" @if(isset($item) && $item->duration_type == 1) selected @endif>Кол-во часов</option>
        <option value="0" @if(isset($item) && $item->duration_type == 2) selected @endif>Кол-во дней</option>
        <option value="0" @if(isset($item) && $item->duration_type == 3) selected @endif>Кол-во месяцев</option>
    </select>
</div>


<div class="form-group">
    <label for="cost"><i class="red">*</i> Стоимость</label>
    <input type="text" class="form-control" name="cost" id="cost" required
           @if(old('cost'))
               value="{{old('cost')}}"
           @else
               @if(isset($item))
                   value="{{$item->cost}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="sale_cost"><i class="red">*</i> Скидка</label>
    <input type="text" class="form-control" name="sale_cost" id="sale_cost" required
           @if(old('sale_cost'))
               value="{{old('sale_cost')}}"
           @else
               @if(isset($item))
                   value="{{$item->sale_cost}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="sale_value"><i class="red">*</i> Значение со скидки</label> <?php // todo разобраться с полями скидок ?>
    <input type="text" class="form-control" name="sale_value" id="sale_value" required
           @if(old('sale_value'))
               value="{{old('sale_value')}}"
           @else
               @if(isset($item))
                   value="{{$item->sale_value}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="payment_value"><i class="red">*</i> Стоимость платежа</label>
    <input type="text" class="form-control" name="payment_value" id="payment_value" required
           @if(old('payment_value'))
               value="{{old('payment_value')}}"
           @else
               @if(isset($item))
                   value="{{$item->payment_value}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="currency"><i class="red">*</i> Валюта</label>
    <input type="text" class="form-control" name="currency" id="currency" required
           @if(old('currency'))
               value="{{old('currency')}}"
           @else
               @if(isset($item))
                   value="{{$item->currency}}"
        @endif
        @endif
    >
</div>



<div class="form-group">
    <label for="payment_type"><i class="red ">*</i> Тип оплаты</label>
    <select name="payment_type" id="payment_type" class="form-control" required>
        <option value="1" @if(isset($item) && $item->payment_type == 1) selected @endif>Включен</option>
        <option value="0" @if(isset($item) && $item->payment_type == 0) selected @endif>Отключен</option>
    </select>
</div>

<div class="form-group">
    <label for="is_cost_by_query"><i class="red ">*</i> Стоимость по запросу</label>
    <select name="is_cost_by_query" id="is_cost_by_query" class="form-control" required>
        <option value="1" @if(isset($item) && $item->is_cost_by_query == 1) selected @endif>Да</option>
        <option value="0" @if(isset($item) && $item->is_cost_by_query == 0) selected @endif>Нет</option>
    </select>
</div>


<div class="form-group">
    <label for="reviews_count"><i class="red">*</i> Количество отзывов</label>
    <input type="text" class="form-control" name="reviews_count" id="reviews_count" required
           @if(old('reviews_count'))
               value="{{old('reviews_count')}}"
           @else
               @if(isset($item))
                   value="{{$item->reviews_count}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="installment_period"><i class="red">*</i> Период рассрочки</label>
    <input type="text" class="form-control" name="installment_period" id="installment_period" required
           @if(old('installment_period'))
               value="{{old('installment_period')}}"
           @else
               @if(isset($item))
                   value="{{$item->installment_period}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="installment_payment"><i class="red">*</i> Платеж по рассрочке</label>
    <input type="text" class="form-control" name="installment_payment" id="installment_payment" required
           @if(old('installment_payment'))
               value="{{old('installment_payment')}}"
           @else
               @if(isset($item))
                   value="{{$item->installment_payment}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="duration_in_hours"><i class="red">*</i> Продолжительность в часах</label>
    <input type="text" class="form-control" name="duration_in_hours" id="duration_in_hours" required
           @if(old('duration_in_hours'))
               value="{{old('duration_in_hours')}}"
           @else
               @if(isset($item))
                   value="{{$item->duration_in_hours}}"
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
