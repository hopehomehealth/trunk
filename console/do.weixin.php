<?   

if($cmd == 'wx_home_nav_edit'){   
	$item   = req('item'); 
	$nav_id = req('nav_id'); 
	 
	$sql = "UPDATE `t_wx_home_nav` SET ".$item."='".req($item)."' WHERE `site_id`='$g_siteid' AND `nav_id`='$nav_id'";
	$db->query($sql);  

	sendresult("已保存更改"); 
} 



if($cmd == 'wx_home_dist_add'){   
	$dist_title 		= req('dist_title');
	$dist_url	 	= req('dist_url');  
	$order_id		= req('order_id'); 
 
	$dist_image = get_ym_upfile('dist_image');  
	
	$sql = "INSERT INTO `t_wx_home_dist` (`site_id`, `dist_title`, `dist_url`, `dist_image` , `order_id` ) VALUES ('$g_siteid', '$dist_title', '$dist_url', '$dist_image', '$order_id');";
	
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("wx_home_dist.php");
	gourl($url);
} 

if($cmd == 'wx_home_dist_edit_fast'){  
	$item = req('item'); 
	$dist_id = req('dist_id');

	if($item == 'dist_image'){ 
		$dist_image = get_ym_upfile('dist_image');  

		$sql = "UPDATE `t_wx_home_dist` SET `dist_image`='$dist_image' WHERE `site_id`='$g_siteid' AND `dist_id`='$dist_id'";
		$db->query($sql); 
		
		$url = "./?cmd=".base64_encode("wx_home_dist.php");
		gotourl($url);

	} else {  
		$sql = "UPDATE `t_wx_home_dist` SET ".$item."='".req($item)."' WHERE `site_id`='$g_siteid' AND `dist_id`='$dist_id'";
		$db->query($sql);  
		sendresult("已保存更改");
	} 
}

if($cmd == 'wx_home_dist_del'){    
	$dist_id = req('dist_id'); 
  
	$sql = "DELETE FROM `t_wx_home_dist` WHERE `site_id`='$g_siteid' AND `dist_id`='$dist_id'";
	$db->query($sql);  

	$url = "./?cmd=".base64_encode("wx_home_dist.php");
	gourl($url);
} 

 
?>