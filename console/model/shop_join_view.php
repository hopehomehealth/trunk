<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}  

$join_id = req('join_id');

$sql = "SELECT * FROM `t_shop_join` WHERE `site_id`='$g_siteid' AND `join_id`='$join_id' ";  
$rs = $db->get_one($sql); 
$detail = unserialize($rs['profiles']); 
?>

