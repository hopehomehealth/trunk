<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

function son_cat($parent_id){
	global $db, $g_siteid;
  
	$sql = "SELECT * FROM `t_goods_catalog` WHERE `parent_id`='$parent_id' AND site_id='$g_siteid' $qer ORDER BY order_id ASC ";
	return $db->get_all($sql);
} 

function get_blank($level){
	for($i=0; $i<$level; $i++){
		echo ' &nbsp; &nbsp; ';
	}
}

function has_son_cat($parent_id){
	global $db, $g_siteid;
  
	$sql = "SELECT `cat_id` FROM `t_goods_catalog` WHERE `parent_id`='$parent_id' AND site_id='$g_siteid' LIMIT 0,1";
	$rs = $db->get_value($sql);

	if($rs!='') return true;
	else return false;
}

function get_cat_select($val, $level){
?>
	<option value="<?=$val['cat_id']?>"><?get_blank($level)?> <?if($level>0){?>©Ä<?}?> <?=$val['cat_name']?></option>
<?
}	

$sql = "SELECT max(order_id)+1 FROM t_goods_catalog WHERE site_id='$g_siteid'";  
$max_order_id = $db->get_value($sql); 
  
?>