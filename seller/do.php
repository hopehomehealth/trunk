<?  
include('auth.php');
include('config.php');
include($g_dir.'/libs/image_zoom.php');

$cmd = req('cmd');
$ymdhis = date('Y-m-d H:i:s');
$yyyymm = date('Ym');

/// 创建用户私有目录
$user_dir = $g_root."diy/$g_siteid/$g_tpl/";
if(file_exists($user_dir)==false){ 
	mkdir($user_dir, 0777, true);
}
 
 
function upload_image($fn, $upload_dir='', $fname=''){
	global $g_dir;

	$img = $_FILES[$fn]['name'];

	if($img!=""){
		$img_temp = $_FILES[$fn]['tmp_name'];

		$this_file_size = filesize($img_temp)/1024; 

		if($this_file_size>500){
			senderror("单个图片/附件不得超过500KB");
		} 

		$temp_arrays = explode(".", $img);
		$img_type = $temp_arrays[sizeof($temp_arrays)-1]; 
		$img_type = strtolower($img_type);
		if($img_type=="jpg" || $img_type=="jpeg" || $img_type=="swf" || $img_type=="gif" || $img_type=="png"){
			if($fname==''){
				$upfile_path = date('Ymdhis').mt_rand(10000,99999).".".$img_type;
			} else {
				$upfile_path = $fname;
			}

			if(file_exists($upload_dir)==false){
				mkdir($upload_dir, 0777);
			} 
			move_uploaded_file($img_temp, $upload_dir.$upfile_path);  

		} else {
			senderror("图片格式不正确。");
		}
	}  
	return $upfile_path;
} 

function get_ym_upfile($field_name){
	global $g_root, $g_siteid, $yyyymm;

	$upload_dir = "$g_root/upfiles/$g_siteid/$yyyymm/";

	$image_path = upload_image($field_name, $upload_dir);
	
	if($image_path!=''){
		$image_path = "$yyyymm/$image_path";
	} 
	return $image_path;
}

function upload_attach($fn, $upload_dir, $fname=''){
	global $g_dir;

	$img = $_FILES[$fn]['name'];

	if($img!=""){
		$img_temp = $_FILES[$fn]['tmp_name'];
		$temp_arrays = explode(".", $img);
		$img_type = $temp_arrays[sizeof($temp_arrays)-1]; 
		$img_type = strtolower($img_type);
		if($img_type=="pdf" || $img_type=="doc" || $img_type=="xls" || $img_type=="ppt" || $img_type=="txt" || $img_type=="zip" || $img_type=="rar"){
			if($fname==''){
				$upfile_path = date('Ymdhis').mt_rand(10000,99999).".".$img_type;
			} else {
				$upfile_path = $fname;
			}

			if(file_exists($upload_dir)==false){
				mkdir($upload_dir, 0777);
			}
			move_uploaded_file($img_temp, $upload_dir.$upfile_path);  

		} else {
			senderror("附件格式不正确。");
		}
	}  
	return $upfile_path;
} 

function batch_upload_image($img_name, $img_tmp_name, $upload_dir, $file_dir){
	global $g_dir;

	$img = $img_name;

	if($img!=""){
		$img_temp = $img_tmp_name;
		$temp_arrays = explode(".", $img);
		$img_type = $temp_arrays[sizeof($temp_arrays)-1]; 
		$img_type = strtolower($img_type);
		if($img_type=="jpg" || $img_type=="jpeg" || $img_type=="swf" || $img_type=="gif" || $img_type=="png"){
			if($fname==''){
				$upfile_path = date('Ymdhis').mt_rand(10000,99999).".".$img_type;
			} else {
				$upfile_path = $fname;
			}

			if(file_exists($upload_dir)==false){
				mkdir($upload_dir, 0777);
			}
			move_uploaded_file($img_temp, $upload_dir.$upfile_path);  

		} else {
			senderror("图片格式不正确。");
		}
	}  

	if($upfile_path!=''){
		return $file_dir.'/'.$upfile_path;
	} else {
		return '';
	}
} 
 
 

