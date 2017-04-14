<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>


<script type="text/javascript">
$(document).ready(function(){
	$('#myTab a').click(function (e) { 
		e.preventDefault();
		$(this).tab('show'); 
	})
}); 
</script>

<ul class="nav nav-tabs" id="myTab"> 
  <li class="active" style="padding-left:20px"><a href="#tabs-1">线下门店</a></li>
  <li><a href="#tabs-2">新增门店</a></li> 
  <a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul>

<div class="tab-content"> 
	<div class="tab-pane in active" id="tabs-1"> 
		<script type="text/javascript">
		function doform(store_id, item){
			var f =  document.getElementById('f'+store_id);
			f.action = "do.php?cmd=local_store_edit_fast&store_id="+store_id+"&item="+item;
			f.submit();
		} 
		</script>

		<? 
		if(sizeof($local_store_rows)>0){
		?>
		<table class="table">
		  <thead>
		  <tr>  
			  <td>门店名称</td>
			  <td>门店照片</td>  
			  <td>门店地址</td>
			  <td>门店电话</td>
			  <td>序号</td> 
			  <td><strong>是否启用</strong></td> 
			  <td width="40" style="text-align:center">操作</td>
		  </tr>
		  </thead>
		  <?  
			foreach ($local_store_rows as $val){ 
				$store_image = "/upfiles/$g_siteid/".$val['store_image'];
				$profile     = unserialize($val['profile']);
		  ?> 
		  <form target="frm" id="f<?=$val['store_id']?>" method="post" action=""  enctype="multipart/form-data"> 
			<tr>   
			  <td>
			  <input name="store_name" type="text" id="store_name" value="<?=$profile['store_name']?>" size="20" onchange="doform('<?=$val['store_id']?>', 'store_name')" style="width:150px"/>  
			  </td> 

			  <td>
			  <a href="<?=$store_image?>" target="_blank"><img src="<?=$store_image?>" style="width:100px;height:80px;margin-bottom:10px" onerror="this.style.display='none'"/></a> 
			 
			  <div>
				<input type="file" name="store_image" class="btn " style="width:150px"> <input type="button" value="更新" class="btn  " onclick="doform('<?=$val['store_id']?>', 'store_image')">
			  </div>
			  </td> 

			  <td>
			  <input name="address" type="text" id="address" value="<?=$profile['address']?>" size="20" onchange="doform('<?=$val['store_id']?>', 'address')" />  
			  </td> 

			  <td><input name="tel" type="text" id="tel" value="<?=$profile['tel']?>" style="width:120px" onchange="doform('<?=$val['store_id']?>', 'tel')" /> 
			  </td>

			  <td><input name="order_id" type="number" id="order_id" value="<?=$val['order_id']?>" class="input-mini" onchange="doform('<?=$val['store_id']?>', 'order_id')" /> 
			  </td>

			  <td>
				  <select id="state" name="state" class="input-small" onchange="doform('<?=$val['store_id']?>', 'state')">
					<option value="1" <?if($val['state']=='1'){?>selected<?}?>>启用</option>
					<option value="0" <?if($val['state']=='0'){?>selected<?}?>>禁用</option>
				  </select>
			  </td>
			   
			  <td style="text-align:center">  
				  <a href="do.php?cmd=local_store_del&store_id=<?=$val['store_id']?>" onclick="return confirm('确认删除吗？')"><img src="static/image/delete.gif"/></a> 
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
	</div>
	<div class="tab-pane" id="tabs-2">
		<form target="frm" name="add_form" action="do.php?cmd=local_store_add" method="post" enctype="multipart/form-data" class="form-inline">
		  <table> 

			<tr>
			  <td align="right"><font color="red">*</font> 门店名称：</td>
			  <td><input name="store_name" type="text" id="store_name" size="50" required/></td>
			</tr> 
		 
			<tr>
			  <td align="right"><font color="red">*</font> 门店地址：</td>
			  <td><input name="address" type="text"  id="address" size="50" required/></td>
			</tr> 
			
			<tr>
			  <td align="right"><font color="red">*</font> 联系电话：</td>
			  <td><input name="tel" type="text" id="tel" size="60" required/></td>
			</tr> 

			<tr>
			  <td align="right"><font color="red">*</font> 门店照片：</td>
			  <td><input name="store_image" type="file" id="store_image" size="50" required/></td>
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
	</div>
</div>