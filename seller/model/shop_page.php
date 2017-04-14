<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

$sql = "SELECT * FROM `t_shop_page` WHERE site_id='$g_siteid' AND shop_id='$g_shopid' ";    
$detail = $db->get_one($sql);  

if($detail['page_id']==''){
	$sql = "INSERT INTO `t_shop_page` (`site_id`, `shop_id`, `key`, `title`, `content`) VALUES ('$g_siteid', '$g_shopid', 'aboutus', '关于我们', '')";
	$db->query($sql);  

	$sql = "SELECT * FROM `t_shop_page` WHERE site_id='$g_siteid' AND shop_id='$g_shopid' ";    
	$detail = $db->get_one($sql);  
}

$page_id = $detail['page_id']; 
 
?> 