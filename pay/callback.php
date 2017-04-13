<?
function pay_callback($gateway_name, $site_order_code, $gateway_order_code, $total_fee){ 

	global $db, $g_siteid;

	$ymdhis = date("Y-m-d H:i:s");
	
	$log_dir = dirname(dirname(dirname(__FILE__)))."/logs/pay/";

	if(is_dir($log_dir) == false){
		mkdir($log_dir);
	}

	$log_file = $log_dir."paylog.$g_siteid.php";

	$fp=fopen($log_file, "a");
    fwrite($fp, "<?exit();?> $gateway_name 于 $ymdhis 支付订单 $site_order_code \r\n");
    fclose($fp);

	$sql = "SELECT `pay_id` FROM `t_user_bill` WHERE `site_id`='$g_siteid' AND `gateway_order_code`='".$gateway_order_code."'"; 
	$pay_id = $db->get_value($sql);  
	 
	if($pay_id == "") { 
		
		// 手机支付宝无法反馈金额，需要重新计算订单金额
		if($total_fee == '0'){ 
			$sql = "SELECT * FROM t_user_order WHERE `site_id`='$g_siteid' AND `order_code`='$site_order_code' ";  
			$order_items = $db->get_all($sql); 

			$total_fee = 0; 
			if(notnull($order_items)){
				foreach ($order_items as $cval){    	
					$total_fee += $cval['pay_price']-$cval['subtract_price'];
				}
			}
		}
		
		// 插入订单记录
		$sql = "INSERT INTO `t_user_bill` ( `gateway_name` , `site_id` , `site_order_code` , `gateway_order_code` , `total_fee` , `addtime` ) VALUES ( '$gateway_name', '$g_siteid', '$site_order_code' , '$gateway_order_code' , '$total_fee', '$ymdhis')"; 
		$db->query($sql);   
		
		// 更新订单状态
		$sql = "UPDATE `t_user_order` SET state='2' WHERE `site_id`='$g_siteid' AND `order_code`='$site_order_code'";
		$db->query($sql);


		// 更新库存和订购量 (付款后减库存)
		$sql = "SELECT * FROM `t_user_order` WHERE `site_id`='$g_siteid' AND `order_code`='$site_order_code' LIMIT 0,1";
		$this_order = $db->get_one($sql); 
		
		$sku_id    = $this_order['sku_id'];
		$adult_num = $this_order['adult_num'];
		$kid_num   = $this_order['kid_num'];

		$sql = "UPDATE `t_goods_sku` SET adult_sale_number=adult_sale_number+$adult_num , kid_sale_number=kid_sale_number+$kid_num , adult_stock=adult_stock-$adult_num , kid_stock=kid_stock-$kid_num WHERE `site_id`='$g_siteid' AND `sku_id`='".$sku_id."'";
		$db->query($sql);
	}
} 
?>