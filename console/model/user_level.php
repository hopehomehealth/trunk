<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
 

$sql = "SELECT * FROM `t_user_level` WHERE `site_id`='".$g_siteid."' ORDER BY `level_id` ASC ";   
$query_rows = $db->get_all($sql); 
 
?>   

