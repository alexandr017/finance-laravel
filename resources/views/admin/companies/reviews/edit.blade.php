@extends ('admin.layouts.app')
@section ('title', 'Редактирование отзыва компании')
@section('h1','Редактирование отзыва компании')

@section('content')

<link href="/admin-assets/select2/select2.min.css" rel="stylesheet" />
<script src="/admin-assets/select2/select2.min.js"></script>

<form method="POST" action="{{ route('admin.companies.reviews.update', $review) }}">
    {{ method_field('PATCH') }}
    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

    @include('admin.companies.reviews._form')

    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-refresh"></i> Обновить</button>
</form>

<div class="clearfix"></div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#company_id').select2();
    });
</script>
@stop
