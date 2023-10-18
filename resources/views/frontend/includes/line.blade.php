<nav @if($adminPanel==0)  id="line-top" @elseif($adminPanel==1)  id="line-left"  @else id="line-right" @endif>
	<ul>
		<li title="Панель управления" class="first"><a href="/admin/dashboard"><i class="fa fa-dashboard"></i></a></li>
		<li class="outset"><hr></li>
		<li title="Карточки">
			<a href="/admin/cards/cards"><i class="fa fa-id-card-o"></i></a>
			<ul>
				<li title="Добавить карточку" class="plus"><a href="/admin/cards/cards/create"><i class="fa fa-id-card-o"><i class="fa fa-plus"></i></i></a></li>
				<li title="Категории карточек"><a href="/admin/cards/categories"><i class="fa fa-folder-open-o"></i></a></li>
				<li title="Добавить категории карточек" class="plus"><a href="/admin/cards/categories/create"><i class="fa fa-folder-open-o"><i class="fa fa-plus"></i></i></a></li>
			</ul>
		</li>
		<li title="Компании">
			<a href="/admin/companies/companies"><i class="fa fa-bank"></i></a>
			<ul>
				<li title="Добавить компанию" class="plus"><a href="/admin/companies/companies/create"><i class="fa fa-bank"><i class="fa fa-plus"></i></i></a></li>
				<li title="Категории компаний"><a href="/admin/companies/categories"><i class="fa fa-folder-open-o"></i></a></li>
				<li title="Добавить категорию компаний" class="plus"><a href="/admin/companies/categories/create"><i class="fa fa-folder-open-o"><i class="fa fa-plus"></i></i></a></li>
				<li title="Отзывы компаний"><a href="/admin/companies/reviews"><i class="fa fa-commenting-o"></i></a></li>
				<li title="Добавить отзыв компании" class="plus"><a href="/admin/companies/reviews/create"><i class="fa fa-commenting-o"><i class="fa fa-plus"></i></i></a></li>
			</ul>
		</li>
		<li class="outset"><hr></li>
		<li title="Записи">
			<a href="/admin/posts/posts"><i class="fa fa-list"></i></a>
			<ul>
				<li title="Добавить запись" class="plus"><a href="/admin/posts/posts/create"><i class="fa fa-list"><i class="fa fa-plus"></i></i></a></li>
				<li title="Категории записей"><a href="/admin/posts/categories"><i class="fa fa-folder-open-o"></i></a></li>
				<li title="Добавить категорию записей" class="plus"><a href="/admin/posts/categories/create"><i class="fa fa-folder-open-o"><i class="fa fa-plus"></i></i></a></li>
				<li title="Комментарии записей"><a href="/admin/posts/comments"><i class="fa fa-commenting-o"></i></a></li>
				<li title="Добавить комментарий" class="plus"><a href="/admin/posts/comments"><i class="fa fa-commenting-o"><i class="fa fa-plus"></i></i></a></li>				
			</ul>			
		</li>
		<li title="Словарь">
			<a href="/admin/dictionary"><i class="fa fa-book"></i></a>
			<ul>
				<li title="Добавить термин" class="plus"><a href="/admin/dictionary/create"><i class="fa fa-book"><i class="fa fa-plus"></i></i></a></li>
			</ul>			
		</li>
		<li title="Страницы">
			<a href="/admin/pages"><i class="fa fa-file-text-o"></i></a>
			<ul>
				<li title="Добавить страницу" class="plus"><a href="/admin/pages/create"><i class="fa fa-file-text-o"><i class="fa fa-plus"></i></i></a></li>
			</ul>
		</li>
		<li class="outset"><hr></li>
		<li title="Формы"><a href=""><i class="fa fa-window-maximize"></i></a></li>
		<li title="Сайдбар"><a href=""><i class="fa fa-columns"></i></a></li>
		<li title="Пользователи"><a href=""><i class="fa fa-users"></i></a></li>
		<li title="Медиафайлы"><a href=""><i class="fa fa-file-image-o"></i></a></li>
		<li title="Меню"><a href=""><i class="fa fa-navicon"></i></a></li>
		<li title="Сквозные блоки"><a href=""><i class="fa fa-thumb-tack"></i></a></li>
		<li title="Настройки"><a href=""><i class="fa fa-gears"></i></a></li>
		<li title="Скрытые ссылки"><a href=""><i class="fa fa-link"></i></a></li>
		<li title="Log Viewer"><a href=""><i class="fa fa-pie-chart"></i></a></li>
		@if(isset($editLink))
		<li title="Изменить текущий элемент" class="last"><a href="{{$editLink}}"><i class="fa fa-edit"></i></a></li>
		@endif
	</ul>
