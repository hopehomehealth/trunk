<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
  
$sql = "SELECT a.* FROM `t_user_order_tourist` a, t_user_order b WHERE a.order_id=b.order_id AND a.`site_id`='$g_siteid' AND b.`user_id`='$g_userid' AND a.`order_code`='".req('order_code')."' ORDER BY a.`tourist_id` DESC";	
$rows = $db->get_all($sql); 
?>