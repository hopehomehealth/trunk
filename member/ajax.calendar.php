<?
include('config.php');
header("Content-type: text/html; charset=gbk");
//$db->query("set names utf8");

$c_goods_id = req('goods_id');

$sql = "SELECT * FROM `t_goods_thread` WHERE  site_id='$g_siteid' AND goods_id='$c_goods_id'";  
$detail = $db->get_one($sql); 


$sql = "SELECT *, DATE_FORMAT(`departdate`,'%Y%m%d') AS ymd FROM `t_goods_sku` WHERE `site_id`='$g_siteid' AND `goods_id`='$c_goods_id' AND `departdate`>='".date('Y-m-d')."'";
$c_goods_sku = $db->get_all($sql);

if(notnull($c_goods_sku)){
	foreach ($c_goods_sku as $sval){ 
		$adult_price_array[$sval['ymd']] = $sval['adult_price'];
		$adult_stock_array[$sval['ymd']] = $sval['adult_stock'];
		$kid_price_array[$sval['ymd']]   = $sval['kid_price'];
		$kid_stock_array[$sval['ymd']]   = $sval['kid_stock'];
		$diff_price_array[$sval['ymd']]  = $sval['diff_price']; 
	}
} 

/// 价格体系
$adult_price  = $adult_price_array;//unserialize(stripslashes($c_goods['adult_price']));
$kid_price	  = $kid_price_array;//unserialize(stripslashes($c_goods['kid_price']));
$diff_price	  = $diff_price_array;//unserialize(stripslashes($c_goods['diff_price']));
$adult_stock  = $adult_stock_array;
$kid_stock	  = $kid_stock_array;


//$adult_price	= unserialize(stripslashes($detail['adult_price']));
//$kid_price 		= unserialize(stripslashes($detail['kid_price']));
//$diff_price		= unserialize(stripslashes($detail['diff_price']));


$yyyy = req('yyyy'); 
$mm = req('mm');


$curr_ym_html = date('Y年m月', strtotime($yyyy.'-'.$mm.'-01')); 
?> 
<div style="text-align:center;padding:10px 0px 0px 0px">
	<span><a href="javascript:change_calendar(<?=date("'Y','m'", strtotime('-1 month '.$yyyy.'-'.$mm.'-01'))?>)"><img src="/images/vcalendar_prev.gif" alt="前一月"></a></span>
	<span style="font-size:18px;padding-top:10px;"> &nbsp; <?=$curr_ym_html?> &nbsp; </span>
	<span><a href="javascript:change_calendar(<?=date("'Y','m'", strtotime('+1 month '.$yyyy.'-'.$mm.'-01'))?>)"><img src="/images/vcalendar_next.gif" alt="后一月"></a></span> 
</div>  

<ul class="date_ul">
	<li >日</li><li>一</li><li>二</li><li>三</li><li>四</li><li>五</li><li>六</li>
	<div style="clear:both"></div>
	<?
	$num_days = date("t",mktime(0,0,0,$mm,1,$yyyy));
	$first_day = date("N",mktime(0,0,0,$mm,1,$yyyy)); 
	$month_days = date('d', strtotime( $yyyy.'-'.$mm.'-01'." +1 month -1 day"));
	$last_day = date("N",mktime(0,0,0,$mm, $month_days, $yyyy)); 
	 
	if ($first_day!=7){
		for ($i=0; $i<$first_day; $i++){
			echo "<li class='date_grey' style='height:70px'>&nbsp;<br/>&nbsp;</li>";
		}
	}     

	for ($i=1; $i<=$num_days; $i++){
		if($i<10) $dd = '0'.$i; else $dd = $i;
 
		$this_adult_price = $adult_price[$yyyy.$mm.$dd];
		if($this_adult_price>0){
			$this_adult_price = '<span class="date_yen_text" title="成人价格"></span>&yen;'.$this_adult_price.'/人';				
		} else {
			$this_adult_price = '';
		}

		$this_kid_price = $kid_price[$yyyy.$mm.$dd];
		if($this_kid_price>0){
			$this_kid_price = '<span class="date_yen_text" title="儿童价格">儿童</span>&yen;'.$this_kid_price;				
		} else {
			$this_kid_price = '';
		}

		$this_diff_price = $diff_price[$yyyy.$mm.$dd];
		if($this_diff_price>0){
			$this_diff_price = '<span class="date_yen_text" title="单房差">房差</span>&yen;'.$this_diff_price;				
		} else {
			$this_diff_price = '';
		}

		echo "<li class='date_blue' style='height:70px'>".$i."<br/><span class='date_yen'>".$this_adult_price."</span><br/><span class='date_yen'>".$this_kid_price."</span><br/><span class='date_yen'>".$this_diff_price."</span></li>";
	}
	 
	for ($i=0; $i<6-$last_day; $i++){
		echo "<li class='date_grey' style='height:70px'>&nbsp;<br/>&nbsp;</li>";
	}

	?>
</ul>