<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
  
$sql = "SELECT * FROM `t_page` WHERE `site_id`='$g_siteid' ORDER BY `order_id` ASC";    
$query_rows = $db->get_all($sql);  

?> 

