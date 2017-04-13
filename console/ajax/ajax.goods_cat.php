<? 
include(dirname(dirname(__FILE__)).'/auth.php');
include(dirname(dirname(__FILE__)).'/config.php');

$parent_id	= req('pid');
$name		= req('name');


$sql  = "SELECT * FROM `t_goods_catalog` WHERE `parent_id`='$parent_id' AND site_id='$g_siteid' ORDER BY `cat_name` ASC ";
$cats = $db->get_all($sql);

if(req('ac')=='cat2'){ 
	if(notnull($cats)){ 
	?>
	<select name="<?=$name?>" onchange="load_goods_cat3(this.value, 'cat3')" required> 
	<?
		foreach ($cats as $val){   
	?>
	<option value="<?=$val['cat_id']?>"><?=$val['cat_name']?></option>
	<?
		}
	?>
	</select>
	<?
	}
}
?> 

<?
if(req('ac')=='cat3'){ 
	if(notnull($cats)){ 
	?>
	<select name="<?=$name?>" required> 
	<?
		foreach ($cats as $val){   
	?>
	<option value="<?=$val['cat_id']?>"><?=$val['cat_name']?></option>
	<?
		}
	?>
	</select>
	<?
	}
}
?>
 