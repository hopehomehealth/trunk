<?
include('config.php');
header("Content-type: text/html; charset=gbk");

$ac			= req('ac');
$adult_num	= req('adult_num');
$kid_num	= req('kid_num');
$departdate	= req('departdate');

$db->query("set names utf8"); 

$sql = "SELECT * FROM `t_goods_thread` WHERE site_id='$g_siteid' AND goods_id=".req('goods_id');  
$detail = $db->get_one($sql); 

$sql = "SELECT *, DATE_FORMAT(`departdate`,'%Y%m%d') AS ymd FROM `t_goods_sku` WHERE `site_id`='$g_siteid' AND `goods_id`='".$detail['goods_id']."' AND `departdate`='$departdate'";
$goods_sku = $db->get_all($sql);
if(notnull($goods_sku)){
	foreach ($goods_sku as $sval){ 
		$adult_price_array[$sval['ymd']] = $sval['adult_price'];
		$adult_stock_array[$sval['ymd']] = $sval['adult_stock'];
		$kid_price_array[$sval['ymd']]   = $sval['kid_price'];
		$kid_stock_array[$sval['ymd']]   = $sval['kid_stock'];
		$diff_price_array[$sval['ymd']]  = $sval['diff_price']; 
	}
}
 
//$adult_price_array = unserialize(stripslashes($detail['adult_price']));
//$kid_price_array	 = unserialize(stripslashes($detail['kid_price']));
//$diff_price_array	 = unserialize(stripslashes($detail['diff_price']));

$adult_price	= $adult_price_array[$departdate];
$kid_price		= $kid_price_array[$departdate];
$diff_price		= $diff_price_array[$departdate];
$adult_stock	= $adult_stock_array[$departdate];
$kid_stock		= $kid_stock_array[$departdate];


if($adult_num%2 == 0){
	$diff_num = 0;
} else {
	$diff_num = 1;
}
?>

<?if($adult_num > $adult_stock){?>
<span id="adult_stock_false"></span>
<script>
document.getElementById('order_span').innerHTML = '<a href="javascript:void(0);" onclick="alert(\'���˿�治�㣬��ʣ<?=$adult_stock?>����\');return false;" class="btn btn-lg" id="order_button">��ʼԤ��</a>';
</script>
<?} elseif ($kid_num > $kid_stock){?> 
<script>
document.getElementById('order_span').innerHTML = '<a href="javascript:void(0);" onclick="alert(\'��ͯ��治�㣬��ʣ<?=$kid_stock?>����\');return false;" class="btn btn-lg" id="order_button">��ʼԤ��</a>';
</script>
<?} else {?>
<script>
document.getElementById('order_span').innerHTML = '<a href="javascript:void(0);" onclick="return order_window();" class="btn btn-lg" id="order_button">��ʼԤ��</a>';
</script>
<?}?>

<?if($ac == 'list'){?>
	<?if($adult_num>0){?>
	<?=$adult_num?>���� �� &yen;<?=$adult_price?> = &yen;<?=$adult_num * $adult_price?>
	<br/>
	<?}?>
	<?if($kid_num>0){?>
	<?=$kid_num?>��ͯ �� &yen;<?=$kid_price?> = &yen;<?=$kid_num * $kid_price?>
	<br/>
	<?}?>
	<?if($diff_num>0){?>
	�����&yen;<?=$diff_price*$diff_num?>
	<?}?>
<?}?>

<?if($ac == 'count'){?>
	&yen;<?=$adult_num * $adult_price + $kid_num * $kid_price + $diff_price*$diff_num?>
<?}?>