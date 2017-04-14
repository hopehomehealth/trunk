<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

$sql = "SELECT * FROM `t_site_connect` WHERE `site_id`='".$g_siteid."' ";  
$myconnect = $db->get_one($sql); 
 
?>

