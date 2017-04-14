<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
  
$user_id = req('user_id');

$sql = "SELECT * FROM t_user WHERE site_id='$g_siteid' AND user_id='$user_id' ";  
$detail = $db->get_one($sql);  


$sql = "SELECT * FROM t_user_level WHERE site_id='$g_siteid' ORDER BY `level_type` ASC";  
$user_level_list = $db->get_all($sql);  
?>

