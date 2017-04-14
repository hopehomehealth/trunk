<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

function son_cat($parent_id){
	global $db, $g_siteid, $g_shopid;
  
	$sql = "SELECT * FROM `t_shop_goods_catalog` WHERE `parent_id`='$parent_id' AND site_id='$g_siteid' AND shop_id='$g_shopid' ORDER BY order_id ASC ";
	return $db->get_all($sql);
} 
 
function get_blank($level){
	for($i=0; $i<$level; $i++){
		echo ' &nbsp; &nbsp; ';
	}
}
function get_cat_select($val, $level){
?>
	<option value="<?=$val['cat_id']?>"><?get_blank($level)?> <?if($level>0){?>©Ä<?}?> <?=$val['cat_name']?></option>
<?
}	 

$sql = "SELECT MAX(`order_id`)+1 FROM t_shop_goods_catalog WHERE site_id='$g_siteid' AND `shop_id`='$g_shopid'";  
$max_order_id = $db->get_value($sql); 
?>

