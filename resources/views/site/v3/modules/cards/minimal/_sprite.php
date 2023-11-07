<?php
//$result_val = str_replace("\n",'',$result_val);
$result_val = mb_strtolower($result_val);
$iconList = explode(',', $result_val);

$resIconList = array();
foreach ($iconList as $key => $value) {

		$iconList[$key] = trim($value);
		$value = trim($iconList[$key]);

		if(strcasecmp($value, 'карта') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-3.png)" data-title="На банковскую карту"></span>';
		if(strcasecmp($value, 'qiwi') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-16.png)" data-title="На QIWI"></span>';
		if(strcasecmp($value, 'яндекс.деньги') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-12.png)" data-title="На ЮMoney (Яндекс.Деньги)"></span>';
		if(strcasecmp($value, 'юнистрим') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-11.png)" data-title="Через Юнистрим"></span>';
		if(strcasecmp($value, 'contact') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-13.png)" data-title="Через Contact"></span>';
		//if(strcasecmp($value, 'лидер') == 0)
		    //$resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-1.png)" data-title="На Лидер"></span>';
		if(strcasecmp($value, 'золотая корона') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-2.png)" data-title="Через Золотую Корону"></span>';
		if(strcasecmp($value, 'счет') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-10.png)" data-title="На банковский счет"></span>';
		if(strcasecmp($value, 'наличные') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-7.png)" data-title="Наличными"></span>';
		if(strcasecmp($value, 'наличными') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-7.png)" data-title="Наличными"></span>';
		if(strcasecmp($value, 'виза') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-17.png)" data-title="На карту Виза"></span>';
		if(strcasecmp($value, 'кукуруза') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-5.png)" data-title="На карту Кукурузу"></span>';
		if(strcasecmp($value, 'мастеркард') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-15.png)" data-title="На карту МастерКард"></span>';
		if(strcasecmp($value, 'маэстро') == 0)
		    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-14.png)" data-title="На карту Маэстро"></span>';
		if(strcasecmp($value, 'рапида') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-8.png)" data-title="Через Рапиду"></span>';
		if(strcasecmp($value, 'связной') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-9.png)" data-title="Через Связной"></span>';
		if(strcasecmp($value, 'вебмани') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-33.png)" data-title="Через WebMoney"></span>';
		if(strcasecmp($value, 'евросеть') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-1.png)" data-title="Через Евросеть"></span>';
		if(strcasecmp($value, 'элекснет') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-28.png)" data-title="Через Элекснет"></span>';
		//if(strcasecmp($value, 'робокасса') == 0)
			    //$resIconList [] = '<span class="sprite i-robokassa def_bg" style="background:url(/images/ic_pay/payment-1.png)" data-title="На Робокассу"></span>';
		if(strcasecmp($value, 'cyberplat') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-29.png)" data-title="Через CyberPlat"></span>';
		if(strcasecmp($value, 'терминалы') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-22.png)" data-title="В платежных терминалах"></span>';
		if(strcasecmp($value, 'смс') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-27.png)" data-title="С помощью СМС"></span>';
		if(strcasecmp($value, 'мтс') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-21.png)" data-title="Через МТС"></span>';
		if(strcasecmp($value, 'почта россии') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-23.png)" data-title="Через Почту России"></span>';
		if(strcasecmp($value, 'deltapay') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-30.png)" data-title="Через DeltaPay"></span>';
		if(strcasecmp($value, 'билайн') == 0)
			    $resIconList [] = '<span class="zaim-p-icon def_bg" style="background:url(/images/ic_pay/payment-19.png)" data-title="Через Билайн"></span>';
}

$resIconListStr = implode(' ',$resIconList);
echo $resIconListStr;