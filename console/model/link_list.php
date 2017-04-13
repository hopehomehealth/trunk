<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

$sql = "SELECT * FROM t_friendlink WHERE site_id='$g_siteid' ORDER BY link_id DESC ";   
 
$query_rows = $db->get_all($sql);  
?>   

