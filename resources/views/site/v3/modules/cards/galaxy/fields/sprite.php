<?php
//$result_val = str_replace("\n",'',$result_val);
$result_val = mb_strtolower($result_val);
$iconList = explode(',', $result_val);

$resIconList = array();
foreach ($iconList as $key => $value) {

		$iconList[$key] = trim($value);
		$value = trim($iconList[$key]);

		if(strcasecmp($value, 'карта') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-3.png)" data-title="Банковская карта"></span>';
		if(strcasecmp($value, 'qiwi') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-16.png)" data-title="QIWI"></span>';
		if(strcasecmp($value, 'яндекс.деньги') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-12.png)" data-title="Яндекс.Деньги"></span>';
		if(strcasecmp($value, 'юнистрим') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-11.png)" data-title="Юнистрим"></span>';
		if(strcasecmp($value, 'contact') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-13.png)" data-title="Contact"></span>';
		//if(strcasecmp($value, 'лидер') == 0)
		    //$resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-1.png)" data-title="На Лидер"></span>';
		if(strcasecmp($value, 'золотая корона') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-2.png)" data-title="Золотая Корона"></span>';
		if(strcasecmp($value, 'счет') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-10.png)" data-title="Банковский счет"></span>';
		if(strcasecmp($value, 'наличные') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-7.png)" data-title="Наличные"></span>';
		if(strcasecmp($value, 'наличными') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-7.png)" data-title="Наличные"></span>';
		if(strcasecmp($value, 'виза') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-17.png)" data-title="Карта Виза"></span>';
		if(strcasecmp($value, 'кукуруза') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-5.png)" data-title="Карта Кукуруза"></span>';
		if(strcasecmp($value, 'мастеркард') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-15.png)" data-title="Карта МастерКард"></span>';
		if(strcasecmp($value, 'маэстро') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-14.png)" data-title="Карта Маэстро"></span>';
		if(strcasecmp($value, 'рапида') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-8.png)" data-title="Рапида"></span>';
		if(strcasecmp($value, 'связной') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-9.png)" data-title="Связной"></span>';
		if(strcasecmp($value, 'вебмани') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-33.png)" data-title="WebMoney"></span>';
		if(strcasecmp($value, 'евросеть') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-1.png)" data-title="Евросеть"></span>';
		if(strcasecmp($value, 'элекснет') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-28.png)" data-title="Элекснет"></span>';
		//if(strcasecmp($value, 'робокасса') == 0)
			    //$resIconList [] = '<span class="sprite i-robokassa def_bg" style="background:url(/images/ic_pay/payment-1.png)" data-title="На Робокассу"></span>';
		if(strcasecmp($value, 'cyberplat') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-29.png)" data-title="CyberPlat"></span>';
		if(strcasecmp($value, 'терминалы') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-22.png)" data-title="Платежные терминалы"></span>';
		if(strcasecmp($value, 'смс') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-27.png)" data-title="СМС"></span>';
		if(strcasecmp($value, 'мтс') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-21.png)" data-title="МТС"></span>';
		if(strcasecmp($value, 'почта россии') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-23.png)" data-title="Почта России"></span>';
		if(strcasecmp($value, 'deltapay') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-30.png)" data-title="DeltaPay"></span>';
		if(strcasecmp($value, 'билайн') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-19.png)" data-title="Билайн"></span>';
}

$resIconListStr = implode(' ',$resIconList);
echo $resIconListStr;