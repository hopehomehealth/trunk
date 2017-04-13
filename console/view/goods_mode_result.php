<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link href="static/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 

<link href="static/image/style.css" rel="stylesheet" type="text/css" />

</head>
<body style="padding:10px;">  

<script type="text/javascript">
function doform_mode_result(join_id, item){
	var f =  document.getElementById('f'+join_id);
	f.action = "do.php?cmd=mode_result_edit&join_id="+join_id+"&item="+item;
	f.submit();
} 
</script>
<? 
if(notnull($query_rows)){
?>  
<table class="table table-hover"> 
    <thead>
    <tr>
      <td width="60">产品编号</td> 
      <td>缩略图</td> 
	  <td>产品名称</td>
	  <td width="80">序号</td>
	  <td >操作</td>
    </tr> 
	</thead>
  <?  
	foreach ($query_rows as $val){    	
		$goods_image = "/upfiles/$g_siteid/".$val['goods_image'];
		
  ?> 
	<form target="frm" id="f<?=$val['join_id']?>" action="" method="post" >
    <tr>
	  <td><?=$val['goods_id']?></td> 
	  <td><img src="<?=$goods_image?>" height="30" width="30" class="thumbnail"/></td>  
	  <td><a href="preview.php?ac=goods&goods_id=<?=$val['goods_id']?>" target="_blank"><?=$val['goods_name']?></a></td>  

	  <td><input name="order_id" type="number" id="order_id" value="<?=$val['order_id']?>" class="span1" onchange="doform_mode_result('<?=$val['join_id']?>', 'order_id')"/></td>

	  <td align="center"><a href="do.php?cmd=mode_result_del&mode_id=<?=$val['mode_id']?>&join_id=<?=$val['join_id']?>" onclick="return confirm('确认移除吗？')" title="从该组移除" class="btn btn-info btn-small">移除</a></td>
    </tr>
	</form>
  <?
  } 
  ?> 
</table>  
<?
} 
?>
<div style="padding-top:10px;">共计<b><?=sizeof($query_rows)?></b>条数据</div>
</body>
</html>