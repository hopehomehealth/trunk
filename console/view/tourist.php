<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>


<ul class="nav nav-tabs">   
	<li class="active" style="padding-left:20px;">
		<a href="#">���οͻ�����</a>
	</li>  
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul>  

 

		<form name="q_from" method="GET" action="" class="form-inline">  

			<input name="cmd" type="hidden" value="<?=base64_encode('tourist.php')?>"/>

			<input name="kw" type="text" id="kw" class="span4" value="<?=req('kw')?>" placeholder="�����š���Ʒ�ؼ��ʡ�" required/> 
				 
			<input type="image" src="static/image/find.gif" class="input_img" title="����"/> 
				 
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
			<td width="100"><strong>������</strong></td>
			<td><strong>��Ʒ����</strong></td>  
			<td width="120"><strong>�ο�����</strong></td> 
			<td width="120"><strong>�ο����֤</strong></td> 
			<td width="80"><strong>�ο�����</strong></td> 
			<td width="80" align="center"><strong>�� ��</strong></td>
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
				<a href="do.php?cmd=tourist_del&tourist_id=<?=$val['tourist_id']?>" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif"/></a>
			</td>
		  </tr>
		  </form>
		  <?	 
			}
		  ?>
		</table>

		<div style="text-align:right;padding-right:10px;">  
			<br/>
			����<b><?=$total_number?></b>�� &nbsp;
			<a href="./?cmd=<?=base64_encode('tourist.php')?>&kw=<?=req('kw')?>&p=1">��ҳ</a>
			<a href="./?cmd=<?=base64_encode('tourist.php')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">��һҳ</a> 
			��<?=$now_page?> / <?=$total_page?>ҳ 
			<a href="./?cmd=<?=base64_encode('tourist.php')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">��һҳ</a>
			<a href="./?cmd=<?=base64_encode('tourist.php')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">βҳ</a>
		</div>
		<?	 
		}
		?> 