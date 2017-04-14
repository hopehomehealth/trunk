<?  
// 店铺设置
if($cmd == 'shop_setting'){    
	$shop_name 		= req('shop_name');   
	$shop_note 		= req('shop_note'); 
	$account 		= req('account');
	$password 		= req('password');
	$linker 		= req('linker');
	$mobile 		= req('mobile');
	$hotline 		= req('hotline');
	$address 		= req('address');
	$qq 			= req('qq');  
	$tel 			= req('tel'); 
	$fax 			= req('fax'); 
	$email 			= req('email');  
 
	$shop_ico = get_ym_upfile('shop_ico' ); 
   
	if($shop_ico!=''){
		$qer = "`shop_ico`='$shop_ico',";
	} 
  
	$sql = "UPDATE `t_shop` SET `shop_note`='$shop_note', `shop_name`='$shop_name', $qer `hotline`='$hotline', `address`='$address', `linker`='$linker', `qq`='$qq', `tel`='$tel', `fax`='$fax', `email`='$email', `mobile`='$mobile' WHERE shop_id='$g_shopid'"; 
	$db->query($sql);   
 
	$url = "./?cmd=".base64_encode("shop_setting.php");
	gourl($url);
}

// 店铺客服设置
if($cmd == 'shop_im'){    
	$im_qq 		= req('im_qq');   
	$im_ww 		= req('im_ww');  
 
	$sql = "UPDATE `t_shop` SET `im_qq`='$im_qq', `im_ww`='$im_ww' WHERE shop_id='$g_shopid'"; 
	$db->query($sql);   
 
	$url = "./?cmd=".base64_encode("shop_im.php")."&tabs_index=1";
	gourl($url);
}

//-----------------------------------------------------------// 产品分类

if($cmd == 'shop_goods_cat_add'){  
	$parent_id 		= req('parent_id'); 
	$cat_name 		= req('cat_name');  
	$cat_ico 		= req('cat_ico');
	$order_id 		= req('order_id'); 

	if($cat_name==''){
		senderror('分类名称必须填写');
	}

	if(strpos($cat_name,'^')!==false){
		$arr = explode('^', $cat_name);
		$m = 0;
		foreach ($arr as &$v) { 
			if($v!=''){
				$sql = "INSERT INTO `t_shop_goods_catalog` ( `site_id` , `shop_id`, `parent_id` , `cat_name`, `order_id` ) VALUES (  '$g_siteid', '$g_shopid', '$parent_id ', '$v', '".($order_id+$m)."' )"; 
				$db->query($sql);  
				$m++;
			}
		}

	} else {
 
		$sql = "INSERT INTO `t_shop_goods_catalog` ( `site_id`, `shop_id`, `parent_id`, `cat_name`, `cat_ico`, `order_id` ) VALUES (  '$g_siteid', '$g_shopid', '$parent_id ', '$cat_name', '$cat_ico', '$order_id' )";
		
		$db->query($sql);  
	}

	$url = "./?cmd=".base64_encode("shop_goods_cat.php");
	gourl($url);
}

if($cmd == 'shop_goods_cat_del'){    
	$cat_id = req('cat_id'); 
  
	$sql = "DELETE FROM `t_shop_goods_catalog` WHERE site_id='$g_siteid' AND cat_id='$cat_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("shop_goods_cat.php");
	gourl($url);
}

if($cmd == 'shop_goods_cat_edit'){   
	$item = req('item'); 
	$cat_id = req('cat_id'); 
	 
	$sql = "UPDATE `t_shop_goods_catalog` SET ".$item."='".req($item)."' WHERE site_id='$g_siteid' AND cat_id='$cat_id'";
	$db->query($sql);  
	sendresult("已保存更改"); 
} 



if($cmd == 'shop_ppt_add'){   
	$ppt_type		= req('ppt_type');
	$ppt_title 		= req('ppt_title');
	$ppt_url	 	= req('ppt_url');  
	$order_id		= req('order_id');
 
	$ppt_image = get_ym_upfile('ppt_image');  
	
	$sql = "INSERT INTO `t_shop_ppt` (`site_id`, `shop_id`, `ppt_type`, `ppt_title` , `ppt_url`, `ppt_image` , `state`, `order_id` ) VALUES ('$g_siteid', '$g_shopid', '$ppt_type', '$ppt_title', '$ppt_url', '$ppt_image', '1', '$order_id');";
	
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("shop_ppt.php")."&tabs_index=1";
	gourl($url);
} 

if($cmd == 'shop_ppt_edit_fast'){  
	$item = req('item'); 
	$ppt_id = req('ppt_id');
   
	if($item == 'ppt_image'){ 
		$ppt_image = get_ym_upfile('ppt_image');  

		$sql = "UPDATE `t_shop_ppt` SET `ppt_image`='$ppt_image' WHERE `site_id`='$g_siteid' AND `ppt_id`='$ppt_id'";
		$db->query($sql); 
 
		$url = "./?cmd=".base64_encode("shop_ppt.php")."&tabs_index=1";
		gotourl($url);

	} else {  
		$sql = "UPDATE `t_shop_ppt` SET ".$item."='".req($item)."' WHERE `site_id`='$g_siteid' AND `ppt_id`='$ppt_id'";
		$db->query($sql);  
		sendresult("已保存更改");
	}  
}
if($cmd == 'shop_ppt_del'){    
	$ppt_id = req('ppt_id'); 
  
	$sql = "DELETE FROM `t_shop_ppt` WHERE `site_id`='$g_siteid' AND `ppt_id`='$ppt_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("shop_ppt.php")."&tabs_index=1";
	gourl($url);
}

 
if($cmd == 'shop_page_update'){  
	$page_id 		= req('page_id');
	$title 			= req('title');
	$key 			= req('key');   
	$news_content	= addslashes($_POST['news_content']);
	
	$sql = "UPDATE `t_shop_page` SET  `title`='$title' , `content`='$news_content' , `key`='$key' WHERE `site_id`='$g_siteid' AND page_id='$page_id' ";
	
	$db->query($sql); 
 
	js('parent.location.reload();'); 
}
if($cmd == 'shop_page_del'){  
	$page_id = req('page_id');
	$db->query("DELETE FROM `t_shop_page` WHERE `site_id`='$g_siteid' AND page_id='$page_id'");
	
	$url = "./?cmd=".base64_encode("shop_page_list.php")."&tabs_index=0";
	gourl($url);
} 

if($cmd == 'shop_theme_setting'){  
	$theme_id = req('theme_id'); 
  
	$sql = "UPDATE `t_shop` SET `theme_id`='$theme_id' WHERE `site_id`='".$g_siteid."' AND `shop_id`='$g_shopid'";
	$db->query($sql);   
 
	$url = "./?cmd=".base64_encode("shop_theme.php")."&tabs_index=0";
	gourl($url);
} 
?>