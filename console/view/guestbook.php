<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>


<ul class="nav nav-tabs">   
	<li class="active" style="padding-left:20px;">
		<a href="#">�ͻ�����</a>
	</li>  
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul>  
  
		<form name="q_from" method="GET" action="" class="form-inline">  
			<input name="cmd" type="hidden" value="<?=base64_encode('guestbook.php')?>"/> 
			<input name="kw" type="text" id="kw" size="50" value="<?=req('kw')?>" required/> 
			&nbsp;
			<input type="image" src="static/image/find.gif" class="input_img"/>  
		</form> 

		<? 
		  if(notnull($query_rows)){
		?>
		<table width="99%" class="table table-hover">
		  <tbody class="mytbody">
		  <tr> 
			  <td>����</td>
			  <td>�ֻ�</td> 
			  <td>QQ</td> 
			  <td>�����ʼ�</td>
			  <td>����</td>
			  <td>ʱ��</td>
			  <td>����</td>
		  </tr> 
		  </tbody>
		  <?  
			foreach ($query_rows as $val){    	
		  ?> 
		  <form target="frm" id="f<?=$val['guestbook_id']?>" method="post" action="" > 
			<tr>
			  <td><?=$val['username']?></td>
			  <td><?=$val['tel']?></td>
			  <td><?=$val['qq']?></td>
			  <td><?=$val['email']?></td> 
			  <td><?=$val['content']?></td>
			  <td><?=$val['addtime']?></td>
			  <td>    
				<a href="do.php?cmd=guestbook_del&guestbook_id=<?=$val['guestbook_id']?>" onclick="return confirm('ȷ��ɾ����')"><img src="static/image/delete.gif"/></a> 
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
			<a href="./?cmd=<?=base64_encode('guestbook.php')?>&kw=<?=req('kw')?>&p=1">��ҳ</a>
			<a href="./?cmd=<?=base64_encode('guestbook.php')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">��һҳ</a> 
			��<?=$now_page?> / <b><?=$total_page?></b>ҳ 
			<a href="./?cmd=<?=base64_encode('guestbook.php')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">��һҳ</a>
			<a href="./?cmd=<?=base64_encode('guestbook.php')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">βҳ</a>
		</div>
		<?
		} else { 
		?> 
		<p>û�в�ѯ���ÿ����ԣ�</p>
		<?}?> 
 