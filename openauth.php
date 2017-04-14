<?
include("config.php"); 

$sql = "SELECT `taobao_xauth` FROM `t_site_config` WHERE `site_id`='".$g_siteid."' ";  
$taobao_xauth = $db->get_value($sql);  

echo stripslashes($taobao_xauth);
?>