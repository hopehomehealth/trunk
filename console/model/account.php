<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
 
$sql = "SELECT * FROM `t_admin` WHERE site_id='$g_siteid' ORDER BY account_id ASC";  

$rows = $db->get_all($sql); 
?>

