<?php
function getMonthCount($time_){

		$time_ = str_replace('(', '',$time_);
		$time_ = str_replace(')', '',$time_);
		$time_ = str_replace(' ', '',$time_);

		$arr ['1месяц'] = 1;
		$arr ['3месяца'] = 3;
		$arr ['6месяцев'] = 6;
		$arr ['9месяцев'] = 9;
		$arr ['1год12месяцев'] = 12;
		$arr ['2года24месяцев'] = 24;
		$arr ['3года36месяцев'] = 36;
		$arr ['4года48месяцев'] = 48;
		$arr ['5лет60месяцев'] = 60;
		$arr ['6лет72месяцев'] = 72;
		$arr ['7лет84месяцев'] = 84;
		$arr ['10лет120месяцев'] = 120;
		$arr ['15лет'] = 180;
		$arr ['20лет'] = 240;
		$arr ['25лет'] = 300;
		$arr ['30лет'] = 360;
		if(!isset($arr[$time_])) return 'любой';

		return $arr[$time_];
	}
?>


	<div class="credit-carts-wrap">

	<?php echo "<h4 class='res-h4-c'>Подобрано ".count($cards); ?>
	{!! System::endWords(count($cards),['кредит','кредита','кредитов']) !!}
	<?php echo "</h4><br>\n"; ?>

	<?php if(count($cards) > 0) : ?>
	
	<?php foreach ($cards as $key => $value) : ?>
		<div class="item">
			<div class="left">
				<img src="<?php echo $value->logo; ?>" alt="<?php echo $value->title; ?>"><br>
				<?php if($value->link_type == 1) $link = $value->link_1; else $link = $value->link_2; ?>
                        		<a href="{{$link}}" target="_blank" class="form-btn1 no-print" onclick="yaCounter38176370.reachGoal('$value->yandex_event'); return true;">Оформить</a>
			</div>
			<div class="right">
				<div class="name-line"><?php echo $value->title; ?></div>
				<div class="refresh-item">
	                    <i class="fa fa-refresh"></i> <span>Обновлено</span><br><span><?php echo \App\Algorithms\Frontend\Cards\CardDate::setUpdateDate($value->updated_at); ?></span>
				</div>


				<div class="line line-50">
					<div class="i1">
					<label for="">Сумма:</label><br>
					<?php $sum_min = number_format($value->sum_min, 0, '.', ' '); ?>
					<?php $sum_max = number_format($value->sum_max, 0, '.', ' '); ?>
					<?= $sum_min ?> - <?= $sum_max ?> ₽
					</div>
					<div class="i2">
					<label for="">Срок:</label><br>
					от <?= $value->term_min ?> до <?= $value->term_max ?> недель
					</div>
				</div>

				<div class="line line-50">
					<div class="i1">
					<label for="">Скорость рассмотрения заявки:</label><br>
					<?= $value->speed_see ?>
					</div>
					<div class="i2">
					<label for="">Регистрация:</label><br>
					<?= $value->register ?> 
					</div>

				</div>

				<div class="line line-50">
					<div class="i1">
					<label for="">Документы:</label><br>
					<?= $value->docs ?> 
					</div>
					<div class="i2">
					<label for="">Процентная ставка:</label><br>
					от <?= $value->percent_min ?>%  
					<?php if($value->percent_max) : ?>
						до <?= $value->percent_max ?>%
					<?php endif; ?>
					</div>					
				</div>				


			</div> <!-- end right -->
			<div class="read-more-wrap">


<?php
$percent = $value->header_3;
$sum = $request_sum;
$term =  addslashes(stripslashes(htmlspecialchars(strip_tags($request_term)))); 

$term = getMonthCount($term);

