<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

function get_cat($cat_id){
	global $db, $g_siteid;
	$sql = "SELECT * FROM `t_goods_catalog` WHERE `cat_id`='$cat_id' AND site_id='$g_siteid' ";
	return $db->get_one($sql);
}

function son_cat($parent_id){
	global $db, $g_siteid;
	$sql = "SELECT * FROM `t_goods_catalog` WHERE `parent_id`='$parent_id' AND site_id='$g_siteid' ORDER BY order_id ASC ";
	return $db->get_all($sql);
}
  
function get_blank($level){
	for($i=0; $i<$level; $i++){
		echo ' &nbsp; &nbsp; ';
	}
}
function get_cat_select($val, $level){
	global $this_cat;
?>
<option value="<?=$val['cat_id']?>" <?if($this_cat['parent_id']==$val['cat_id']){echo 'selected';}?> <?if(req('cat_id')==$val['cat_id']){echo 'disabled';}?> >
<?get_blank($level);?><?if($level>0){?>©Ä<?}?><?=$val['cat_name']?></option>
<?
}	


$this_cat = get_cat(req('cat_id'));
?>

