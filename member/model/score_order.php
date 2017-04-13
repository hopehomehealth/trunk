<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

if(req('state')!=''){
	$qer = " AND a.`state`='".req('state')."'";
}

$sql = "SELECT a.* FROM `t_user_score_order` a WHERE a.`site_id`='$g_siteid' AND a.`user_id`='$g_userid' $qer ORDER BY a.`order_id` DESC";  
$order_list = $db->get_all($sql);  
 
$sql = "SELECT COUNT(*) FROM `t_user_score_order` WHERE `site_id`='$g_siteid' AND `user_id`='$g_userid' ";	
$total_score_order_number = $db->get_value($sql);  
 
?>