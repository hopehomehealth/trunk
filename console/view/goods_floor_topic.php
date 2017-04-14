<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>


<script type="text/javascript">
		function doform(item_id, item){
			var f =  document.getElementById('f'+item_id);
			f.action = "do.php?cmd=goods_floor_topic_edit&item_id="+item_id+"&item="+item;
			f.submit();
		} 
</script>

<ul class="nav nav-tabs" id="myTab"> 
    <li class="active" style="padding-left:20px"><a href="#tabs-1">楼层(<?=req('floor_title')?>)主题广告</a></li>
	<a href="?cmd=<?=base64_encode('goods_floor.php')?>" class="pull-right btn btn-small">返回</a>
</ul>
 
 
		<form target="frm" name="add_form" action="do.php?cmd=goods_floor_topic_add" method="post" enctype="multipart/form-data">
		  <table>
		   
			<tr>
			  <td align="right"><font color="red">*</font> 标题：</td>
			  <td><input name="ad_title" type="text"  id="ad_title" size="50" required/></td>
			</tr>
		 
			<tr>
			  <td align="right"><font color="red">*</font> 链接：</td>
			  <td><input name="ad_url" type="url"  id="ad_url" size="50" value="http://" required/></td>
			</tr> 
			
			<tr>
			  <td align="right"><font color="red">*</font> 图片：</td>
			  <td><input name="ad_image" type="file" id="ad_image" size="60" class="input_file" required/></td>
			</tr> 
			
			<tr>
			  <td align="right"><font color="red">*</font> 序号：</td>
			  <td><input name="order_id" type="number"  id="order_id" size="5" value="1" required/></td>
			</tr> 
			 
			<tr>
			  <td></td>
			  <td>
			  <input type="hidden" name="floor_id" value="<?=req('floor_id')?>">
			  <input type="hidden" name="floor_title" value="<?=req('floor_title')?>">
			  <input type="submit" value="确定" class="btn btn-danger" />
			  </td>
			</tr>
		  </table>
		</form>
		<? 
		  if(sizeof($query_rows)>0){
		?>
		<table width="99%" cellpadding="3" cellspacing="1" class="mytable">
		  <tbody class="mytbody">
		  <tr>  
			  <td width="150">图片</td>  
			  <td>标题</td>
			  <td>链接</td>
			  <td>序号</td> 
			  <td width="80">操作</td>
		  </tr>
		  </tbody>
		  <?  
			foreach ($query_rows as $val){ 
				$ad_image = "/upfiles/$g_siteid/".$val['ad_image'];
		  ?> 
		  <form target="frm" id="f<?=$val['item_id']?>" method="post" action="" > 
			<tr>     
			  <td>
			  <a href="<?=$ad_image?>" target="_blank"><img src="<?=$ad_image?>" height="60" /></a> 
			  </td> 

			  <td>
			  <input name="ad_title" type="text" id="ad_title" style="border:#FFFFFF 1px solid;" value="<?=$val['ad_title']?>" size="20" onchange="doform('<?=$val['item_id']?>', 'ad_title')" />  
			  </td> 

			  <td><input name="ad_url" type="url" id="ad_url" style="border:#FFFFFF 1px solid;" value="<?=$val['ad_url']?>" size="20" onchange="doform('<?=$val['item_id']?>', 'ad_url')" /> 
			  </td>

			  <td><input name="order_id" type="number" id="order_id" style="border:#FFFFFF 1px solid;" value="<?=$val['order_id']?>" size="5" onchange="doform('<?=$val['item_id']?>', 'order_id')" /> 
			  </td>
			   
			  <td>  
				<a href="do.php?cmd=goods_floor_topic_del&item_id=<?=$val['item_id']?>&floor_id=<?=req('floor_id')?>&floor_title=<?=req('floor_title')?>" onclick="return confirm('确认删除吗？')"><img src="static/image/delete.gif"/></a> 
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