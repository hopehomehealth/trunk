<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
  
$sql = "SELECT * FROM `t_shop_theme` ORDER BY theme_id ASC";    
$query_rows = $db->get_all($sql);  

?> 

