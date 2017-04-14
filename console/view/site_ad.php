<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs"> 
	<?
	if(notnull($ad_cat_list)){
		$i=1;
		foreach ($ad_cat_list as $val){  
	?>
	<li <?if($ad_key==$val['ad_key']){?>class="active"<?}?> <?if($i==1){?>style="padding-left:20px;"<?}?>>
		<a href="?cmd=<?=base64_encode('site_ad.php')?>&ad_key=<?=$val['ad_key']?>"><?=$val['title']?></a>
	</li>    
	<?
		$i++;
		}
	}
	?>
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul> 

<script type="text/javascript">
function doform_ad(ad_id, item){
	var f =  document.getElementById('f'+ad_id);
	f.action = "do.php?cmd=ad_edit_fast&ad_id="+ad_id+"&item="+item;
	f.submit();
} 
</script>

<form target="frm" name="add_form" action="do.php?cmd=ad_add" method="post" enctype="multipart/form-data" class="form-inline">
  <input type="hidden" name="ad_key" value="<?=$ad_key?>">
  <table> 
    <tr>
      <td align="right"><font color="red">*</font> 标题：</td>
      <td><input name="ad_title" type="text"  id="ad_title" size="50" required/></td>
    </tr>
 
	<tr>
      <td align="right"><font color="red">*</font> 网址：</td>
      <td><input name="ad_url" type="text"  id="ad_url" size="50" required/></td>
    </tr> 
	
	<tr>
      <td align="right"><font color="red">*</font> 图片：</td>
      <td><input name="ad_image" type="file" id="ad_image" size="60" class="input_file" required/></td>
    </tr> 
	
	<tr>
      <td align="right"><font color="red">*</font> 序号：</td>
      <td><input name="order_id" type="number" id="order_id" size="5" value="<?=$max_order_id?>" required/></td>
    </tr> 
	 
    <tr>
	  <td></td>
      <td><input type="submit" value="确定" class="btn btn-danger"></td>
    </tr>
  </table>
</form>
<? 
if(sizeof($ad_rows)>0){
?>
<table  class="table">
  <thead>
  <tr>  
      <td>图片</td>  
	  <td>标题</td>
      <td>链接</td>
	  <td>序号</td> 
      <td width="80">操作</td>
  </tr>
  </thead>
  <?  
	foreach ($ad_rows as $val){ 
		$ad_image = "/upfiles/$g_siteid/".$val['ad_image'];
  ?> 
  <form target="frm" id="f<?=$val['ad_id']?>" method="post" action=""  enctype="multipart/form-data"> 
    <tr>      
	  <td>
	  <a href="<?=$ad_image?>" target="_blank"><img src="<?=$ad_image?>" style="height:60px;" onerror="this.style.display='none'"/></a> 
	 
	  <div style="margin-top:10px">
		<input type="file" name="ad_image"> <input type="button" value="更新" class="btn btn-small" onclick="doform_ad('<?=$val['ad_id']?>', 'ad_image')">
	  </div>
	  </td> 

	  <td>
	  <input name="ad_title" type="text" id="ad_title" value="<?=$val['ad_title']?>" size="20" onchange="doform_ad('<?=$val['ad_id']?>', 'ad_title')" />  
	  </td> 

	  <td><input name="ad_url" type="text" id="ad_url" value="<?=$val['ad_url']?>" size="20" onchange="doform_ad('<?=$val['ad_id']?>', 'ad_url')" /> 
	  </td>

	  <td><input name="order_id" type="number" id="order_id" value="<?=$val['order_id']?>" class="input-mini" onchange="doform_ad('<?=$val['ad_id']?>', 'order_id')" /> 
	  </td>
	   
      <td>  
		<a href="do.php?cmd=ad_del&ad_id=<?=$val['ad_id']?>&ad_key=<?=$val['ad_key']?>" onclick="return confirm('确认删除吗？')"><img src="static/image/delete.gif"/></a> 
	  </td>
    </tr>
  </form> 
  <?
  } 
  ?> 
</table> 
<?
} 
?> 
