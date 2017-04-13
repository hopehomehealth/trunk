<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
  
$sql = "SELECT a.* FROM `t_user_bill` a, t_user_order b WHERE a.`site_id`='$g_siteid' AND b.`user_id`='$g_userid' AND a.site_order_code=b.order_code ORDER BY a.`addtime` DESC";	
$rows = $db->get_all($sql); 
?>
 
 