</nav>
<style type="text/css">
	@if($adminPanel!=0)
	#line-left,#line-right{background: #232323;width: 40px;position: fixed; @if($adminPanel==1)left: 0;@else right: 0;@endif font-size: 13px;top: 0;z-index: 44444;opacity: 0.5;}
	#line-left:hover,#line-right:hover{opacity: 1;}
    #line-left>ul,#line-right>ul{padding: 0; margin: 0;}
    #line-left>ul>li,#line-right>ul>li{ list-style-type: none; border-bottom: 1px solid #fff; background: #232323;position: relative;}
    #line-left>ul>li.first,#line-right>ul>li.first{background: #F44336;}
    #line-left>ul>li.first a:hover,#line-right>ul>li.first a:hover{background: #f33022;}
    #line-left>ul>li.last,#line-right>ul>li.last{background: #00b6f7;}
    #line-left>ul>li.last a:hover,#line-right>ul>li.last a:hover{background: #2196F3;}
    #line-left>ul>li.first a , #line-left ul li.last a,#line-right>ul>li.first a , #line-right ul li.last a{ font-size: 1.5em;}
    #line-left>ul>li>a,#line-right>ul>li>a{color: #fff; padding: 3.5px 0; display: block; text-align: center;}
    #line-left>ul>li>a:hover,#line-right>ul>li>a:hover{background: #000;color: #00b6f7;}
	#line-left .outset,#line-right .outset{margin: 0; border-bottom: 0; background: #232323; border-bottom: 1px solid #fff; height: 25px;}
	#line-left hr,#line-right hr{height: 1px;border-radius: 15px;padding: 0px 0;background: #544d4d;position: relative;width: 40%;margin: 5px 0;margin-left: 30%;display: inline-block; }
    #line-left hr:before,#line-right hr:before{content: '';position: absolute;height: 1px;background: #444040;top: -1px;z-index: 11;left: 0;height: 1px;width: 98%;margin-left: 1%;}
    #line-left>ul>li>ul{display: none; position: absolute;left: 40px; top: 0;background: #232323;padding: 0;margin: 0;}
    #line-right>ul>li>ul{display: none; position: absolute;right: 40px; top: 0;background: #232323;padding: 0;margin: 0;}
    #line-left>ul>li:hover>ul,#line-right>ul>li:hover>ul{display: inline-grid;}
    #line-left>ul>li>ul>li{list-style-type: none;float: left;padding: 4px;border: 1px solid #fff;}
    #line-right>ul>li>ul>li{list-style-type: none;float: right;padding: 4px;border: 1px solid #fff;}
    #line-left>ul>li>ul>li a,#line-right>ul>li>ul>li a{color: #fff;}
    #line-left .plus,#line-right  .plus{background: #a5ca38;}
    #line-left .plus:hover,#line-right .plus:hover{background: #8fb12c;}
    #line-left i i,#line-right i i{font-size: 0.5em}
	@else
	#line-top{background: #232323;width: inherit;position: fixed;left: 0;right: 0;margin: auto;font-size: 13px;top: 0;z-index: 3;opacity: 0.5;width: 465px;}
	#line-top:hover{opacity: 1}
	#line-top>ul {padding: 0;margin: 0;}
	#line-top>ul>li {list-style-type: none;border-right: 1px solid #fff;background: #232323;position: relative;display: inline-block;vertical-align: middle;height: 30px;float: left;}
	#line-top>ul>li.first {background: #F44336;}
	#line-top>ul>li.first a, #line-top>ul>li.last a{padding-top: 0}
	#line-top .outset {margin: 0;border-bottom: 0;background: #232323;border-right: 1px solid #fff;width: 25px;padding-top: 7px;}
	#line-top hr {height: 1px;border-radius: 15px;padding: 0px 0;background: #544d4d;position: relative;width: 40%;margin: 5px 0;margin-left: 30%;display: inline-block;}
	#line-top hr:before {content: '';position: absolute;height: 1px;background: #444040;top: -1px;z-index: 11;left: 0;height: 1px;width: 98%;margin-left: 1%;}
	#line-top>ul>li>a {color: #fff;padding: 1px 5px;display: block;text-align: center;height:30px;padding-top: 5px;}
    #line-top>ul>li>a:hover{background: #000;color: #00b6f7;}
	#line-top>ul>li>ul {display: none;position: absolute;left: 40px;top: 0;background: #232323;padding: 0;margin: 0;}
	#line-top>ul>li>ul{display: none;position: absolute;left: -3px;top: 29px;background: #232323;padding: 0;margin: 0;}
    #line-top>ul>li:hover>ul{display: block;}
    #line-top>ul>li>ul>li{list-style-type: none;padding: 4px;border: 1px solid #fff;}
    #line-top>ul>li>ul>li a{color: #fff;}
    #line-top .plus{background: #a5ca38;}
    #line-top .plus:hover{background: #8fb12c;}
    #line-top i i{font-size: 0.5em}
    #line-top>ul>li.first{background: #F44336;}
    #line-top>ul>li.first a:hover{background: #f33022;}
    #line-top>ul>li.last{background: #00b6f7;}
    #line-top>ul>li.last a:hover{background: #2196F3;}
    #line-top>ul>li.first a , #line-top ul   li.last a{ font-size: 1.5em;}
    @endif
</style>