<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>  

<ul class="nav nav-tabs">   
	<li <?if(nav_active('comment_list.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('comment_list.php')?>">��Ա����</a>
	</li>   
	<li <?if(nav_active('comment_add.php')){?>class="active"<?}?> >
		<a href="?cmd=<?=base64_encode('comment_add.php')?>">��������</a>
	</li>   

	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul> 
 
		<form  name="q_from" method="GET" action="" class="form-inline"> 
	 
		<input name="cmd" type="hidden" value="<?=base64_encode('comment_list.php')?>"/>
		 
			<input name="kw" type="text" id="kw" size="50" value="<?=req('kw')?>" placeholder="����ؼ���..."/> 
			&nbsp;
			<input type="image" src="static/image/find.gif" class="input_img"/>   
		</form> 
		
		<script type="text/javascript">
		function doform(comment_id, item){
			var f =  document.getElementById('f'+comment_id);
			f.action = "do.php?cmd=comment_fast_edit&comment_id="+comment_id+"&item="+item;
			f.submit();
		} 
		</script>

		<? 
		if(notnull($query_rows)){
		?>
		<table class="table table-hover"> 
		  <tr>  
			<td><strong>��Ա�û���</strong></td>
			<td><strong>��Ʒ����</strong></td> 
			<td width="350">��������</td>
			<td><strong>���۵ȼ�</strong></td>  
			<td><strong>����</strong></td>  
			<td width="100"><strong>��������</strong></td>
			<td width="80" align="center"><strong>�� ��</strong></td>
		  </tr> 
		  <?  
			foreach ($query_rows as $val){    	
		  ?>
		  <form target="frm" id="f<?=$val['comment_id']?>" method="post" action="" > 
		  <tr> 
			<td><?=$val['account']?></td>
			<td><a href="preview.php?ac=goods&goods_id=<?=$val['goods_id']?>" target="_blank"><?=$val['goods_name']?></a></td>
			<td>
				<textarea id="content" name="content" rows="3" style="width:350px" onchange="doform('<?=$val['comment_id']?>', 'content')"><?=$val['content']?></textarea>
			</td>
			<td><?=$g_comment_level[$val['comment_level']]?></td> 
			<td><?=$val['comment_star']?>��</td> 
			<td><?=$val['addtime']?></td>
			<td align="center"> 
				<a href="do.php?cmd=comment_del&comment_id=<?=$val['comment_id']?>&ref=<?=base64_encode($g_url)?>" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif"/></a></td>
		  </tr>
		  </form>
		  <?	 
			}
		  ?>
		</table>

		<div style="text-align:right;padding-right:10px;">  
			<br/>
			����<b><?=$total_number?></b>�� &nbsp;
			<a href="./?cmd=<?=base64_encode('comment_list.php')?>&kw=<?=req('kw')?>&p=1">��ҳ</a>
			<a href="./?cmd=<?=base64_encode('comment_list.php')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">��һҳ</a> 
			��<?=$now_page?> / <?=$total_page?>ҳ 
			<a href="./?cmd=<?=base64_encode('comment_list.php')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">��һҳ</a>
			<a href="./?cmd=<?=base64_encode('comment_list.php')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">βҳ</a>
		</div>
		<?	 
		} else {
		?> 
		<div class="alert">û�в�ѯ�������Ϣ��</div>
		<?}?>
 