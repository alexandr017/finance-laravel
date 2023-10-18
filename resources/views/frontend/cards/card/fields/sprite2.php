<?php
//$result_val = str_replace("\n",'',$result_val);
$result_val = mb_strtolower($result_val);
$iconList = explode(',', $result_val);

$resIconList = array();
foreach ($iconList as $key => $value) {

		$iconList[$key] = trim($value);
		$value = trim($iconList[$key]);

		if(strcasecmp($value, 'карта') == 0)
		    $resIconList [] = '<span class="sprite i-karta def_bg" data-src="/sprite.svg" data-title="Банковской картой"></span>';
		if(strcasecmp($value, 'qiwi') == 0)
		    $resIconList [] = '<span class="sprite i-kiwi def_bg" data-src="/sprite.svg" data-title="Через QIWI"></span>';
		if(strcasecmp($value, 'яндекс.деньги') == 0)
		    $resIconList [] = '<span class="sprite i-ya def_bg" data-src="/sprite.svg" data-title="Через Яндекс.Деньги"></span>';
		if(strcasecmp($value, 'юнистрим') == 0)
		    $resIconList [] = '<span class="sprite i-unistrim def_bg" data-src="/sprite.svg" data-title="Через Юнистрим"></span>';
		//if(strcasecmp($value, 'contact') == 0)
		    //$resIconList [] = '<span><img class="sprite i-unistrim def_bg" src="/old_theme/img/lazy-loading.jpg" data-src="/sprite.svg" alt="Юнистрим" data-title="Юнистрим"></span>';
		if(strcasecmp($value, 'contact') == 0)
		    $resIconList [] = '<span class="sprite i-contact def_bg" data-src="/sprite.svg" data-title="Через Contact"></span>';
		if(strcasecmp($value, 'лидер') == 0)
		    $resIconList [] = '<span class="sprite i-leader def_bg" data-src="/sprite.svg" data-title="Через Лидер"></span>';
		if(strcasecmp($value, 'золотая корона') == 0)
		    $resIconList [] = '<span class="sprite i-korona def_bg" data-src="/sprite.svg" data-title="Через Золотую корону"></span>';
		if(strcasecmp($value, 'счет') == 0)
		    $resIconList [] = '<span class="sprite i-count def_bg" data-src="/sprite.svg" data-title="Со счета"></span>';
		if(strcasecmp($value, 'наличные') == 0)
		    $resIconList [] = '<span class="sprite i-nalichny def_bg" data-src="/sprite.svg" data-title="Наличными"></span>';
		if(strcasecmp($value, 'наличными') == 0)
		    $resIconList [] = '<span class="sprite i-nalichny def_bg" data-src="/sprite.svg" data-title="Наличными"></span>';
		if(strcasecmp($value, 'виза') == 0)
		    $resIconList [] = '<span class="sprite i-visa def_bg" data-src="/sprite.svg" data-title="Картой Виза"></span>';
		if(strcasecmp($value, 'кукуруза') == 0)
		    $resIconList [] = '<span class="sprite i-kukuruza def_bg" data-src="/sprite.svg" data-title="Картой Кукуруза"></span>';
		if(strcasecmp($value, 'мастеркард') == 0)
		    $resIconList [] = '<span class="sprite i-master def_bg" data-src="/sprite.svg" data-title="Картой МастерКард"></span>';
		if(strcasecmp($value, 'маэстро') == 0)
		    $resIconList [] = '<span class="sprite i-maestro def_bg" data-src="/sprite.svg" data-title="Картой Маэстро"></span>';
	/***********/
		if(strcasecmp($value, 'рапида') == 0)
			    $resIconList [] = '<span class="sprite i-rapida def_bg" data-src="/sprite.svg" data-title="Через Рапиду"></span>';
		if(strcasecmp($value, 'связной') == 0)
			    $resIconList [] = '<span class="sprite i-sviaznoy def_bg" data-src="/sprite.svg" data-title="Через Связной"></span>';
		if(strcasecmp($value, 'вебмани') == 0)
			    $resIconList [] = '<span class="sprite i-webmoney def_bg" data-src="/sprite.svg" data-title="Через Вебмани"></span>';
		if(strcasecmp($value, 'евросеть') == 0)
			    $resIconList [] = '<span class="sprite i-euroset def_bg" data-src="/sprite.svg" data-title="Через Евросеть"></span>';
		if(strcasecmp($value, 'элекснет') == 0)
			    $resIconList [] = '<span class="sprite i-elexnet def_bg" data-src="/sprite.svg" data-title="Через Элекснет"></span>';
		if(strcasecmp($value, 'робокасса') == 0)
			    $resIconList [] = '<span class="sprite i-robokassa def_bg" data-src="/sprite.svg" data-title="Через Робокассу"></span>';
		if(strcasecmp($value, 'cyberplat') == 0)
			    $resIconList [] = '<span class="sprite i-cyberplat def_bg" data-src="/sprite.svg" data-title="Через CyberPlat"></span>';
		if(strcasecmp($value, 'терминалы') == 0)
			    $resIconList [] = '<span class="sprite i-terminals def_bg" data-src="/sprite.svg" data-title="Через терминалы"></span>';
		if(strcasecmp($value, 'смс') == 0)
			    $resIconList [] = '<span class="sprite i-sms def_bg" data-src="/sprite.svg" data-title="С помощью СМС"></span>';
		if(strcasecmp($value, 'мтс') == 0)
			    $resIconList [] = '<span class="sprite i-mts def_bg" data-src="/sprite.svg" data-title="Через МТС"></span>';
		if(strcasecmp($value, 'почта россии') == 0)
			    $resIconList [] = '<span class="sprite i-post def_bg" data-src="/sprite.svg" data-title="Через Почту России"></span>';
		if(strcasecmp($value, 'deltapay') == 0)
			    $resIconList [] = '<span class="sprite i-deltapay def_bg" data-src="/sprite.svg" data-title="Через DeltaPay"></span>';
		if(strcasecmp($value, 'билайн') == 0)
			    $resIconList [] = '<span class="sprite i-beeline def_bg" data-src="/sprite.svg" data-title="Через Билайн"></span>';
}

$resIconListStr = implode(' ',$resIconList);
echo $resIconListStr;
