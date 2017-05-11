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
	$order_status = req('order_status');
//	$ymd			= date('Y-m-d H:i:s');
//
//	// 确认收款
//	$sql = "UPDATE `t_user_order` SET `state`='3' WHERE `site_id`='$g_siteid' AND `order_code`='$order_code'";
//	$db->query($sql);
//
//	// 更新库存和订购量 (付款后减库存)
//	$sql = "SELECT * FROM `t_user_order` WHERE `site_id`='$g_siteid' AND `order_code`='$order_code' LIMIT 0,1";
//	$this_order = $db->get_one($sql);
//
//	$sku_id    = $this_order['sku_id'];
//	$adult_num = $this_order['adult_num'];
//	$kid_num   = $this_order['kid_num'];
//	$order_status   = '3';
//
//	$sql = "UPDATE `t_goods_sku` SET adult_sale_number=adult_sale_number+$adult_num , kid_sale_number=kid_sale_number+$kid_num , adult_stock=adult_stock-$adult_num , kid_stock=kid_stock-$kid_num WHERE `site_id`='$g_siteid' AND `sku_id`='".$sku_id."'";
//	$db->query($sql);

	//调接口(确认)
    $md5Str = $order_code."#".$order_status;
    $md5Str = md5($md5Str);//签名
    $url = $host . "/travel/interface/zbyV3.2/updateOrderAndUnifiedV3_2";//接口地址
    $post = array('orderCode' => $order_code, 'orderStatus' => $order_status, 'md5Str' => $md5Str);
    $confirm = $db->api_post($url, $post);
//    if($confirm['status'] == '0000') {
//        echo "<script>alert('成功');</script>";
////        exit;
//    }

	$url = "./?cmd=".base64_encode("order_detail.php").'&order_code='.$order_code;
	gourl($url);
}

//审核未通过
if($cmd == 'order_st'){
    $order_code = req('order_code');
    $order_status = req('order_status');
    $md5Str = $order_code."#".$order_status;
    $md5Str = md5($md5Str);//签名
    //调接口(确认)
//    echo "<script>alert($order_status);</script>";
//    echo $md5Str;
    $url = $host . "/travel/interface/zbyV3.2/updateOrderAndUnifiedV3_2";//接口地址
//    $url =  "http://192.168.0.223:8080/travel/interface/zby/v3.2/returnZbystatus_v3.2";//接口地址
    $post = array('orderCode' => $order_code, 'orderStatus' => $order_status, 'md5Str' => $md5Str);
    $confirm = $db->api_post($url, $post);
    $confirm = json_decode($confirm, true);
    $confirm_data = $confirm['data'];
    if($confirm['status'] == '0000' && $order_status == '3') {
        echo "<script>alert('确认成功！');</script>";
    }else if($confirm['status'] == '0000' && $order_status == '4') {
        echo "<script>alert('确认回团成功！');</script>";
    }else if($confirm['status'] == '0000' && $order_status == '9') {
        echo "<script>alert('确认审核不通过成功！');</script>";
    }else{
        exit();
    }
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

//添加退款记录
if ($cmd == 'order_refund_add'){
    $reason = req('reason');//退款原因
    $orderno = req('orderno');//订单号
    if(!is_numeric($orderno)) {
        echo"<script>alert('订单号必须为数字！');history.go(-1);</script>";
        die;
    } else {
        $sql = "SELECT * FROM t_refund_fee_apply  WHERE order_code = '$orderno'";
        $results = $db->get_one($sql);
        if ($results !== false){
            echo"<script>alert('该订单号已申请退款！');history.go(-1);</script>";
            die;
        } else {
            $sql = "SELECT a.*, b.gateway_id, b.gateway_order_code FROM t_user_order a, t_user_bill b WHERE a.order_code = '$orderno' AND b.site_order_code = '$orderno' AND a.state in (2,3)";
            $result = $db->get_one($sql);
            if ($result == false){
                echo"<script>alert('订单号不存在！');history.go(-1);</script>";
                die;
            } else {
                $create_time = date("Y-m-d H:i:s",time());
                $flag = '0';
                $order_code = $result['order_code'];
                $user_id = $result['user_id'];
                $user_type = $result['user_type'];
                $goods_type = $result['goods_type'];
                $order_fee = $result['pay_price'];
                $gateway_id = $result['gateway_id'];
                $gateway_order_code = $result['gateway_order_code'];
                $sql = "INSERT INTO `t_refund_fee_apply` (`create_time`,`flag`,`reason`,`order_code`,`user_id`,`user_type`,`goods_type`,`order_fee`,`gateway_id`,`gateway_order_code`) VALUES ('$create_time','$flag','$reason','$order_code','$user_id','$user_type','$goods_type','$order_fee','$gateway_id','$gateway_order_code')";
                $rst = $db->query($sql);
                echo"<script>alert('添加成功！')</script>";
                $url = "./?cmd=".base64_encode("order_refund.php");
                gourl($url);
            }
        }
    }
}
?>