<?
include('../auth.php');
include('../config.php'); 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?$g_console_debug==true? print $cmd : ''?> 电子商务服务平台 - 云梯数据</title>
 
<link href="/ajax/bootstrap-2.3.2/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
</head>

<body style="padding:20px"> 

<form method="get" action="?" class="form-inline"> 
	<input type="hidden" name="ac" value="do">
	新数据库：<input type="text" name="new_db" value="<?=req('new_db')?>" required>
	&nbsp;
	老数据库：<input type="text" name="old_db" value="<?=req('old_db')?>" required>
	<input type="submit" class="btn">
</form>

<table class="table table-hover table-bordered">
<tr> 
	<th><?=req('new_db')?> 表名称</th>
	<th><?=req('old_db')?> 缺表</th>
	<th><?=req('old_db')?> 缺少字段</th>
	<th><?=req('old_db')?> 多余字段</th> 
</tr>
<?
if(req('ac')=='do'){
	$new_db = req('new_db');
	$old_db = req('old_db');

	$sql = "SELECT `TABLE_SCHEMA`,`TABLE_NAME` FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='$new_db' group by `TABLE_NAME` ";  
	$new_db_tables = $db->get_all($sql);

	if(notnull($new_db_tables)){
		foreach ($new_db_tables as $new_v){ 
			$sql = "SELECT `TABLE_NAME` FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='$old_db' AND `TABLE_NAME`='".$new_v['TABLE_NAME']."' ";   
			$this_table = $db->get_one($sql);
			
			if($this_table['TABLE_NAME']!=''){
				$sql = "SELECT `COLUMN_NAME` FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='$new_db' AND `TABLE_NAME`='".$new_v['TABLE_NAME']."' AND `COLUMN_NAME` NOT IN (SELECT `COLUMN_NAME` FROM `information_schema`.`COLUMNS` t WHERE t.TABLE_SCHEMA='$old_db' AND t.`TABLE_NAME`='".$new_v['TABLE_NAME']."')";    
				$lost_cols = $db->get_all($sql);
			}

			if($this_table['TABLE_NAME']!=''){
				$sql = "SELECT `COLUMN_NAME` FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='$old_db' AND `TABLE_NAME`='".$new_v['TABLE_NAME']."' AND `COLUMN_NAME` NOT IN (SELECT `COLUMN_NAME` FROM `information_schema`.`COLUMNS` t WHERE t.TABLE_SCHEMA='$new_db' AND t.`TABLE_NAME`='".$new_v['TABLE_NAME']."')";   
				$more_cols = $db->get_all($sql);
			}
?>
<tr <?if($this_table['TABLE_NAME']==''){?>class="error"<?}?>> 
	<td><?=$new_v['TABLE_NAME']?></td>
	<td>
	<?if($this_table['TABLE_NAME']==''){?>
	缺失
	<?}?>
	</td>
	<td>
	<?
	if($this_table['TABLE_NAME']!='' && notnull($lost_cols)){
		foreach ($lost_cols as $lost_cols_val){ 
			echo $lost_cols_val['COLUMN_NAME'].' &nbsp; ';
		}
	}
	?>
	</td> 
	<td>
	<?
	if($this_table['TABLE_NAME']!='' && notnull($more_cols)){
		foreach ($more_cols as $more_cols_val){ 
			echo $more_cols_val['COLUMN_NAME'].' &nbsp; ';
		}
	}
	?>
	</td>
</tr>
<?
	}
}
?>
</table>
<?}?>
</body>
</html>