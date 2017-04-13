<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>


<ul class="nav nav-tabs">   
	<li class="active" style="padding-left:20px;">
		<a href="#">出游客户管理</a>
	</li>  
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul>  

 

		<form name="q_from" method="GET" action="" class="form-inline">  

			<input name="cmd" type="hidden" value="<?=base64_encode('tourist.php')?>"/>

			<input name="kw" type="text" id="kw" class="span4" value="<?=req('kw')?>" placeholder="订单号、产品关键词…" required/> 
				 
			<input type="image" src="static/image/find.gif" class="input_img" title="搜索"/> 
				 
		</form> 

		<script type="text/javascript">
		function doform(tourist_id, item){
			var f =  document.getElementById('f'+tourist_id);
			f.action = "do.php?cmd=tourist_edit_fast&tourist_id="+tourist_id+"&item="+item;
			f.submit();
		} 
		</script>

		<? 
		if(notnull($query_rows)){
		?>
		<table class="table table-hover"> 
		  <tr> 
			<td width="100"><strong>订单号</strong></td>
			<td><strong>产品名称</strong></td>  
			<td width="120"><strong>游客姓名</strong></td> 
			<td width="120"><strong>游客身份证</strong></td> 
			<td width="80"><strong>游客年龄</strong></td> 
			<td width="80" align="center"><strong>操 作</strong></td>
		  </tr> 
		  <?  
			foreach ($query_rows as $val){    	
		  ?>
		  <form target="frm" id="f<?=$val['tourist_id']?>" method="post" action="" >
		  <tr> 
			<td><?=$val['order_code']?></td> 

			<td><a href="preview.php?ac=goods&goods_id=<?=$val['goods_id']?>" target="_blank"><?=$val['goods_name']?></a></td> 

			<td> 
			<input name="user_name" type="text" id="user_name" value="<?=$val['user_name']?>" size="10" onchange="doform('<?=$val['tourist_id']?>', 'user_name')" class="input-small"/>
			</td> 

			<td> 
			<input name="user_idcard" type="text" id="user_idcard" value="<?=$val['user_idcard']?>" size="10" onchange="doform('<?=$val['tourist_id']?>', 'user_idcard')" class="span3"/>
			</td> 

			<td> 
			<input name="user_age" type="number" id="user_age" value="<?=$val['user_age']?>" size="10" onchange="doform('<?=$val['tourist_id']?>', 'user_age')" class="span1"/>
			</td> 

			<td align="center"> 
				<a href="do.php?cmd=tourist_del&tourist_id=<?=$val['tourist_id']?>" onclick="return confirm('确认删除吗？')"><img src="static/image/delete.gif"/></a>
			</td>
		  </tr>
		  </form>
		  <?	 
			}
		  ?>
		</table>

		<div style="text-align:right;padding-right:10px;">  
			<br/>
			共计<b><?=$total_number?></b>条 &nbsp;
			<a href="./?cmd=<?=base64_encode('tourist.php')?>&kw=<?=req('kw')?>&p=1">首页</a>
			<a href="./?cmd=<?=base64_encode('tourist.php')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">上一页</a> 
			第<?=$now_page?> / <?=$total_page?>页 
			<a href="./?cmd=<?=base64_encode('tourist.php')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">下一页</a>
			<a href="./?cmd=<?=base64_encode('tourist.php')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">尾页</a>
		</div>
		<?	 
		}
		?> 