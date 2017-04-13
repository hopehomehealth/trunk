<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
  
$sql = "SELECT * FROM `t_user_score` WHERE `site_id`='$g_siteid' AND `user_id`='$g_userid' ORDER BY `score_id` DESC";	
$rows = $db->get_all($sql); 

$sql = "SELECT SUM(`score_number`) FROM `t_user_score` WHERE `site_id`='$g_siteid' AND `user_id`='$g_userid' ";	
$total_score_number = $db->get_value($sql); 
?>