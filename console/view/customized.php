<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs">   
	<li class="active" style="padding-left:20px;">
		<a href="#">���Ŷ���</a>
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
		<table width="100%" class="table table-hover" style="font-size:12px">
		  <tbody>
		  <tr>  
			  <td>��������</td>
			  <td>Ŀ�ľ���</td>   
			  <td>���������</td>  
			  <td>���г�����</td> 
			  <td>���������</td>
			  <td>�����Ԥ��</td>
			  <td>ס��Ҫ��</td>
			  <td>����</td>
			  <td>����Ҫ��</td>
			  <td>��ϵ��</td>
			  <td>�ֻ���</td>
			  <td width="80">����ʱ��</td>
			  <td>����</td>
		  </tr> 
		  </tbody>
		  <?  
			foreach ($query_rows as $val){ 
			    $item = unserialize(stripslashes($val['content'])); 
		  ?>  
			<tr> 
			  <td><?=$item['start_city']?></td>
			  <td><?=$item['destination']?></td>
			  <td><?=$item['begin_start_date']?>~<?=$item['last_start_date']?></td>
			  <td><?=$item['duration_min']?>~<?=$item['duration_max']?>��</td>
			  <td><?=$item['tourist_num_min']?>~<?=$item['tourist_num_max']?>��</td>
			  <td><?=$item['spend_min']?>~<?=$item['spend_max']?>Ԫ/��</td>
			  <td>
				  <?
				  if($item['house_type']==1) echo '������';
				  if($item['house_type']==2) echo '���Ǽ�';
				  if($item['house_type']==3) echo '���Ǽ�';
				  if($item['house_type']==4) echo '���Ǽ�';
				  if($item['house_type']==5) echo '���ð���';  
				  if($item['house_type']==6) echo $item['hotelname'];
				  ?> 
			  </td>
			  <td><?if($item['meeting_type']=='0'){echo '��';}?><?if($item['meeting_type']=='1'){echo '��';}?></td>
			  <td><?=$item['other_require']?></td>
			  <td><?=$item['linker']?></td>
			  <td><?=$item['mobile']?></td>  
			  <td><?=$val['addtime']?></td>
			  <td>    
				<a href="do.php?cmd=customized_del&item_id=<?=$val['item_id']?>"  onclick="return confirm('ȷ��ɾ����')"><img src="/static/image/delete.gif"/></a> 
			  </td>
			</tr> 
		  <?
		  } 
		  ?> 
		</table>
		<div style="text-align:right;padding-right:10px;">  
			<br/>
			����<b><?=$total_number?></b>�� &nbsp;
			<a href="./?cmd=<?=base64_encode('customized.php')?>&kw=<?=req('kw')?>&p=1">��ҳ</a>
			<a href="./?cmd=<?=base64_encode('customized.php')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">��һҳ</a> 
			��<?=$now_page?> / <b><?=$total_page?></b>ҳ 
			<a href="./?cmd=<?=base64_encode('customized.php')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">��һҳ</a>
			<a href="./?cmd=<?=base64_encode('customized.php')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">βҳ</a>
		</div>
		<?
		} else { 
		?> 
		<div class="alert">��δ��������ѯ����Ϣ��</div>
		<?}?> 
  