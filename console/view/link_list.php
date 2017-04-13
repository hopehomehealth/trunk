<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs">   
	<li class="active" style="padding-left:20px;">
		<a href="#">友情链接管理</a>
	</li>  
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul>  
  
		<form target="frm" name="add_from" method="POST" action="do.php?cmd=link_add" class="form-inline"> 
			<font color="red">*</font>链接标题：<input name="link_title" type="text" id="link_title" class="span2" required/> 
			<font color="red">*</font>链接网址：<input name="link_url" type="url" id="link_url" class="span3" required/> 
			<font color="red">*</font>序号：<input name="order_id" type="number" id="order_id" class="span1" required/>&nbsp;
			<input type="submit" value="确定" class="btn btn-danger" />
		</form> 

		<script type="text/javascript">
				function doform(link_id, item){
					var f =  document.getElementById('f'+link_id);
					f.action = "do.php?cmd=link_edit_fast&link_id="+link_id+"&item="+item;
					f.submit();
				} 
		</script>

		<?  
		if(notnull($query_rows)){
		?>
		<table width="100%"  class="table table-hover"> 
		  <thead>
		  <tr>  
			  <td>链接标题</td>
			  <td>链接网址</td> 
			  <td>序号</td> 
			  <td width="100">操作</td>
		  </tr> 
		  </thead>
		  <?  
		  foreach ($query_rows as $val){    	
		  ?> 
		  <form id="f<?=$val['link_id']?>" method="post" action="" target="frm" > 
			<tr>     

			  <td><input  name="link_title" type="text" id="link_title" class="span3" value="<?=$val['link_title']?>"  onchange="doform('<?=$val['link_id']?>', 'link_title')" required/>
			  </td>

			  <td>
			  <input  name="link_url" type="url" id="link_url" style="" value="<?=$val['link_url']?>" class="span3" onchange="doform('<?=$val['link_id']?>', 'link_url')" required/>
			  </td> 

			  <td><input  name="order_id" type="number" id="order_id" style="" value="<?=$val['order_id']?>" class="span1" onchange="doform('<?=$val['link_id']?>', 'order_id')" required/>
			  </td>  
			  
			  <td>  
				<a href="<?=$val['link_url']?>" target="_blank"><img src="static/image/view.gif"/></a> &nbsp; 
				<a href="do.php?cmd=link_del&link_id=<?=$val['link_id']?>" onclick="return confirm('确认删除吗？')"><img src="static/image/delete.gif"/></a> 
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
 