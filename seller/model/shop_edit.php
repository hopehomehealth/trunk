<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
 


$shop_id = req('shop_id');

$sql = "SELECT * FROM t_shop WHERE site_id='$g_siteid' AND shop_id='$shop_id' ";  
$detail = $db->get_one($sql);  
 
?>