if($term != 'любой'){


	$percent = str_replace(',', '.', $percent);
	$percent = (float) $percent;

	$addPercent = round(($percent / 100 / 12),5);

	if((pow((1 + $addPercent),$term)-1) != 0){
		$month_p_res = $sum * ($addPercent + ($addPercent / ((pow((1 + $addPercent),$term))-1)));
		$over_p_res = ($month_p_res * $term ) - $sum;
	} else {
		$month_p_res = 'Ошибка расчета: в базе не указан процент';
		$over_p_res = 'Ошибка расчета: в базе не указан процент';
	}


?>

				<div class="line">
					<div class="i1">
						<img src="/vzo_theme/img/precent_zaymer.png" alt="">
						<span>Ставка в год: <?= $percent ?>%</span>
					</div>
					<div class="i2">
						<img src="/vzo_theme/img/donation_zaymer.png" alt="">
						<span>Платеж: <?php if(gettype($month_p_res) != 'string') echo number_format($month_p_res, 0, '.', ' ').' ₽/мес.'; else echo $month_p_res; ?></span>
					</div>
					<div class="i3">
						<img src="/vzo_theme/img/rich_zaymer.png" alt="">
						<span>Переплата:  <?php if(gettype($over_p_res) != 'string') echo number_format($over_p_res, 0, '.', ' ').' ₽'; else echo $over_p_res; ?></span>
					</div>
				</div>

<?php } else { ?>

				<div class="line">
					<div class="i1 error">
						Невозможно рассчитать кредит, так как вы не указали срок.
					</div>

				</div>

<?php } ?>

			</div>
		</div>
	<?php endforeach; ?>

	<?php endif; ?>

	</div>

<style>
.credit-carts-wrap{margin: 0 auto 50px;}
.credit-carts-wrap .item{border: 2px solid #F1F1F1;padding: 15px;margin: 10px 0;}
.credit-carts-wrap .item .left{display: inline-block;width: 30%;}
.credit-carts-wrap .item .left img{max-width: 100%;margin: 10px;vertical-align: -13px;}
.credit-carts-wrap .item .left a{color: #fff;padding: 0 53px;text-decoration: none;}
.credit-carts-wrap .item .right{display: inline-block;width: 69%;position: relative;vertical-align: top;}
.credit-carts-wrap .item .right .refresh-item{position: absolute;right: 0;top: 0;}
.credit-carts-wrap .item .right .refresh-item span{color: #7f7f7f;font-size: 15px;}
.credit-carts-wrap .item  .line{  display: flex;margin-top: 30px;}
.credit-carts-wrap .item  .line > div{    padding: 0 10px;}
.credit-carts-wrap .read-more-wrap .line  {  margin: 10px 0;}
.credit-carts-wrap .read-more-wrap .line  div{  width: 33%}
.credit-carts-wrap .item  .line label{   color: #7f7f7f;}
.credit-carts-wrap .item  .line > div img{    margin-right: 10px;}
.credit-carts-wrap .item  .line > div span{}
.line-50 > div{width: 50%;}
.credit-carts-wrap .item .read-more-wrap{margin-top: 10px;border-top: 1px solid #F1F1F1;padding: 15px 0 0;text-align: center; }
.credit-carts-wrap  .name-line{padding: 0 100px 0 20px;font-weight: bold;font-size: 18px;}
.i1.error{text-align: center;width: 100% !important;color: red; }
.credit-carts-wrap .item .read_more_cart{color: #00b6f7;cursor: pointer;padding: 18px;width: 100px;outline: none;
	font-size: 17px;transition: 0.4s;text-align: center;border: none;display: block;margin: auto;}
@media (max-width: 786px) {
	.credit-carts-wrap .item .right, .credit-carts-wrap .item .left{width: 100%;}
	.credit-carts-wrap .refresh-item br{display: none}
	.credit-carts-wrap .refresh-item span{margin:0 5px}
	.credit-carts-wrap .name-line {padding: 0;}
	.credit-carts-wrap .item .left {text-align: center;}
	.credit-carts-wrap .item .right .refresh-item {position: relative;}
}
</style>