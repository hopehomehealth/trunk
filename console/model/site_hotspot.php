<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

$sql = "SELECT max(`order_id`)+1 FROM `t_site_hotspot` WHERE `site_id`='$g_siteid'";  
$max_order_id = $db->get_value($sql); 

function get_hotspot($parent_id){
	global $db, $g_siteid;
	$sql = "SELECT * FROM `t_site_hotspot` WHERE `site_id`='$g_siteid' AND `parent_id`='$parent_id' ORDER BY `order_id` ASC";  
	return $db->get_all($sql); 
}
  
function get_opt($val, $l){
?>
<option value="<?=$val['hotspot_id']?>"><?for($i=1;$i<$l;$i++){echo ' &nbsp; &nbsp; ';}?> ©Ä <?=$val['title']?></option>
<?
}
?>


