<?

//-----------------------------------------------------------// 订单管理

/// 优惠减价
if($cmd == 'order_subtract_price'){
	$order_code			= req('order_code');
	$order_id			= req('order_id'); 
	$subtract_price		= req('subtract_price_'.$order_id); 
	
	$db->query("UPDATE `t_user_order` SET `subtract_price`='$subtract_price' WHERE `order_id`='$order_id'");
  
	$real_price = $db->get_value("SELECT `real_price` FROM `t_user_order` WHERE `order_id`='$order_id' "); 
	
	$real_price = $real_price - $subtract_price;

	$db->query("UPDATE `t_user_order` SET `real_price`='$real_price' WHERE `order_id`='$order_id'");

	$url = "./?cmd=".base64_encode("order.php").'&update_order_code='.$order_code;
	gourl($url);
}

/// 取消订单
if($cmd == 'order_close'){
	$order_code = req('order_code'); 
 
	$db->query("UPDATE `t_user_order` SET state='5' WHERE site_id='$g_siteid' AND `order_code`='$order_code'");

	gourl(url('order.php')); 
} 

// 删除订单
if($cmd == 'order_delete'){ 

	$order_code = req('order_code'); 

	$db->query("DELETE FROM `t_user_order` WHERE site_id='$g_siteid' AND `order_code`='$order_code' ");  

	$url = "./?cmd=".base64_encode("order.php")."&kw=".req('kw')."&state=".req('state')."&p=".req('p');
	gourl($url);
}

/// 确认收款
if($cmd == 'order_payed'){
	$order_code		= req('order_code');  
	$ymd			= date('Y-m-d H:i:s');

	// 确认收款
	$sql = "UPDATE `t_user_order` SET `state`='2' WHERE `site_id`='$g_siteid' AND `order_code`='$order_code'";
	$db->query($sql); 

	$url = "./?cmd=".base64_encode("order_detail.php").'&order_code='.$order_code;
	gourl($url);
} 

/// 订单确认
if($cmd == 'order_confirm'){
	$order_code		= req('order_code');  
	$ymd			= date('Y-m-d H:i:s');

	// 确认收款
	$sql = "UPDATE `t_user_order` SET `state`='3' WHERE `site_id`='$g_siteid' AND `order_code`='$order_code'";
	$db->query($sql);

	// 更新库存和订购量 (付款后减库存)
	$sql = "SELECT * FROM `t_user_order` WHERE `site_id`='$g_siteid' AND `order_code`='$order_code' LIMIT 0,1";
	$this_order = $db->get_one($sql); 
		
	$sku_id    = $this_order['sku_id'];
	$adult_num = $this_order['adult_num'];
	$kid_num   = $this_order['kid_num'];

	$sql = "UPDATE `t_goods_sku` SET adult_sale_number=adult_sale_number+$adult_num , kid_sale_number=kid_sale_number+$kid_num , adult_stock=adult_stock-$adult_num , kid_stock=kid_stock-$kid_num WHERE `site_id`='$g_siteid' AND `sku_id`='".$sku_id."'";
	$db->query($sql);

	$url = "./?cmd=".base64_encode("order_detail.php").'&order_code='.$order_code;
	gourl($url);
} 

/// 完成订单
if($cmd == 'order_success'){
	$order_code = req('order_code'); 
	$addtime	= date('Y-m-d H:i:s');

	// 确认收货，交易完成
	$db->query("UPDATE `t_user_order` SET state='4' WHERE site_id='$g_siteid' AND `order_code`='$order_code'");
	
	// 订单总额
	$sql = "SELECT * FROM `t_user_order` WHERE order_code='$order_code' LIMIT 0,1";
	$this_order = $db->get_one($sql);

	$real_price = $this_order['real_price'];
	$user_id = $this_order['user_id'];

	$score_number = round($real_price); //积分四舍五入

	// 创建用户积分
	$sql = "INSERT INTO `t_user_score` (`site_id`, `user_id`, `score_number`, `score_note`, `addtime`) VALUES ('$g_siteid', '$user_id', '$score_number', '订单赠送积分，订单号：".$order_code."，共计".$real_price."元', '$addtime')";
	$db->query($sql); 

	$url = "./?cmd=".base64_encode("order.php");
	gourl($url); 
}

/// 确认结算
if($cmd == 'order_settle'){ 
	$order_code   = req('order_code'); 
	$settle_money = req('settle_money'); 
	$addtime	  = date('Y-m-d H:i:s');

	// 确认收货，交易完成
	$sql = "UPDATE `t_user_order` SET `is_settle`='1', `settle_money`='$settle_money', `settle_date`='$addtime' WHERE `site_id`='$g_siteid' AND `order_code`='$order_code'"; 
	$db->query($sql);
	
	$url = "./?cmd=".base64_encode("order_report.php");
	gourl($url); 
}


/// 完成积分订单
if($cmd == 'score_order_success'){
	$order_id = req('order_id'); 
 
	$db->query("UPDATE `t_user_score_order` SET state='2' WHERE site_id='$g_siteid' AND `order_id`='$order_id'");

	$url = "./?cmd=".base64_encode("score_order.php")."&kw=".req('kw')."&state=".req('state')."&p=".req('p');
	gourl($url);
} 

/// 取消积分订单
if($cmd == 'score_order_cancel'){
	$order_id = req('order_id'); 
 
	$db->query("UPDATE `t_user_score_order` SET state='3' WHERE site_id='$g_siteid' AND `order_id`='$order_id'");

	$url = "./?cmd=".base64_encode("score_order.php")."&kw=".req('kw')."&state=".req('state')."&p=".req('p');
	gourl($url);
}

// 删除积分订单
if($cmd == 'score_order_delete'){ 

	$order_id = req('order_id'); 

	$db->query("DELETE FROM `t_user_score_order` WHERE site_id='$g_siteid' AND `order_id`='$order_id' ");  

	$url = "./?cmd=".base64_encode("score_order.php")."&kw=".req('kw')."&state=".req('state')."&p=".req('p');
	gourl($url);
}
?>