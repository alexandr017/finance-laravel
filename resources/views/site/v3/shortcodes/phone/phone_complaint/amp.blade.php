<?php $redirectedLink = preg_replace('/\/amp$/', '?phone_complaint=true', \Request::url()); ?>
<a href="{{$redirectedLink}}" class="small-green-btn">Пожаловаться</a>
