@if (file_exists(resource_path('views') . '/frontend/banks/modules/category_and_product_face/' . $categoryAlias . '/' . 'face-amp.blade.php'))
    @include('/frontend/banks/modules/category_and_product_face/' . $categoryAlias . '/' . 'face-amp')
@endif