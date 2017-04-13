<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

$sql = "SELECT * FROM `t_site_ad_class` WHERE `site_id`='$g_siteid'";   
$ad_cat_list = $db->get_all($sql);  

$ad_key = req('ad_key');
if($ad_key==''){
	$ad_key = 'i_t';
}

$sql = "SELECT * FROM `t_site_ad` WHERE `site_id`='$g_siteid' AND `ad_key`='$ad_key' ORDER BY `order_id` ASC ";   
$ad_rows = $db->get_all($sql);  

$sql = "SELECT MAX(`order_id`)+1 FROM `t_site_ad` WHERE `site_id`='$g_siteid' ";   
$max_order_id = $db->get_all($sql); 
?>    

