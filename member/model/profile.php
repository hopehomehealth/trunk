<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
 
$sql = "SELECT * FROM t_user WHERE user_id='$g_userid' AND site_id='$g_siteid' ";  
$profile =  $db->get_one($sql); 
?>