if($cmd == 'shop_passwd'){    
	$srcpassword	= req('srcpassword'); 
	$newpassword	= req('newpassword');
	$repassword		= req('repassword');

	$sql = "SELECT `shop_id` FROM `t_shop` WHERE `shop_id`='$g_shopid' AND `password`=MD5('$srcpassword') AND `site_id`='$g_siteid'";  
	$exist_account_id = $db->get_value($sql); 
 
	if($exist_account_id == ''){  
		senderror("对不起，原密码错误！"); 	
	}
 
	if($newpassword != $repassword){
		senderror('两次输入的新密码不一致！');
	}
  
	$sql = "UPDATE `t_shop` SET `password`=MD5('$newpassword') WHERE `site_id`='$g_siteid' AND `shop_id`='$g_shopid'";
	$db->query($sql);
	
	js('alert("密码修改成功，请重新登录！");location.replace("./logout")');

	exit();
}
         

//-----------------------------------------------------------// 订单管理

/// 订单改价
if($cmd == 'order_subtract_price'){
	$order_code			= req('order_code'); 
	$subtract_price		= req('subtract_price'); 
	
	$sql = "UPDATE `t_user_order` SET `subtract_price`='$subtract_price' WHERE `site_id`='$g_siteid' AND `order_code`='$order_code'";
	$db->query($sql);
	
	$sql = "SELECT `real_price` FROM `t_user_order` WHERE `site_id`='$g_siteid' AND `order_code`='$order_code' ";
	$pay_price = $db->get_value($sql); 
	
	// 更改实际价格
	$real_price = $pay_price - $subtract_price;
	
	$sql = "UPDATE `t_user_order` SET `real_price`='$real_price' WHERE `site_id`='$g_siteid' AND `order_code`='$order_code'";
	$db->query($sql);

	$url = "./?cmd=".base64_encode("order_detail.php").'&order_code='.$order_code;
	gotop($url);
} 

/// 确认收款
if($cmd == 'order_payed'){
	$order_code		= req('order_code');  
	$ymd			= date('Y-m-d H:i:s');

	// 确认收款
	$sql = "UPDATE `t_user_order` SET `state`='2' WHERE `site_id`='$g_siteid' AND `order_code`='$order_code'";
	$db->query($sql); 

	$url = "./?cmd=".base64_encode("order_detail.php").'&order_code='.$order_code;
	gotop($url);
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
	gotop($url);
}



if($cmd == 'shop_join_state'){   
	$state = req('state'); 
	$join_id = req('join_id'); 
	$unpass_note = req('unpass_note');
  
	$sql = "UPDATE `t_shop_join` SET `state`='$state', `unpass_note`='$unpass_note' WHERE join_id='$join_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("shop_join_list.php")."&p=".req('p');
	gotop($url);
}

if($cmd == 'shop_join_del'){    
	$join_id = req('join_id');  
  
	$sql = "DELETE FROM `t_shop_join` WHERE `join_id`='$join_id'";
	$db->query($sql);  
 
	$url = "./?cmd=".base64_encode("shop_join_list.php")."&kw=".req('kw')."&p=".req('p');
	gotop($url);
}


/// 旅游顾问

if($cmd == 'vcard_add'){   
	$profiles = addslashes(serialize($_POST));  
 
	$avatar = get_ym_upfile('avatar'); 
    
	$sql = "INSERT INTO `t_wx_vcard` ( `site_id`, `shop_id`, `avatar`, `profiles`, `state`, `addtime`) VALUES ( '$g_siteid', '$g_shopid', '$avatar', '$profiles', '1', '$ymdhis');"; 
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("wx_vcard.php")."&tabs_index=0";
	gotop($url);
}

if($cmd == 'vcard_del'){    
	$vcard_id = req('vcard_id'); 
  
	$sql = "DELETE FROM `t_wx_vcard` WHERE `vcard_id`='$vcard_id' AND `site_id`='$g_siteid'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("wx_vcard.php")."&tabs_index=0";
	gotop($url);
}

if($cmd == 'vcard_edit'){    
	$vcard_id	= req('vcard_id'); 

	$profiles	= addslashes(serialize($_POST));  
 
	$avatar		= get_ym_upfile('avatar'); 
   
	if($avatar!=''){
		$qer = " , `avatar`='$avatar' ";
	}  
  
	$sql = "UPDATE `t_wx_vcard` SET `profiles`='$profiles' $qer WHERE `site_id`='$g_siteid' AND `vcard_id`='$vcard_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("wx_vcard.php")."&tabs_index=0";
	gotop($url);
}

/// 加载扩展 ///
include('do.goods.php');
include('do.shop.php');
?>