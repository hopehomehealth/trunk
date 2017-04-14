<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

$sql = "SELECT * FROM `t_site_config` WHERE `site_id`='".$g_siteid."' ";  
$mysite = $db->get_one($sql);
?>
 
 