<?  
include('auth.php'); 

include('config.php');

$my_total_fee    = req('price');
$my_pay_user     = req('user');
$my_order_code   = req('order_code');
$pay_type		 = req('pay_type');


// 查询支付配置
$sql = "SELECT `pay_config` FROM `t_site_pay` WHERE `site_id`='".$g_siteid."'"; 
$this_pay_config = $db->get_value($sql); 
$pay_config = unserialize($this_pay_config);


// 查询订单信息
$sql = "SELECT * FROM t_user_order WHERE `order_code`='$my_order_code' AND `site_id`='".$g_siteid."' ORDER BY order_id DESC";  
$order_items = $db->get_all($sql); 
if(notnull($order_items)){
	foreach ($order_items as $val){    	
	   $order_name .= $val['goods_name'].' ';
	   $order_desp .= $val['goods_name'].'('.$cval['buy_number'].'件) ';
	}
}

if($pay_type=='tenpay'){  //财付通 

	$pay_url = "/pay/tenpay/tenpay.php?price=$my_total_fee&user=$my_pay_user&order_code=$my_order_code";
	 
?>
<script type="text/javascript">
window.top.location.replace('<?=$pay_url?>');
</script>
<?
	exit();
}


if($pay_type=='alipay'){  //支付宝 

	$alipay_account = $pay_config['alipay']['account'];

	$pay_url = "/pay/alipaydirect/alipay.php?alipay_account=$alipay_account&order_code=$my_order_code&order_fee=$my_total_fee&order_name=$order_name&order_desp=$order_desp&goods_url=".urlencode($g_domain);
?>
<script type="text/javascript">
window.top.location.replace('<?=$pay_url?>');
</script>
<? 
	exit(); 
}


if($pay_type=='alipaywap'){  //支付宝手机端  

	$pay_url = "/pay/alipaywap/alipay.php?user_id=".$_COOKIE['CLOOTA_B2B2C_USER_UUID']."&order_code=$my_order_code&order_fee=$my_total_fee&order_name=$order_name&order_desp=$order_desp&goods_url=".urlencode($g_domain);
?>
<script type="text/javascript">
window.top.location.replace('<?=$pay_url?>');
</script>
<? 
	exit(); 
}

if($pay_type=='wxpay'){  //微信支付  

	$pay_url = "/pay/wxpay/jsapi.php?order_code=$my_order_code&order_fee=$my_total_fee";
?>
<script type="text/javascript">
window.top.location.replace('<?=$pay_url?>');
</script>
<? 
	exit(); 
}
?> 