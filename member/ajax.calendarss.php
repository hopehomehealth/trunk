<?
include('config.php');
header("Content-type: text/html; charset=gbk");
$goodsId = req('id');
$url =  $host . "/travel/interface/zbyV3.2/getZbyGoodsDtailV_3.2?goodsId=" . $goodsId;
$yyyy = req('yyyy');
$mm = req('mm');
$arr['dateTime'] = $yyyy.'-'.$mm;
$rst = $db->api_post($url, $arr);
$arrs = json_decode($rst, true);
$data = $arrs['data'];
$c_goods_sku = $data['dateCostList'];

if(notnull($c_goods_sku)){
    foreach ($c_goods_sku as $sval){
        $adult_price_array[$sval['departdate']] = $sval['kidPrice'];
    }
}

//价格体系
$adult_price  = $adult_price_array;

$curr_ym_html = date('Y年m月', strtotime($yyyy.'-'.$mm.'-01'));

?> 
<div style="text-align:center;padding:5px 0px 5px 0px;background-color: #1fcc9e;">
	<span><a href="javascript:change_calendar(<?=date("'Y','m'", strtotime('-1 month '.$yyyy.'-'.$mm.'-01'))?>)"><img src="/themes/s01/images/vcalendar_prev.png" alt="前一月" style="    margin-top: 3px"></a></span>
	<span style="font-size:18px;padding-top:10px;color: #fff;"> &nbsp; <?=$curr_ym_html?> &nbsp; </span>
	<span><a href="javascript:change_calendar(<?=date("'Y','m'", strtotime('+1 month '.$yyyy.'-'.$mm.'-01'))?>)"><img src="/themes/s01/images/vcalendar_next.png" alt="后一月" style="    margin-top: 3px"></a></span>
</div>  

<ul class="date_ul">
	<li class="date_week">日</li><li class="date_week">一</li><li class="date_week">二</li><li class="date_week">三</li><li class="date_week">四</li><li class="date_week">五</li><li class="date_week">六</li>
	<div style="clear:both"></div>
	<?
	$num_days = date("t",mktime(0,0,0,$mm,1,$yyyy));
	$first_day = date("N",mktime(0,0,0,$mm,1,$yyyy)); 
	$month_days = date('d', strtotime( $yyyy.'-'.$mm.'-01'." +1 month -1 day"));
	$last_day = date("N",mktime(0,0,0,$mm, $month_days, $yyyy)); 
	 
	if ($first_day!=7){
		for ($i=0; $i<$first_day; $i++){
			echo "<li class='date_grey' style='height:50px;background-color: #f9f9f9;'>&nbsp;<br/>&nbsp;</li>";
		}
	}     

	for ($i=1; $i<=$num_days; $i++){
		if($i<10) $dd = '0'.$i; else $dd = $i;
		$this_adult_price = $adult_price["$yyyy-$mm-$dd"];

        if($this_adult_price>0){
            $this_adult_price = '<span class="date_yen_text" title="成人价格"></span>&yen;'.$this_adult_price.'/人';
            echo "<li class='date_blue' style='height:50px;cursor: pointer'>".$i."<br/><span class='date_yen'>".$this_adult_price."</span></li>";
        } else {
            $this_adult_price = '';
            echo "<li class='date_blue' style='height:50px;color:#999;background-color: #f9f9f9;'>".$i."<br/><span class='date_yen'>"."$this_adult_price"."</span></li>";
        }
	}
	 
	for ($i=0; $i<6-$last_day; $i++){
		echo "<li class='date_grey' style='height:50px'>&nbsp;<br/>&nbsp;</li>";
	}

	?>
</ul>