<? 
include('config.php');
 
if(req('parent_code')=='' || req('type')==''){
	exit;
}

$db->query("set names utf8"); 

function get_region($parent_code){
	global $db; 

	$sql = "SELECT * FROM `t_common_region` WHERE `parent_code`='$parent_code' ORDER BY order_id ASC";	
	return $db->get_all($sql); 
}

$rows = get_region(req('parent_code'));

 
if(notnull($rows) && req('type')=='city'){ 
?>
<select id="city" name="city" onchange="selectArea(this.value)" class="span2" style="height:30px;">
<option value=""></option>
<?
	foreach ($rows as $val){  	
?> 
<option value="<?=$val['region_code']?>"><?=$val['region_name']?></option> 
<?
	}
?>
</select> 
<?
} 

if(notnull($rows) && req('type')=='area'){ 
?>
<select id="area" name="area" class="span3" style="height:30px;">
<option value=""></option>
<?
	foreach ($rows as $val){  	
?> 
<option value="<?=$val['region_code']?>"><?=$val['region_name']?></option> 
<?
	}
?>
</select>
<?
}
?>
