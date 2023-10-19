<?php
    $path = substr(Request::path(),0,-4);
?>
<a href="{{url($path)}}">Вернуться на начальную страницу</a>
