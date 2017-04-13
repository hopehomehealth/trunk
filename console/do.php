<?  
include('do.common.php'); 

//-----------------------------------------------------------// 系统账户

if($cmd == 'account_add'){  
	$account 		= req('account'); 
	$password		= req('password');  
	$repassword 	= req('repassword');
	$username 		= req('username'); 
	$email 			= req('email'); 
	$mobile 		= req('mobile'); 

	if($password != $repassword){
		senderror('两次密码不一致！');
	}

	$sql = "SELECT `account_id` FROM `t_admin` WHERE `account`='$account' AND `site_id`='$g_siteid'";  
	$exist_account_id = $db->get_value($sql); 
 
	if($exist_account_id != ''){  
		senderror("对不起，该用户已经存在！"); 	
	}
  
	$sql = "INSERT INTO `t_admin` (`site_id` , `account` , `password` , `username`, `email` , `mobile` , `addtime` ) VALUES ('$g_siteid', '$account', md5('$password'), '$username', '$email', '$mobile', '$ymdhis')";
	
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("account.php")."&tabs_index=0";
	gourl($url);
}

if($cmd == 'account_del'){    
	$account_id = req('account_id'); 
  
	$sql = "DELETE FROM `t_admin` WHERE `account_id`='$account_id' AND `site_id`='$g_siteid'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("account.php")."&tabs_index=0";
	gourl($url);
}
if($cmd == 'account_edit'){   
	$item			= req('item'); 
	$account_id		= req('account_id');
	$item_val		= req($item);
  
	$sql = "UPDATE `t_admin` SET ".$item."='$item_val' WHERE `site_id`='$g_siteid' AND `account_id`='$account_id'";
	$db->query($sql);  

	sendresult("已保存更改");
}
if($cmd == 'account_passwd'){   
	$account_id		= req('account_id'); 
	$srcpassword	= req('srcpassword'); 
	$newpassword	= req('newpassword');
	$repassword		= req('repassword');

	$sql = "SELECT `account_id` FROM `t_admin` WHERE `account_id`='$account_id' AND `password`=MD5('$srcpassword') AND `site_id`='$g_siteid'";  
	$exist_account_id = $db->get_value($sql); 
 
	if($exist_account_id == ''){  
		senderror("对不起，原密码错误！"); 	
	}
 
	if($newpassword != $repassword){
		senderror('两次输入的新密码不一致！');
	}
  
	$sql = "UPDATE `t_admin` SET `password`=MD5('$newpassword') WHERE `site_id`='$g_siteid' AND `account_id`='$account_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("account.php")."&tabs_index=1";
	gourl($url);
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

//-----------------------------------------------------------// 站点设置

// 站点基本设置
if($cmd == 'site_setting'){  
	$site_name 			= req('site_name'); 
	$city_name			= req('city_name');  
	$style_name			= req('style_name');
	$mobile_style_name	= req('mobile_style_name');
	$page_title			= req('page_title');  
	$page_description 	= req('page_description');
	$page_keywords 		= req('page_keywords');  
	$site_notice		= req('site_notice');
	$common_code 		= addslashes($_POST['common_code']); 
	$mobile_common_code	= addslashes($_POST['mobile_common_code']); 

	$logo = get_ym_upfile('logo'); 
   
	if($logo!=''){
		$qer = "`logo`='$logo',";
	} 
  
	$sql = "UPDATE `t_site_config` SET `site_name`='$site_name', `city_name`='$city_name', `style_name`='$style_name', `site_notice`='$site_notice', `mobile_style_name`='$mobile_style_name', $qer `page_title`='$page_title', `page_description`='$page_description', `page_keywords`='$page_keywords', `common_code`='$common_code', `mobile_common_code`='$mobile_common_code' WHERE `site_id`='".$g_siteid."'";
	
	$db->query($sql);  

	site_cache();

	$url = "./?cmd=".base64_encode("setting_site.php");
	gourl($url);
}
// 站点域名设置
if($cmd == 'site_domain'){      
	$domain = strtolower(req('site_domain')); 

	if(!preg_match("/^[0-9a-zA-Z]+[0-9a-zA-Z\.-]*\.[a-zA-Z]{2,4}$/", $domain)){
		senderror('对不起，域名格式非法。');
	} 

	if(strpos($domain, 'www.')!==false){
		$first_pos = strpos($domain, '.');
		$root_domain = substr($domain, $first_pos+1);
	} else {
		$root_domain = '';
	}
  
	$mobile_domain = req('mobile_domain');  

	// 原域名
	$sql = "SELECT `site_domain` FROM `t_site_config` where site_id='$g_siteid'";  
	$last_domain = $db->get_value($sql);
 
	$sql = "UPDATE `t_site_config` SET `site_domain`='$domain', `root_domain`='$root_domain', `mobile_domain`='$mobile_domain' WHERE `site_id`='".$g_siteid."' ";
	$db->query($sql);  


	// 更新站点配置缓存，如果域名变化，则删除变化之前的域名配置文件
	site_cache(); 

	/*
	// 域名别名
	$serveralias = '';
	$sql = "SELECT `root_domain`,`site_domain`,`mobile_domain` FROM `t_site_config` WHERE `root_domain`<>''";  
	$all_site = $db->get_all($sql); 
	if(sizeof($all_site)>0){
		foreach ($all_site as $val){ 
			$serveralias .= ' '.$val['root_domain'].' '.$val['site_domain'].' '.$val['mobile_domain'];
		}
	}   
	// 自动生成Apache配置Alias文件
	if(trim($serveralias!='')){
		$serveralias = 'ServerAlias '.$serveralias;

		$fp = fopen($g_dir."/domain.conf", "w+");
		fwrite($fp, $serveralias);
		fclose($fp);  
	}  
	*/

	$url = "./?cmd=".base64_encode("setting_domain.php");
	gourl($url);
}
if($cmd == 'site_setting_other'){  
	$misc = serialize($_POST);  
  
	$sql = "UPDATE `t_site_config` SET `misc`='$misc'  WHERE `site_id`='".$g_siteid."'"; 
	$db->query($sql);  

	site_cache();

	$url = "./?cmd=".base64_encode("setting_other.php");
	gourl($url);
}
if($cmd == 'site_connect'){  
	$qq_appid		= req('qq_appid');  
	$qq_appkey		= req('qq_appkey'); 
	$qq_auth		= req('qq_auth');  
	$sina_appid		= req('sina_appid');  
	$sina_appkey	= req('sina_appkey');  
	$sina_auth		= req('sina_auth'); 
	$taobao_appid	= req('taobao_appid');  
	$taobao_appkey	= req('taobao_appkey'); 
	$taobao_auth	= req('taobao_auth');
	
	$sql = "SELECT * FROM `t_site_connect` where site_id='$g_siteid'";  
	$exist_connect = $db->get_one($sql);

	if($exist_connect['connect_id']==''){ 
		$sql = "INSERT INTO `t_site_connect` ( `site_id` , `qq_appid` , `qq_appkey` , `qq_auth`, `sina_appid` , `sina_appkey` , `sina_auth`, `taobao_appid` , `taobao_appkey`, `taobao_auth` ) VALUES ('$g_siteid', '$qq_appid', '$qq_appkey', '$qq_auth', '$sina_appid', '$sina_appkey', '$sina_auth', '$taobao_appid', '$taobao_appkey', '$taobao_auth')";
		$db->query($sql);   
	} else {
		$sql = "UPDATE `t_site_connect` SET `qq_appid`='$qq_appid' , `qq_appkey`='$qq_appkey' , `qq_auth`='$qq_auth', `sina_appid`='$sina_appid' , `sina_appkey`='$sina_appkey', `sina_auth`='$sina_auth', `taobao_appid`='$taobao_appid' , `taobao_appkey`='$taobao_appkey', `taobao_auth`='$taobao_auth' WHERE `site_id`='$g_siteid'";
		$db->query($sql);  
	}

	site_cache();

	$url = "./?cmd=".base64_encode("setting_connect.php");
	gourl($url);
}
// OTA资料
if($cmd == 'site_profile'){  
	$profile = serialize($_POST);  
  
	$sql = "UPDATE `t_site_config` SET `profile`='$profile'  WHERE `site_id`='".$g_siteid."'"; 
	$db->query($sql);  
  
	site_cache(); 
 
	$url = "./?cmd=".base64_encode("setting_profile.php");
	gourl($url);
}
// 在线客服设置
if($cmd == 'site_setting_im'){   
 
	$alert_email 		= req('alert_email');  
	$qq_list 			= req('qq_list'); 
	$wangwang_list 		= req('wangwang_list'); 
 
	if($alert_email==''){
		senderror('请输入邮件地址');
	} 

	$sql = "UPDATE `t_site_config` SET `alert_email`='$alert_email', `qq_list`='$qq_list', `wangwang_list`='$wangwang_list'   WHERE `site_id`='".$g_siteid."'";
	$db->query($sql);

	site_cache();

	$url = "./?cmd=".base64_encode("setting_im.php");
	gourl($url);
}

if($cmd == 'site_setting_weixin'){  
	$wx = serialize($_POST);  
  
	$sql = "UPDATE `t_site_config` SET `wx_config`='$wx'  WHERE `site_id`='".$g_siteid."'"; 
	$db->query($sql);  

	site_cache();

	$url = "./?cmd=".base64_encode("wx_setting.php");
	gourl($url);
}

//-----------------------------------------------------------// 模板设置

if($cmd == 'theme_setting'){  
	$tpl_name = req('tpl_name');   
	$type = req('type'); 

	if($type == 'site'){
		$qer = "`tpl_name`='$tpl_name'";
	} 
	elseif($type == 'mobile'){
		$qer = "`mobile_tpl_name`='$tpl_name'";
	}
	else {
		die('FATAL ERROR');
	}
 
	$sql = "UPDATE `t_site_config` SET $qer WHERE `site_id`='".$g_siteid."' ";
	 
	$db->query($sql);  

	site_cache();

	$url = "./?cmd=".base64_encode("theme.php");
	gourl($url);
}


//-----------------------------------------------------------// 支付设置

if($cmd == 'site_pay'){  
	 
	$pay_config = serialize($_POST);

	$sql = "SELECT cfg_id FROM `t_site_pay` WHERE site_id='$g_siteid'";
	$rs = $db->get_value($sql);  

	if(empty($rs)==false){
		$sql = "UPDATE `t_site_pay` SET `pay_config`='$pay_config' WHERE `site_id`='".$g_siteid."' ";
	} else { 
		$sql = "INSERT INTO `t_site_pay` (`site_id` , `pay_config` ) VALUES ('".$g_siteid."', '$pay_config' ) ";
	}
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("setting.php")."&tabs_index=5";;
	gourl($url);
}


//-----------------------------------------------------------// 产品分类

if($cmd == 'goods_cat_add'){  
	$parent_id 			= req('parent_id'); 
	$cat_name 			= req('cat_name');  
	$cat_ico 			= req('cat_ico');
	$cat_key 			= strtolower(req('cat_key'));
	$goods_type			= req('goods_type'); 
	$order_id 			= req('order_id'); 

	if (ctype_alpha($cat_key) == false) {
		senderror('对不起，关键词只能由字母组成！');
	}

	if(strpos($cat_name,'^')!==false){
		$arr = explode('^', $cat_name);
		$m = 0;
		foreach ($arr as &$v) { 
			if($v!=''){
				$sql = "INSERT INTO `t_goods_catalog` ( `site_id`, `parent_id` , `goods_type`, `cat_name`, `cat_key`, `order_id` ) VALUES ( '$g_siteid', '$parent_id', '$goods_type', '$v', '".$cat_key.$m."', '".($order_id+$m)."' )"; 
				$db->query($sql);  
				$m++;
			}
		}

	} else { 
		$sql = "INSERT INTO `t_goods_catalog` ( `site_id`, `parent_id`, `goods_type`, `cat_name`, `cat_key`, `order_id` ) VALUES ( '$g_siteid', '$parent_id', '$goods_type', '$cat_name', '$cat_key', '$order_id' )";
		
		$db->query($sql);  
	}

	$url = "./?cmd=".base64_encode("goods_cat.php");
	gourl($url);
}

if($cmd == 'goods_cat_del'){    
	$cat_id = req('cat_id'); 

	$sql = "SELECT cat_id FROM `t_goods_catalog` WHERE parent_id='$cat_id' AND site_id='$g_siteid'";
	$rs = $db->get_value($sql); 
	if($rs!=''){
		senderror('不能删除，该分类存在下级分类，请先删除下级分类！');
	}

	$sql = "SELECT goods_id FROM `t_goods_thread` WHERE cat_id='$cat_id' AND site_id='$g_siteid'";
	$rs = $db->get_value($sql); 
	if($rs!=''){
		senderror('不能删除，该分类存在产品，请先删除产品！');
	}
  
	$sql = "DELETE FROM `t_goods_catalog` WHERE site_id='$g_siteid' AND cat_id='$cat_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("goods_cat.php");
	gourl($url);
}

if($cmd == 'goods_cat_update'){   
	$cat_id				= req('cat_id');
	$goods_type			= req('goods_type'); 
	$parent_id 			= req('parent_id');
	$cat_name 			= req('cat_name');   
	$cat_key 			= strtolower(req('cat_key'));
	$order_id 			= req('order_id'); 
	$is_hot				= req('is_hot'); 
	$cat_note			= req('cat_note');
	$page_title			= req('page_title');
	$page_description	= req('page_description');
	$page_keywords		= req('page_keywords'); 
	
	$qer = '';

	if (ctype_alpha($cat_key) == false) {
		senderror('对不起，关键词只能由字母组成！');
	}


	// 分类图标 
	$cat_ico = get_ym_upfile('cat_ico'); 

	if($cat_ico!='') { 
		$qer .= "`cat_ico`='$cat_ico',";
	}
 
	$sql = "UPDATE `t_goods_catalog` SET `parent_id`='$parent_id', `goods_type`='$goods_type', `cat_name`='$cat_name', `cat_key`='$cat_key', order_id='$order_id', $qer `is_hot`='$is_hot', `cat_note`='$cat_note', `page_title`='$page_title', `page_description`='$page_description', `page_keywords`='$page_keywords' WHERE site_id='$g_siteid' AND cat_id='$cat_id'";
	$db->query($sql);  
	
	$url = "./?cmd=".base64_encode("goods_cat.php");
	gourl($url);
	 
} 

if($cmd == 'goods_cat_edit'){   
	$item = req('item'); 
	$cat_id = req('cat_id');

	$sql = "UPDATE `t_goods_catalog` SET ".$item."='".req($item)."' WHERE site_id='$g_siteid' AND cat_id='$cat_id'";
	$db->query($sql); 
	
	sendresult("已保存更改"); 
} 
  
//-----------------------------------------------------------// 楼层

if($cmd == 'goods_floor_add'){   
	$goods_type 		= req('goods_type');
	$floor_title 		= req('floor_title');  
	$floor_color 		= req('floor_color');
	$order_id 			= req('order_id');  
	$parent_id 			= req('parent_id'); 
	$catalog 			= serialize($_POST['catalog']); 
	
	if( empty($floor_title) ){
		senderror('请填写标题！');
	}
  
	$sql = "INSERT INTO `t_goods_floor` ( `site_id` , `goods_type`, `parent_id`, `floor_title` , `floor_color` , `catalog` , `order_id` , `state` ) VALUES ( '$g_siteid', '$goods_type', '$parent_id', '$floor_title', '$floor_color', '$catalog', '$order_id', '1' ); ";
	
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("goods_floor.php")."&goods_type=".$goods_type;
	gourl($url);
}
if($cmd == 'goods_floor_del'){    
	$floor_id = req('floor_id'); 
  
	$sql = "DELETE FROM `t_goods_floor` WHERE `site_id`='$g_siteid' AND floor_id='$floor_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("goods_floor.php");
	gourl($url);
}

if($cmd == 'goods_floor_edit'){   
	$item = req('item'); 
	$floor_id = req('floor_id');
  
	if($item=='catalog'){ 
		$catalog = serialize($_POST['catalog']); 
		$sql = "UPDATE `t_goods_floor` SET catalog='$catalog' WHERE `site_id`='$g_siteid' AND floor_id='$floor_id'";
		$db->query($sql); 
	} else {
		$sql = "UPDATE `t_goods_floor` SET ".$item."='".req($item)."' WHERE `site_id`='$g_siteid' AND floor_id='$floor_id'";
		$db->query($sql);  
	}

	sendresult("已保存更改");
}


//-----------------------------------------------------------// 产品主题

if($cmd == 'goods_mode_add'){   
	$mode_name 		= req('mode_name');  
	$mode_key 		= req('mode_key');
	$order_id 		= req('order_id');  
  
	$sql = "INSERT INTO `t_goods_mode` (`site_id` , `mode_name` , `mode_key`,  `order_id` ) VALUES ('$g_siteid', '$mode_name', '$mode_key', '$order_id' )";
	
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("goods_mode.php");
	gourl($url);
}

if($cmd == 'goods_mode_del'){    
	$mode_id = req('mode_id'); 
  
	$sql = "DELETE FROM `t_goods_mode` WHERE `site_id`='$g_siteid' AND mode_id='$mode_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("goods_mode.php");
	gourl($url);
}

if($cmd == 'goods_mode_edit'){   
	$item = req('item'); 
	$mode_id = req('mode_id');

	if($item == 'mode_image'){ 
		$mode_image = get_ym_upfile('mode_image');  

		$sql = "UPDATE `t_goods_mode` SET `mode_image`='$mode_image' WHERE `site_id`='$g_siteid' AND `mode_id`='$mode_id'";
		$db->query($sql); 
		
		$url = "./?cmd=".base64_encode("goods_mode.php");
		gotourl($url);

	} else {  
		$sql = "UPDATE `t_goods_mode` SET ".$item."='".req($item)."' WHERE `site_id`='$g_siteid' AND mode_id='$mode_id'";
		$db->query($sql);  
		sendresult("已保存更改");
	} 
}

if($cmd == 'goods_mode_join'){   
	$goods_array = $_POST['goods_box'];
	$mode_id = req('mode_id');

	$len = sizeof($goods_array);

	if($len>0){
		for($i=0; $i<$len; $i++){ 
			$goods_id = $goods_array[$i];

			$rs = $db->get_value("SELECT goods_id FROM `t_goods_join` WHERE `site_id`='$g_siteid' AND  mode_id='$mode_id' AND goods_id='$goods_id'");

			if($rs == ''){
				$sql = "INSERT INTO `t_goods_join` ( `site_id` , `mode_id` , `goods_id` , `order_id` ) VALUES ( '".$g_siteid."', '$mode_id', '$goods_id', '$i' );";
				$db->query($sql);
			}
		}
	}	 
	sendresult("已加入组合");
}

if($cmd == 'mode_result_del'){    
	$mode_id = req('mode_id');
	$join_id = req('join_id');
  
	$sql = "DELETE FROM `t_goods_join` WHERE `site_id`='$g_siteid' AND join_id='$join_id'";
	$db->query($sql);  
 
	$url = "./?cmd=".base64_encode("goods_mode_result.php")."&modal=true&mode_id=$mode_id";
	js("location.replace('$url');"); 
	exit();
}

if($cmd == 'mode_result_edit'){   
	$item = req('item'); 
	$join_id = req('join_id');
  
	$sql = "UPDATE `t_goods_join` SET ".$item."='".req($item)."' WHERE 1=1 AND join_id='$join_id'";
	$db->query($sql);  

	sendresult("已保存更改");
}

//-----------------------------------------------------------// 评价
/// 删除评价
if($cmd == 'comment_del'){    
	$comment_id = req('comment_id');

	$sql = "DELETE FROM `t_goods_comment` WHERE site_id='$g_siteid' AND comment_id='$comment_id'";
	$db->query($sql); 
 
	$url = "./?cmd=".base64_encode("comment_list.php");
	gourl($url);
} 

/// 新增评价
if($cmd == 'comment_add'){ 
	$goods_ids		= req('goods_ids');
	$user_ids		= req('user_ids');
	$comment_level	= req('comment_level');
	$comment_star	= req('comment_star');
	$content		= req('content');
	$addtime		= date('Y-m-d H:i:s'); 

	$user_array = explode("\n", $user_ids);
	foreach ($user_array as &$v) {
		$v = trim($v);
		if($v!=''){
			$qer .= ",".$v;
		}
	}
	
	// 随机用户ID
	$sql = "SELECT `user_id` FROM `t_user` WHERE site_id='$g_siteid' AND `user_id` IN ( -1 $qer ) ORDER BY RAND() LIMIT 0,1";
	$rand_user_id = $db->get_value($sql); 
	
	$v = '';
	$goods_array = explode("\n", $goods_ids);
	foreach ($goods_array as &$v) {
		$v = trim($v);
		if($v!=''){
			$sql = "SELECT `goods_id` FROM `t_goods_thread` WHERE site_id='$g_siteid' AND `goods_id`='$v' ";
			$exist_goods_id = $db->get_value($sql); 

			if($exist_goods_id!='' && $rand_user_id!=''){ 
				$sql = "INSERT INTO `t_goods_comment` (`subject_id`, `is_first`, `site_id`, `goods_id`, `user_id`, `comment_level`, `comment_star`, `content`, `addtime` ) VALUES ('0', '1', '$g_siteid', '$v', '$rand_user_id', '$comment_level', '$comment_star', '$content', '$addtime' )";
				$db->query($sql); 
			}
		}
	}

	$url = "./?cmd=".base64_encode("comment_list.php");
	gourl($url);
} 

if($cmd == 'comment_fast_edit'){   
	$item = req('item'); 
	$comment_id = req('comment_id');
  
	$sql = "UPDATE `t_goods_comment` SET ".$item."='".req($item)."' WHERE site_id='$g_siteid' AND comment_id='$comment_id'";
	$db->query($sql);  

	sendresult("已保存更改");
}
 
//-----------------------------------------------------------// 商家

if($cmd == 'shop_add'){    
	$shop_name 		= req('shop_name');   
	$shop_note 		= $_POST['shop_note'];  
	$account 		= req('account');
	$password 		= req('password');
	$linker 		= req('linker');
	$mobile 		= req('mobile');
	$cert_code 		= req('cert_code');
	$cert_scope 	= req('cert_scope');
	$shop_domain 	= req('shop_domain');
	$hotline 		= req('hotline');
	$qq 			= req('qq');  
	$tel 			= req('tel'); 
	$fax 			= req('fax'); 
	$email 			= req('email'); 
	$order_id 		= req('order_id'); 
	$fee_rate		= req('fee_rate'); 
	$is_verify_goods= req('is_verify_goods'); 
	$state 			= req('state');
	
	if($shop_name==''){
		senderror("对不起，商家名称不能为空！");
	}
	
	if($mobile==''){
		senderror("对不起，商家手机号不能为空！");
	} 

	if($account==''){
		senderror("对不起，用户名不能为空！");
	}
	
	if($password==''){
		senderror("对不起，密码不能为空！");
	} 
	 
	$sql = "SELECT `user_id` FROM `t_user` WHERE `account`='$account' ";
	$exist_user_id = $db->get_value($sql); 

	if($exist_user_id!=''){
		senderror("对不起，账号已存在！");
	} 

	$sql = "SELECT * FROM `t_shop` WHERE `shop_name`='$shop_name' OR `cert_code`='$cert_code' OR `shop_domain`='$shop_domain' ";
	$exist_shop = $db->get_one($sql); 

	if($exist_shop['shop_name'] == $shop_name){
		senderror("对不起，公司名称已存在！");
	} 
	if($exist_shop['cert_code'] == $cert_code){
		senderror("对不起，旅游许可证编号已存在！");
	}
	if($exist_shop['shop_domain'] == $shop_domain){
		senderror("对不起，二级域名前缀已存在！");
	}
 
	$shop_ico = get_ym_upfile('shop_ico'); 
  
	$sql = "INSERT INTO `t_shop` (`site_id` , `account`, `password`, `shop_note`, `shop_name`, `cert_code`, `cert_scope`, `shop_domain`, `hotline`, `theme_id`, `shop_ico` , `linker`, `qq`, `tel`, `fax`, `email`, `mobile`, `order_id`, `auth_level`, `auth_score`, `fee_rate`, `is_verify_goods`, `state`) VALUES ('$g_siteid', '$account', md5('$password'), '$shop_note', '$shop_name', '$cert_code', '$cert_scope', '$shop_domain', '$hotline', '1', '$shop_ico', '$linker', '$qq', '$tel', '$fax', '$email', '$mobile', '$order_id', '6', '5', '$fee_rate', '$is_verify_goods', '$state' )"; 
	$db->query($sql);   

	$url = "./?cmd=".base64_encode("shop.php");
	gourl($url);
}

if($cmd == 'shop_edit'){    
	$shop_id 		= req('shop_id'); 
	$user_id 		= req('user_id'); 
	$shop_name 		= req('shop_name');   
	$shop_note 		= $_POST['shop_note']; 
	$account 		= req('account');
	$password 		= req('password');
	$linker 		= req('linker');
	$mobile 		= req('mobile');
	$cert_code 		= req('cert_code');
	$cert_scope 	= req('cert_scope');
	$shop_domain 	= req('shop_domain');
	$hotline 		= req('hotline');
	$qq 			= req('qq');  
	$tel 			= req('tel'); 
	$fax 			= req('fax'); 
	$email 			= req('email'); 
	$order_id 		= req('order_id');
	$state 			= req('state');
	$fee_rate 		= req('fee_rate');
	$is_verify_goods = req('is_verify_goods');
	
	if($shop_name==''){
		senderror("对不起，商家名称不能为空！");
	}
	
	if($mobile==''){
		senderror("对不起，商家手机号不能为空！");
	} 
   
	$sql = "SELECT * FROM `t_shop` WHERE shop_id<>'$shop_id' AND ( `shop_name`='$shop_name' OR `cert_code`='$cert_code' OR `shop_domain`='$shop_domain') ";
	$exist_shop = $db->get_one($sql); 

	if($exist_shop['shop_name'] == $shop_name){
		senderror("对不起，公司名称已存在！");
	} 
	if($exist_shop['cert_code'] == $cert_code){
		senderror("对不起，旅游许可证编号已存在！");
	}
	if($exist_shop['shop_domain'] == $shop_domain){
		senderror("对不起，二级域名前缀已存在！");
	}
 
	$shop_ico = get_ym_upfile('shop_ico'); 

	if($shop_ico!=''){
		$uper = " , shop_ico='$shop_ico' ";
	}

	// 更新密码
	if($password != ''){
		$uper .= " , `password`=md5('$password') ";
	}
  
	$sql = "UPDATE `t_shop` SET `shop_note`='$shop_note', `shop_name`='$shop_name', `cert_code`='$cert_code', `cert_scope`='$cert_scope', `shop_domain`='$shop_domain', `hotline`='$hotline', `linker`='$linker', `qq`='$qq', `tel`='$tel', `fax`='$fax', `email`='$email', `mobile`='$mobile', `state`='$state', `fee_rate`='$fee_rate', `is_verify_goods`='$is_verify_goods' $uper WHERE `site_id`='$g_siteid' AND shop_id='$shop_id' "; 
	$db->query($sql);  
	 
	js('parent.location.reload();'); 
}
 
if($cmd == 'shop_del'){    
	$shop_id = req('shop_id'); 

	$sql = "SELECT goods_id FROM `t_goods_thread` WHERE shop_id='$shop_id' AND site_id='$g_siteid'";
	$rs = $db->get_value($sql); 
	if($rs!=''){
		senderror('不能删除，该商家存在产品！');
	}

	$sql = "SELECT order_id FROM `t_user_order` WHERE shop_id='$shop_id' AND site_id='$g_siteid'";
	$rs = $db->get_value($sql); 
	if($rs!=''){
		senderror('不能删除，该商家存在订单！');
	}

	$sql = "SELECT `shop_ico` FROM `t_shop` WHERE `site_id`='$g_siteid' AND shop_id='$shop_id'";
	$shop_ico = $db->get_value($sql);
	@unlink("$g_root/upfiles/$g_siteid/$shop_ico");
  
	$sql = "DELETE FROM `t_shop` WHERE `site_id`='$g_siteid' AND shop_id='$shop_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("shop.php");
	gourl($url);
}

if($cmd == 'shop_fast_edit'){   
	$item = req('item'); 
	$shop_id = req('shop_id'); 
  
	$sql = "UPDATE `t_shop` SET ".$item."='".req($item)."' WHERE `site_id`='$g_siteid' AND shop_id='$shop_id'";
	$db->query($sql);  

	sendresult("已保存更改");
}

//-----------------------------------------------------------// 文章
 
if($cmd == 'news_cat_add'){  
	$parent_id 		= req('parent_id'); 
	$cat_name 		= req('cat_name');  
	$cat_key 		= req('cat_key');  
	$order_id 		= req('order_id'); 
	$cat_type 		= req('cat_type'); 
	
	if($cat_name=='' || $cat_type==''){
		senderror('请填写分类名称');
	}
	
  
	$sql = "INSERT INTO `t_article_catalog` (`site_id` , `parent_id` , `cat_type`, `cat_name`, `cat_key` , `order_id` ) VALUES ('".$g_siteid."', '$parent_id ', '$cat_type', '$cat_name', '$cat_key', '$order_id' )";
	
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("news_cat.php")."&tabs_index=1";
	gourl($url);
}

if($cmd == 'news_cat_del'){    
	$cat_id = req('cat_id'); 

	$sql = "SELECT cat_id FROM `t_article_catalog` WHERE parent_id='$cat_id' AND site_id='$g_siteid'";
	$rs = $db->get_value($sql); 
	if($rs!=''){
		senderror('不能删除，存在下级类别，请先删除下级类别！');
	}

	$sql = "SELECT thread_id FROM `t_article_thread` WHERE cat_id='$cat_id' AND site_id='$g_siteid'";
	$rs = $db->get_value($sql); 
	if($rs!=''){
		senderror('不能删除，该类别存在文章，请先删除文章！');
	}
  
	$sql = "DELETE FROM `t_article_catalog` WHERE `site_id`='$g_siteid' AND cat_id='$cat_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("news_cat.php")."&tabs_index=1";
	gourl($url);
}

if($cmd == 'news_cat_edit'){   
	$item = req('item'); 
	$cat_id = req('cat_id');

	if($item == 'parent_id'){
		if($cat_id == req($item)){
			sendresult("请求未执行"); 
		}
	}
  
	$sql = "UPDATE `t_article_catalog` SET ".$item."='".req($item)."' WHERE `site_id`='$g_siteid' AND cat_id='$cat_id'";
	$db->query($sql);  

	sendresult("已保存更改");
}

if($cmd == 'news_add'){    
	$title 			= req('title');
	$cat_id 		= req('cat_id'); 
	$goods_cat_id	= req('goods_cat_id');
	$addtime 		= date('Y-m-d H:i:s'); 
	$news_content	= addslashes($_POST['news_content']);
	$summary 		= req('summary');

	if($title=='' || $cat_id==''){
		senderror('请填写标题、分类');
	}
	
 
	$image = get_ym_upfile('image');  
 
	 
	$sql = "INSERT INTO `t_article_thread` (`site_id`, `cat_id` , `goods_cat_id`, `title` , `image`, `summary` , `content` , `addtime` ) VALUES ('$g_siteid', '$cat_id', '$goods_cat_id', '$title', '$image', '$summary', '$news_content', '$addtime' ); ";
	
	$db->query($sql); 
	
	$url = "./?cmd=".base64_encode("news_list.php")."&tabs_index=0";
	gourl($url);
}

if($cmd == 'news_update'){  
	$thread_id 		= req('thread_id');
	$title 			= req('title');
	$cat_id 		= req('cat_id');  
	$goods_cat_id	= req('goods_cat_id');
	$addtime 		= date('Y-m-d H:i:s');
	$summary 		= req('summary');
	$news_content = addslashes($_POST['news_content']);
 
	$image = get_ym_upfile('image'); 

	if($image!=''){
		$uper = " `image`='$image', ";
	} 

	$sql = "UPDATE `t_article_thread` SET `cat_id`='$cat_id', `goods_cat_id`='$goods_cat_id', `title`='$title', `content`='$news_content', $uper `summary`='$summary', `addtime`='$addtime' WHERE `site_id`='$g_siteid' AND thread_id='$thread_id' ";
	
	$db->query($sql); 
 
	js('parent.location.reload();'); 
}

if($cmd == 'news_del'){  
	$thread_id = req('thread_id');
	// 删除文件
	$sql = "SELECT `image` FROM t_article_thread WHERE `site_id`='$g_siteid' AND thread_id='$thread_id'";
	$image = $db->get_value($sql); 
	@unlink("$g_root/upfiles/$g_siteid/$image");

	// 删除数据
	$db->query("DELETE FROM t_article_thread WHERE `site_id`='$g_siteid' AND thread_id='$thread_id'");
	
	$url = "./?cmd=".base64_encode("news_list.php")."&tabs_index=0";
	gourl($url);
}

if($cmd == 'news_edit_fast'){  
	$item = req('item'); 
	$thread_id = req('thread_id');

	$sql = "UPDATE t_article_thread SET ".$item."='".req($item)."' WHERE `thread_id`='$thread_id'"; 
	$db->query($sql);  

	sendresult("已保存更改");
}

//-----------------------------------------------------------// 帮助中心
 
if($cmd == 'help_cat_add'){   
	$cat_name 		= req('cat_name');   
	$order_id 		= req('order_id');  
	
	if($cat_name==''){
		senderror('请填写分类名称');
	} 
  
	$sql = "INSERT INTO `t_help_catalog` (`site_id`, `cat_name`, `order_id` ) VALUES ('".$g_siteid."', '$cat_name', '$order_id' )";
	
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("help.php")."&tabs_index=1";
	gourl($url);
}

if($cmd == 'help_cat_del'){    
	$cat_id = req('cat_id'); 
 
	$sql = "SELECT help_id FROM `t_help_thread` WHERE cat_id='$cat_id' AND site_id='$g_siteid'";
	$rs = $db->get_value($sql); 
	if($rs!=''){
		senderror('不能删除，该类别存在文章，请先删除文章！');
	}
  
	$sql = "DELETE FROM `t_help_catalog` WHERE `site_id`='$g_siteid' AND cat_id='$cat_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("help.php")."&tabs_index=1";
	gourl($url);
}

if($cmd == 'help_cat_edit'){   
	$item = req('item'); 
	$cat_id = req('cat_id'); 
 
	$sql = "UPDATE `t_help_catalog` SET ".$item."='".req($item)."' WHERE `site_id`='$g_siteid' AND cat_id='$cat_id'";
	$db->query($sql);  

	sendresult("已保存更改");
} 

if($cmd == 'help_add'){    
	$title 			= req('title');
	$cat_id 		= req('cat_id'); 
	$summary 		= req('summary');
	$help_content	= addslashes($_POST['help_content']); 
	$addtime 		= date('Y-m-d H:i:s'); 
	$order_id		= req('order_id');

	if($title=='' || $cat_id==''){
		senderror('请填写标题、分类');
	}
	 
	$sql = "INSERT INTO `t_help_thread` (`site_id`, `cat_id` , `title` , `summary` , `content` , `order_id`, `addtime` ) VALUES ('$g_siteid', '$cat_id', '$title', '$summary', '$help_content', '$order_id', '$addtime' ); ";
	
	$db->query($sql); 
	
	$url = "./?cmd=".base64_encode("help.php");
	gourl($url);
}

if($cmd == 'help_edit_fast'){   
	$item = req('item'); 
	$help_id = req('help_id'); 
 
	$sql = "UPDATE `t_help_thread` SET ".$item."='".req($item)."' WHERE `site_id`='$g_siteid' AND help_id='$help_id'";
	$db->query($sql);  

	sendresult("已保存更改");
}

if($cmd == 'help_update'){  
	$help_id 		= req('help_id');
	$title 			= req('title');
	$cat_id 		= req('cat_id');  
	$addtime 		= date('Y-m-d H:i:s');
	$summary 		= req('summary');
	$help_content = addslashes($_POST['help_content']); 
	$order_id		= req('order_id');
	
	$sql = "UPDATE `t_help_thread` SET `cat_id`='$cat_id' , `title`='$title' , `content`='$help_content', `summary`='$summary' , `addtime`='$addtime', `order_id`='$order_id' WHERE `site_id`='$g_siteid' AND help_id='$help_id' ";
	
	$db->query($sql);  
	 
	$url = "./?cmd=".base64_encode("help.php");
	gourl($url);
}

if($cmd == 'help_del'){  
	$help_id = req('help_id'); 

	// 删除数据库
	$db->query("DELETE FROM t_help_thread WHERE `site_id`='$g_siteid' AND help_id='$help_id'");
	
	$url = "./?cmd=".base64_encode("help.php");
	gourl($url);
}


// 页面管理
if($cmd == 'page_add'){    
	$title 				= req('title');
	$key 				= req('key');    
	$page_title			= req('page_title');
	$page_description	= req('page_description');
	$page_keywords		= req('page_keywords'); 
	$news_content		= addslashes($_POST['news_content']);
	$order_id 			= req('order_id'); 
	 
	$sql = "INSERT INTO `t_page` (`site_id`, `title` , `key` , `content`, `page_title`, `page_description`, `page_keywords`, `order_id` ) VALUES ('$g_siteid',  '$title', '$key', '$news_content', '$page_title', '$page_description', '$page_keywords', '$order_id' )";
	
	$db->query($sql); 
	
	$url = "./?cmd=".base64_encode("page_list.php")."&tabs_index=0";
	gourl($url);
}
if($cmd == 'page_update'){  
	$page_id 			= req('page_id');
	$title 				= req('title');
	$key 				= req('key'); 
	$order_id 			= req('order_id'); 

	$page_title			= req('page_title');
	$page_description	= req('page_description');
	$page_keywords		= req('page_keywords');

	$news_content		= addslashes($_POST['news_content']);
	
	$sql = "UPDATE `t_page` SET `title`='$title', `content`='$news_content', `key`='$key', `order_id`='$order_id', `page_title`='$page_title', `page_description`='$page_description', `page_keywords`='$page_keywords' WHERE `site_id`='$g_siteid' AND page_id='$page_id' ";
	
	$db->query($sql); 
 
	js('parent.location.reload();'); 
}
if($cmd == 'page_del'){  
	$page_id = req('page_id');
	$db->query("DELETE FROM `t_page` WHERE `site_id`='$g_siteid' AND page_id='$page_id'");
	
	$url = "./?cmd=".base64_encode("page_list.php")."&tabs_index=0";
	gourl($url);
}

//-----------------------------------------------------------// 菜单

if($cmd == 'menu_add'){  
	$parent_id 		= req('parent_id'); 
	$title			= req('title');  
	$url 			= req('url');
	$order_id 		= req('order_id'); 
  
	$sql = "INSERT INTO `t_site_menu` (`site_id` , `parent_id` , `title` , `url` , `target`, `order_id` ) VALUES ('".$g_siteid."', '$parent_id', '$title', '$url', '_self', '$order_id' )";
	
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("site_menu.php");
	gourl($url);
}
if($cmd == 'menu_del'){    
	$menu_id = req('menu_id'); 
  
	$sql = "DELETE FROM `t_site_menu` WHERE `site_id`='$g_siteid' AND `menu_id`='$menu_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("site_menu.php");
	gourl($url);
}
if($cmd == 'menu_edit'){   
	$item = req('item'); 
	$menu_id = req('menu_id');
  
	$sql = "UPDATE `t_site_menu` SET `".$item."`='".req($item)."' WHERE `site_id`='$g_siteid' AND menu_id='$menu_id'";
	$db->query($sql);  

	sendresult("已保存更改");
}

//-----------------------------------------------------------// 首页轮播图

if($cmd == 'ppt_add'){   
	$ppt_title 		= req('ppt_title');
	$ppt_url	 	= req('ppt_url');  
	$order_id		= req('order_id');
	$ppt_type		= req('ppt_type');
 
	$ppt_image = get_ym_upfile('ppt_image');  
	
	$sql = "INSERT INTO `t_site_ppt` (`site_id`, `ppt_type`, `ppt_title`, `ppt_url`, `ppt_image` , `order_id` ) VALUES ('$g_siteid', '$ppt_type', '$ppt_title', '$ppt_url', '$ppt_image', '$order_id');";
	
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("site_ppt.php");
	gourl($url);
} 

if($cmd == 'ppt_edit_fast'){  
	$item = req('item'); 
	$ppt_id = req('ppt_id');

	if($item == 'ppt_image'){ 
		$ppt_image = get_ym_upfile('ppt_image');  

		$sql = "UPDATE `t_site_ppt` SET `ppt_image`='$ppt_image' WHERE `site_id`='$g_siteid' AND `ppt_id`='$ppt_id'";
		$db->query($sql); 
		
		$url = "./?cmd=".base64_encode("site_ppt.php");
		gotourl($url);

	} else {  
		$sql = "UPDATE `t_site_ppt` SET ".$item."='".req($item)."' WHERE `site_id`='$g_siteid' AND `ppt_id`='$ppt_id'";
		$db->query($sql);  
		sendresult("已保存更改");
	} 
}

if($cmd == 'ppt_del'){    
	$ppt_id = req('ppt_id'); 
  
	$sql = "DELETE FROM `t_site_ppt` WHERE `site_id`='$g_siteid' AND `ppt_id`='$ppt_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("site_ppt.php");
	gourl($url);
} 


//-----------------------------------------------------------// 广告管理

if($cmd == 'ad_add'){   
	$ad_title 		= req('ad_title');
	$ad_url	 		= req('ad_url');  
	$order_id		= req('order_id');
	$ad_key			= req('ad_key');
 
	$ad_image = get_ym_upfile('ad_image');  
	
	$sql = "INSERT INTO `t_site_ad` (`site_id`, `ad_key`, `ad_title`, `ad_url`, `ad_image` , `order_id` ) VALUES ('$g_siteid', '$ad_key', '$ad_title', '$ad_url', '$ad_image', '$order_id');";
	
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("site_ad.php").'&ad_key='.$ad_key;
	gourl($url);
} 

if($cmd == 'ad_edit_fast'){  
	$item  = req('item'); 
	$ad_id = req('ad_id');

	if($item == 'ad_image'){ 
		$ad_image = get_ym_upfile('ad_image');  

		$sql = "UPDATE `t_site_ad` SET `ad_image`='$ad_image' WHERE `site_id`='$g_siteid' AND `ad_id`='$ad_id'";
		$db->query($sql); 

		$sql = "SELECT `ad_key` FROM `t_site_ad` WHERE `site_id`='$g_siteid' AND `ad_id`='$ad_id'";
		$ad_key = $db->get_value($sql); 
		
		$url = "./?cmd=".base64_encode("site_ad.php").'&ad_key='.$ad_key;
		gotourl($url);

	} else {  
		$sql = "UPDATE `t_site_ad` SET ".$item."='".req($item)."' WHERE `site_id`='$g_siteid' AND `ad_id`='$ad_id'";
		$db->query($sql);  
		sendresult("已保存更改");
	} 
}

if($cmd == 'ad_del'){    
	$ad_id  = req('ad_id'); 
	$ad_key = req('ad_key');
  
	$sql = "DELETE FROM `t_site_ad` WHERE `site_id`='$g_siteid' AND `ad_id`='$ad_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("site_ad.php").'&ad_key='.$ad_key;
	gourl($url);
} 

//-----------------------------------------------------------// 热点导航
 
if($cmd == 'hotspot_add'){  
	$parent_id 		= req('parent_id'); 
	$title			= req('title');  
	$url 			= req('url');
	$order_id 		= req('order_id'); 
  
	$sql = "INSERT INTO `t_site_hotspot` (`site_id` , `parent_id` , `title` , `url` , `order_id` ) VALUES ('".$g_siteid."', '$parent_id', '$title', '$url', '$order_id' )";
	
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("site_hotspot.php");
	gourl($url);
}
if($cmd == 'hotspot_del'){    
	$hotspot_id = req('hotspot_id'); 
  
	$sql = "SELECT `hotspot_id` FROM `t_site_hotspot` WHERE `site_id`='$g_siteid' AND `parent_id`='$hotspot_id'";
	$child_id = $db->get_value($sql);  

	if($child_id!=''){
		senderror("禁止删除，存在下级导航，请先删除下级导航！");
	}

	$sql = "DELETE FROM `t_site_hotspot` WHERE `site_id`='$g_siteid' AND `hotspot_id`='$hotspot_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("site_hotspot.php");
	gourl($url);
}
if($cmd == 'hotspot_update_image'){    
	$pic_hotspot_id = req('pic_hotspot_id'); 
	$pic_col_name   = req('pic_col_name'); 
	$pic_ad_link    = req('link'); 
	$pic_file       = get_ym_upfile('pic');  

	if($pic_file!=''){ 
		if($pic_col_name=='ad2'){
			$qer = ", ad2_link='$pic_ad_link'";
		}
		$sql = "UPDATE `t_site_hotspot` SET $pic_col_name='$pic_file' $qer WHERE `site_id`='$g_siteid' AND `hotspot_id`='$pic_hotspot_id'";
		$db->query($sql); 
	}

	$url = "./?cmd=".base64_encode("site_hotspot.php");
	gourl($url);
}
if($cmd == 'hotspot_edit'){   
	$item = req('item'); 
	$hotspot_id = req('hotspot_id');

	if($item=='code1' || $item=='code2'){
		$v = addslashes($_POST[$item]);
	} else {
		$v = req($item);
	}
  
	$sql = "UPDATE `t_site_hotspot` SET ".$item."='".$v."' WHERE `site_id`='$g_siteid' AND hotspot_id='$hotspot_id'";
	$db->query($sql);  

	sendresult("已保存更改");
}
 
//-----------------------------------------------------------// 友情链接

if($cmd == 'link_add'){
	$link_title = req('link_title');
	$link_url = req('link_url');
	$order_id = req('order_id'); 

	$sql = "INSERT INTO `t_friendlink` (`site_id`, `link_title` , `link_url` , `order_id` ) VALUES ('$g_siteid', '$link_title', '$link_url', '$order_id' ); ";
	$db->query($sql);
	
	$url = "./?cmd=".base64_encode("link_list.php");
	gourl($url);
}

if($cmd == 'link_edit_fast'){  
	$item = req('item'); 
	$link_id = req('link_id');
  
	$sql = "UPDATE `t_friendlink` SET ".$item."='".req($item)."' WHERE `link_id`='$link_id' AND site_id='$g_siteid'";
	$db->query($sql);  

	sendresult("已保存更改");
}

if($cmd == 'link_del'){    
	$link_id = req('link_id'); 
  
	$sql = "DELETE FROM `t_friendlink` WHERE `link_id`='$link_id' AND site_id='$g_siteid' ";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("link_list.php");
	gourl($url);
}

//-----------------------------------------------------------// 私人定制

if($cmd == 'customized_del'){   
	$item_id = req('item_id');
	$db->query("DELETE FROM `t_customized` WHERE `site_id`='".$g_siteid."' AND item_id='$item_id'"); 

	$url = "./?cmd=".base64_encode("customized.php");
	gourl($url);
}

//-----------------------------------------------------------// 客户管理

if($cmd == 'user_add'){  
	$account = req('account'); 
	$password = req('password'); 
	$username = req('username'); 
	$vip_no = req('vip_no');
	$birthday = req('birthday');
	$mobile = req('mobile');
	$qq = req('qq');
	$email = req('email'); 
	$idcard = req('idcard');
	$sex = req('sex'); 
	$state = req('state'); 
	$ymd = date('Y-m-d H:i:s');

	if(check_repeat_value('t_user', 'account', $account)){
		senderror("对不起，用户名已经存在！");
	} 

	if(check_repeat_value('t_user', 'mobile', $mobile)){
		senderror("对不起，手机号已经存在！");
	} 

	if(check_repeat_value('t_user', 'idcard', $idcard)){
		senderror("对不起，身份证号已经存在！");
	} 
	
	if(check_repeat_value('t_user', 'vip_no', $vip_no)){
		senderror("对不起，会员卡号已经存在！");
	}  

	$sql = "INSERT INTO `t_user` (  `site_id` , `account`, `password`, `username` , `sex` , `idcard` ,  `mobile` , `qq` , `vip_no` , `email` , `state` , `addtime` ) VALUES ( '$g_siteid', '$account', md5('$password'), '$username', '$sex', '$idcard', '$mobile', '$qq', '$vip_no', '$email', '$state', '$ymd');";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("user.php");
	gourl($url);
}

if($cmd == 'user_edit'){  
	$user_id = req('user_id'); 
	$account = req('account'); 
	$password = req('password'); 
	$username = req('username'); 
	$vip_no = req('vip_no');
	$birthday = req('birthday');
	$mobile = req('mobile');
	$qq = req('qq');
	$email = req('email'); 
	$idcard = req('idcard');
	$sex = req('sex'); 
	$user_level = req('user_level');
	$state = req('state'); 
	$ymd = date('Y-m-d H:i:s');

	if(check_repeat_value('t_user', 'account', $account, 'user_id', $user_id)){
		senderror("对不起，用户名已经存在！");
	} 

	if(check_repeat_value('t_user', 'mobile', $mobile, 'user_id', $user_id)){
		senderror("对不起，手机号已经存在！");
	} 

	if(check_repeat_value('t_user', 'idcard', $idcard, 'user_id', $user_id)){
		senderror("对不起，身份证号已经存在！");
	} 
	
	if(check_repeat_value('t_user', 'vip_no', $vip_no, 'user_id', $user_id)){
		senderror("对不起，会员卡号已经存在！");
	}   
	
	if($password != ''){  
		$qer .= " `password`=MD5('$password'), "; 	
	} 

	if($state == ''){
		$state = '1';
	}

	$sql = "UPDATE `t_user` SET `account`='$account', $qer `username`='$username', `sex`='$sex', `birthday`='$birthday', `idcard`='$idcard', `mobile`='$mobile', `qq`='$qq', `vip_no`='$vip_no', `state`='$state', `user_level`='$user_level', `email`='$email' WHERE `site_id`='$g_siteid' AND `user_id`='$user_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("user.php");
	gourl($url);
}

if($cmd == 'user_fast_edit'){  
	$item = req('item'); 
	$user_id = req('user_id');
  
	$sql = "UPDATE `t_user` SET ".$item."='".req($item)."' WHERE `site_id`='".$g_siteid."' AND `user_id`='$user_id'";
	$db->query($sql);  

	sendresult("已保存更改");
}
 
if($cmd == 'user_del'){   
	$user_id = req('user_id');
	$db->query("DELETE FROM `t_user` WHERE `site_id`='".$g_siteid."' AND user_id='$user_id'"); 

	$url = "./?cmd=".base64_encode("user.php");
	gourl($url);
}

if($cmd == 'user_passwd'){   
	$user_id		= req('the_user_id'); 
	$new_pass		= req('new_pass');
	$re_new_pass	= req('re_new_pass');

	if(strlen($new_pass)<5){
		sendwarn('密码不能小于5位');
	}
	if($new_pass!=$re_new_pass){
		sendwarn('两次密码不一致');
	}
 
	$db->query("UPDATE `t_user` SET `password`=md5('".$new_pass."') WHERE `site_id`='".$g_siteid."' AND `user_id`='$user_id'"); 
	
	js('parent.$( "#mydialog" ).dialog( "close" );');

	sendresult("密码已重置");
}

//-----------------------------------------------------------// 会员等级
 
if($cmd == 'user_level_add'){  
	$level_name      = req('level_name'); 
	$level_rebate    = req('level_rebate'); 
	$level_note      = req('level_note'); 
	$level_require   = req('level_require'); 

	$sql = "SELECT MAX(`level_type`)+1 FROM `t_user_level` WHERE `site_id`='$g_siteid'";  
	$level_type = $db->get_value($sql); 

	if($level_type==''){ 
		$level_type = '0';
	}

	$sql = "INSERT INTO `t_user_level` (`site_id`, `level_type`, `level_name`, `level_rebate`, `level_require`, `level_note`) VALUES ('$g_siteid', '$level_type', '$level_name', '$level_rebate', '$level_require', '$level_note')";
	$db->query($sql);  
 
	gourl(url('user_level.php'));
}

if($cmd == 'user_level_fast_edit'){  
	$item = req('item'); 
	$level_id = req('level_id');
  
	$sql = "UPDATE `t_user_level` SET ".$item."='".req($item)."' WHERE `site_id`='$g_siteid' AND `level_id`='$level_id'";
	$db->query($sql);  

	sendresult("已保存更改");
}

if($cmd == 'user_level_del'){   
	$level_id   = req('level_id');
	$level_type = req('level_type');

	$sql = "SELECT `user_id` FROM `t_user` WHERE `site_id`='$g_siteid' AND `user_level`='$level_type'";  
	$exit_level_type = $db->get_value($sql); 

	if($exit_level_type!=''){ 
		senderror("对不起，该等级已经为某些用户设置，不能删除！"); 	
	}
	
	$sql = "DELETE FROM `t_user_level` WHERE `site_id`='$g_siteid' AND `level_id`='$level_id'";
	$db->query($sql); 

	gourl(url('user_level.php'));
}

//-----------------------------------------------------------// 留言管理

if($cmd == 'guestbook_del'){   
	$guestbook_id = req('guestbook_id');
	$db->query("DELETE FROM `t_guestbook` WHERE `site_id`='".$g_siteid."' AND guestbook_id='$guestbook_id'"); 

	$url = "./?cmd=".base64_encode("guestbook.php");
	gourl($url);
}


 
/// 首页楼层广告  
if($cmd == 'goods_floor_topic_add'){   
	$ad_title 		= req('ad_title');
	$ad_url	 		= req('ad_url');  
	$order_id		= req('order_id');
	$floor_id		= req('floor_id');
	$floor_title	= req('floor_title');
 
	$ad_image = get_ym_upfile('ad_image' );  
	
	$sql = "INSERT INTO `t_goods_floor_topic` (`site_id`, `floor_id`, `ad_title` , `ad_url`, `ad_image` , `order_id` ) VALUES ('$g_siteid', '$floor_id', '$ad_title', '$ad_url', '$ad_image', '$order_id');";
	
	$db->query($sql);  
 
	$url = "./?cmd=".base64_encode("goods_floor_topic.php")."&tabs_index=0&floor_id=$floor_id&floor_title=$floor_title";
	gourl($url);
} 

if($cmd == 'goods_floor_topic_edit'){  
	$item		= req('item'); 
	$item_id	= req('item_id');
  
	$sql = "UPDATE `t_goods_floor_topic` SET ".$item."='".req($item)."' WHERE `site_id`='$g_siteid' AND `item_id`='$item_id'";
	$db->query($sql);  

	sendresult("已保存更改");
}

if($cmd == 'goods_floor_topic_del'){    
	$item_id		= req('item_id'); 
	$floor_id		= req('floor_id');
	$floor_title	= req('floor_title');
  
	$sql = "DELETE FROM `t_goods_floor_topic` WHERE `site_id`='$g_siteid' AND `item_id`='$item_id'";
	$db->query($sql);  
 
	$url = "./?cmd=".base64_encode("goods_floor_topic.php")."&tabs_index=0&floor_id=$floor_id&floor_title=$floor_title";
	gourl($url);
}

// 楼层产品
if($cmd == 'goods_floor_goods_join'){   
	$goods_box = $_POST['goods_box'];
	$floor_id = req('floor_id');
	$floor_title = req('floor_title');
	$p = req('p');
	$kw = req('kw');

	$len = sizeof($goods_box);
 
	if($len>0){
		for($i=0; $i<$len; $i++){ 
			$goods_id = $goods_box[$i];
			$sql = "SELECT `item_id` FROM `t_goods_floor_goods` WHERE `site_id`='$g_siteid' AND `floor_id`='$floor_id' AND `goods_id`='$goods_id'";
			$rs = $db->get_value($sql);
 
			if($rs == ''){
				$sql = "INSERT INTO `t_goods_floor_goods` (`site_id` , `floor_id` , `goods_id` , `order_id` ) VALUES ('$g_siteid', '$floor_id', '$goods_id', '".($i+1)."' )";
				$db->query($sql); 
			}
		}
	}	   
	$url = "./?cmd=".base64_encode("goods_floor_goods.php")."&p=$p&kw=$kw&floor_id=$floor_id&floor_title=$floor_title";
	gourl($url);
}

if($cmd == 'goods_floor_goods_del'){   
	$item_id = req('item_id');
	$floor_id = req('floor_id');
	$floor_title = req('floor_title');

	 
	$sql = "DELETE FROM `t_goods_floor_goods` WHERE `site_id`='$g_siteid' AND `item_id`='$item_id'";
	$db->query($sql);
		 
	$url = "./?cmd=".base64_encode("goods_floor_goods.php")."&tabs_index=0&floor_id=$floor_id&floor_title=$floor_title";
	gourl($url);
}

if($cmd == 'goods_floor_goods_edit'){   
	$item = req('item'); 
	$item_id = req('item_id'); 
  
	$sql = "UPDATE `t_goods_floor_goods` SET ".$item."='".req($item)."' WHERE `item_id`='$item_id'";
	$db->query($sql);  

	sendresult("已保存更改");
}
 
if($cmd == 'tourist_edit_fast'){  
	$item = req('item'); 
	$tourist_id = req('tourist_id');

	$sql = "UPDATE `t_user_order_tourist` SET ".$item."='".req($item)."' WHERE `tourist_id`='$tourist_id'"; 
	$db->query($sql);  

	sendresult("已保存更改");
}

if($cmd == 'tourist_del'){    
	$tourist_id = req('tourist_id');  
  
	$sql = "DELETE FROM `t_user_order_tourist` WHERE `tourist_id`='$tourist_id'";
	$db->query($sql);  
 
	$url = "./?cmd=".base64_encode("tourist_list.php")."&kw=".req('kw')."&p=".req('p');
	gourl($url);
}

if($cmd == 'shop_join_state'){   
	$state = req('state'); 
	$join_id = req('join_id'); 
	$unpass_note = req('unpass_note');
  
	$sql = "UPDATE `t_shop_join` SET `state`='$state', `unpass_note`='$unpass_note' WHERE join_id='$join_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("shop_join_list.php")."&p=".req('p');
	gourl($url);
}

if($cmd == 'shop_join_del'){    
	$join_id = req('join_id');  
  
	$sql = "DELETE FROM `t_shop_join` WHERE `join_id`='$join_id'";
	$db->query($sql);  
 
	$url = "./?cmd=".base64_encode("shop_join_list.php")."&kw=".req('kw')."&p=".req('p');
	gourl($url);
}

/// ---------------------------------------------// 线下门店

if($cmd == 'local_store_add'){   
	$store_name 	= req('store_name'); 
	$order_id		= req('order_id'); 
	$profile		= serialize($_POST);
 
	$store_image = get_ym_upfile('store_image');  
	
	$sql = "INSERT INTO `t_local_store` (`site_id`, `store_name`, `profile`, `store_image`, `state`, `order_id` ) VALUES ('$g_siteid', '$store_name', '$profile', '$store_image', '0', '$order_id');";
	
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("local_store.php");
	gourl($url);
} 

if($cmd == 'local_store_edit_fast'){  
	$item = req('item'); 
	$store_id = req('store_id');

	if($item == 'store_image'){ 
		$store_image = get_ym_upfile('store_image');  

		$sql = "UPDATE `t_local_store` SET `store_image`='$store_image' WHERE `site_id`='$g_siteid' AND `store_id`='$store_id'";
		$db->query($sql); 
		
		$url = "./?cmd=".base64_encode("local_store.php");
		gotourl($url);

	} else {  
		$profile = serialize($_POST);

		if($item=='store_name' || $item=='order_id'){
			$uper = ", ".$item."='".req($item)."'";
		}

		$sql = "UPDATE `t_local_store` SET `profile`='$profile' $uper WHERE `site_id`='$g_siteid' AND `store_id`='$store_id'";
		$db->query($sql);  

		sendresult("已保存更改");
	} 
}

if($cmd == 'local_store_del'){    
	$store_id = req('store_id'); 
  
	$sql = "DELETE FROM `t_local_store` WHERE `site_id`='$g_siteid' AND `store_id`='$store_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("local_store.php");
	gourl($url);
} 

/// 旅游顾问

if($cmd == 'vcard_add'){   
	$profiles = addslashes(serialize($_POST));  
 
	$avatar = get_ym_upfile('avatar'); 
    
	$sql = "INSERT INTO `t_wx_vcard` ( `site_id`, `avatar`, `profiles`, `state`, `addtime`) VALUES ( '$g_siteid', '$avatar', '$profiles', '1', '$ymdhis');"; 
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("wx_vcard.php")."&tabs_index=0";
	gourl($url);
}

if($cmd == 'vcard_del'){    
	$vcard_id = req('vcard_id'); 
  
	$sql = "DELETE FROM `t_wx_vcard` WHERE `vcard_id`='$vcard_id' AND `site_id`='$g_siteid'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("wx_vcard.php")."&tabs_index=0";
	gourl($url);
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
	gourl($url);
}


if($cmd == 'seo_update'){  
	$primary_name		= req('primary_name');
	$primary_value		= req('primary_value');
	$table_name			= req('table_name');

	$page_title			= req('page_title');
	$page_keywords		= req('page_keywords');
	$page_description	= req('page_description');

	
	if($page_title==''){
		senderror('请输入SEO标题');
	} 

	$page_title		= str_replace('，', ',', $page_title);
	$page_title		= str_replace('|',  ',', $page_title);
	$page_title		= str_replace('-',  '_', $page_title);
	$page_title		= str_replace(' ',  '',  $page_title);

	$page_keywords		= str_replace('，', ',', $page_keywords);
	$page_keywords		= str_replace('|',  ',', $page_keywords);
		   
 
	$sql = "UPDATE $table_name SET `page_title`='$page_title', `page_keywords`='$page_keywords', `page_description`='$page_description' WHERE `site_id`='".$g_siteid."' AND $primary_name='$primary_value' ";
	$db->query($sql);  

	js('parent.location.reload();'); 
}

/// ---------------------------------------------// 积分商品分类

if($cmd == 'score_goods_cat_add'){    
	$cat_name	= req('cat_name');    
	$order_id	= req('order_id'); 

	$sql = "INSERT INTO `t_score_goods_catalog` ( `site_id`, `cat_name`, `order_id` ) VALUES ( '$g_siteid', '$cat_name', '$order_id' )";
	$db->query($sql);   

	$url = "./?cmd=".base64_encode("score_goods_cat.php");
	gourl($url);
}

if($cmd == 'score_goods_cat_del'){    
	$cat_id = req('cat_id'); 

 
	$sql = "SELECT goods_id FROM `t_score_goods_thread` WHERE cat_id='$cat_id' AND site_id='$g_siteid'";
	$rs = $db->get_value($sql); 
	if($rs!=''){
		senderror('不能删除，该分类存在产品，请先删除产品！');
	}
  
	$sql = "DELETE FROM `t_score_goods_catalog` WHERE site_id='$g_siteid' AND cat_id='$cat_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("goods_cat.php");
	gourl($url);
}
 
if($cmd == 'score_goods_cat_edit'){   
	$item = req('item'); 
	$cat_id = req('cat_id');

	$sql = "UPDATE `t_score_goods_catalog` SET ".$item."='".req($item)."' WHERE site_id='$g_siteid' AND cat_id='$cat_id'";
	$db->query($sql); 
	
	sendresult("已保存更改"); 
} 

/// ---------------------------------------------// 积分商品管理

// 添加积分商品
if($cmd == 'score_goods_add'){     
	$addtime			= date('Y-m-d H:i:s');   
	$goods_name 		= req('goods_name'); 
	$goods_code 		= req('goods_code');   
	$market_price 		= req('market_price');  
	$score_number 		= req('score_number');  
	$goods_prop 		= req('goods_prop');  
	$stock 				= req('stock'); 
	$is_sale 			= req('is_sale'); 
	$cat_id 			= req('cat_id');  
	$summary			= addslashes($_POST['summary']); 
	$goods_content		= addslashes($_POST['goods_content']); 

	if($goods_code==''){
		$goods_code = date('Ymdis'); //自动产品编号
	} 
 
	if(notnull($goods_name) == false){ 
		senderror('请填写产品名称');
	}  

	$sql = "SELECT `goods_code` FROM `t_score_goods_thread` WHERE `goods_code`='$goods_code' AND `site_id`='$g_siteid'";
	$exist_goods_code = $db->get_value($sql); 
	if($exist_goods_code != ''){
		senderror('产品编号已存在');
	}
 
	$goods_image = get_ym_upfile('goods_image'); 
	
	if($goods_image==''){
		senderror('必须上传产品主图');
	} 
	   
	$sql = "INSERT INTO `t_score_goods_thread` (`site_id`, `cat_id`, `goods_name`, `goods_code`, `goods_prop`, `goods_image`, `summary`, `content`, `market_price`, `score_number`, `stock`, `sales`, `clicks`, `is_sale`, `is_hot`, `order_id`, `addtime`) VALUES ('$g_siteid', '$cat_id', '$goods_name', '$goods_code', '$goods_prop', '$goods_image', '$summary', '$goods_content', '$market_price', '$score_number', '$stock', '0', '0', '$is_sale', '0', '0', '$addtime')"; 
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("score_goods_list.php");
	gourl($url);
}

// 编辑积分商品
if($cmd == 'score_goods_edit'){     
	$addtime			= date('Y-m-d H:i:s');   
	$goods_id	 		= req('goods_id');
	$goods_name 		= req('goods_name'); 
	$goods_code 		= req('goods_code');   
	$market_price 		= req('market_price');  
	$score_number 		= req('score_number');  
	$goods_prop 		= req('goods_prop');  
	$stock 				= req('stock'); 
	$is_sale 			= req('is_sale'); 
	$cat_id 			= req('cat_id');  
	$summary			= addslashes($_POST['summary']); 
	$goods_content		= addslashes($_POST['goods_content']); 

	if(notnull($goods_name) == false){ 
		senderror('请填写产品名称');
	}  

	$sql = "SELECT `goods_code` FROM `t_score_goods_thread` WHERE `goods_code`='$goods_code' AND `site_id`='$g_siteid' AND `goods_id`<>'$goods_id'";
	$exist_goods_code = $db->get_value($sql); 
	if($exist_goods_code != ''){
		senderror('产品编号已存在');
	}
 
	$goods_image = get_ym_upfile('goods_image'); 
	
	if($goods_image!=''){ 
		$qer = " `goods_image`='$goods_image', ";
	}
	   
	$sql = "UPDATE `t_score_goods_thread` SET `cat_id`='$cat_id', `goods_name`='$goods_name', `goods_code`='$goods_code', `goods_prop`='$goods_prop', $qer `summary`='$summary', `content`='$goods_content', `market_price`='$market_price', `score_number`='$score_number', `stock`='$stock', `is_sale`='$is_sale' WHERE `site_id`='$g_siteid' AND `goods_id`='$goods_id'"; 
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("score_goods_list.php");
	gourl($url);
}

// 快速编辑积分商品
if($cmd == 'score_goods_fast_edit'){  
	$item = req('item'); 
	$goods_id = req('goods_id'); 
 
	$sql = "UPDATE `t_score_goods_thread` SET ".$item."='".req($item)."' WHERE site_id='$g_siteid' AND `goods_id`='$goods_id'";
	$db->query($sql);  

	sendresult("已保存更改");
}


/// 加载扩展 ///
include('do.goods.php');
include('do.order.php');
include('do.diy.php');
include('do.shop.php');
include('do.weixin.php');
?>