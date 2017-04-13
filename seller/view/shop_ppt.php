<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<div class="bar_title">
	<strong>轮播图</strong>
	<a href="javascript:location.reload()" class="pull-right btn btn-small">刷新</a>
</div> 

<script type="text/javascript">
function doform_ppt(ppt_id, item){
	var f =  document.getElementById('f'+ppt_id);
	f.action = "do.php?cmd=shop_ppt_edit_fast&ppt_id="+ppt_id+"&item="+item;
	f.submit();
} 
</script> 

    
		<form target="frm" name="add_form" action="do.php?cmd=shop_ppt_add" method="post" enctype="multipart/form-data" class="form-inline">
		  <table width="100%"> 
			<tr>
			  <td width="80" align="right"><font color="red">*</font> 类型：</td>
			  <td height="30">
				<label><input type="radio" name="ppt_type" value="0" checked>PC端</label>  &nbsp; 
				<label><input type="radio" name="ppt_type" value="1">无线端</label>
			  </td>
			</tr>

			<tr>
			  <td align="right"><font color="red">*</font> 标题：</td>
			  <td><input name="ppt_title" type="text" id="ppt_title" size="50" required/></td>
			</tr>
		 
			<tr>
			  <td align="right"><font color="red">*</font> 链接：</td>
			  <td><input name="ppt_url" type="url" id="ppt_url" size="50" value="http://" required/></td>
			</tr> 
			
			<tr>
			  <td align="right"><font color="red">*</font> 图片：</td>
			  <td><input name="ppt_image" type="file" id="ppt_image" size="60" class="input_file" required/></td>
			</tr> 
			
			<tr>
			  <td align="right"><font color="red">*</font> 序号：</td>
			  <td><input name="order_id" type="number" id="order_id" size="5" value="1" required/></td>
			</tr> 
			 
			<tr>
			  <td></td>
			  <td><input type="submit" value="确定" class="btn btn-danger"></td>
			</tr>
		  </table>
		</form>
		<? 
		if(notnull($ppt_rows)){
		?>
		<table class="table"> 
		  <tr> 
			  <td>类型</td>
			  <td>图片</td>  
			  <td>标题</td>
			  <td>链接</td>
			  <td>序号</td> 
			  <td>状态</td> 
			  <td width="50">操作</td>
		  </tr> 
		  <?  
			foreach ($ppt_rows as $val){ 
				$image = "/upfiles/$g_siteid/".$val['ppt_image'];
		  ?> 
		  <form target="frm" id="f<?=$val['ppt_id']?>" method="post" action=""  enctype="multipart/form-data"> 
			<tr>     
			  <td>
				<select name="ppt_type" onchange="doform_ppt('<?=$val['ppt_id']?>', 'ppt_type')" class="input-small">  
					<option value="0" <? if($val['ppt_type']==0) {echo 'selected';} ?> >PC端</option> 
					<option value="1" <? if($val['ppt_type']==1) {echo 'selected';} ?> >无线端</option> 
				</select>	
			  </td>

			  <td>
			  <a href="<?=$image?>" target="_blank"><img src="<?=$image?>" style="width:200px" /></a> 
			 
			  <div style="margin-top:10px">
				<input type="file" name="ppt_image"> <input type="button" value="更新" class="btn btn-small" onclick="doform_ppt('<?=$val['ppt_id']?>', 'ppt_image')">
			  </div>
			  </td> 

			  <td>
			  <input name="ppt_title" type="text" id="ppt_title" value="<?=$val['ppt_title']?>" class="input-small" onchange="doform_ppt('<?=$val['ppt_id']?>', 'ppt_title')" required/>  
			  </td> 

			  <td><input name="ppt_url" type="url" id="ppt_url" value="<?=$val['ppt_url']?>" class="input-small" onchange="doform_ppt('<?=$val['ppt_id']?>', 'ppt_url')" required/> 
			  </td>

			  <td><input name="order_id" type="number" id="order_id" value="<?=$val['order_id']?>" class="input-small" onchange="doform_ppt('<?=$val['ppt_id']?>', 'order_id')" required/> 
			  </td>

			  <td>
			  <select name="state" onchange="doform_ppt('<?=$val['ppt_id']?>', 'state')" class="input-small">
				<option value="1" <?if($val['state']=='1'){?>selected<?}?>>启用
				<option value="0" <?if($val['state']=='0'){?>selected<?}?>>禁用
			  </select>
			  </td>
			   
			  <td>  
				<a href="do.php?cmd=shop_ppt_del&ppt_id=<?=$val['ppt_id']?>" onclick="return confirm('确认删除吗？')"><img src="static/image/delete.gif"/></a> 
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
 