<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs">   
	<li class="active" style="padding-left:20px;">
		<a href="#">�̼���פ����</a>
	</li>  
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul>  

	<script type="text/javascript">
	function change_state(join_id, v){
		if(v=='-1'){
			document.getElementById('unpass'+join_id).style.display = 'block';
		} else {
			document.getElementById('unpass'+join_id).style.display = 'none';
		}
		if(v>=0){
			location.replace('do.php?cmd=shop_join_state&join_id='+join_id+'&state='+v);
		}
	} 
	</script>

	<?if(notnull($rows)){?>
	<table width="100%" class="table table-hover">
		  <tr>   
			<td style="width:180px"><strong>��˾����</strong></td>  
			<td><strong>��ϵ��</strong></td>
			<td><strong>�ֻ���</strong></td>   
			<td><strong>�������֤���</strong></td> 
			<td><strong>���״̬</strong></td> 
			<td>�������</td>
			<td align="center"><strong>����</strong></td> 
		  </tr>
		  <?  
		  foreach ($rows as $val){   
				$v = unserialize($val['profiles']); 
		  ?> 
		  <tr>  
			<td><?=$v['company_name']?></td> 
			<td><?=$v['linker']?> <?=$v['sex']?></td>  
			<td><?=$v['mobile']?></td>   
			<td><?=$v['trip_code']?></td>   
			<td>
			
			<select name="state" class="input-small" onchange="change_state('<?=$val['join_id']?>', this.value)">
				<option value="0" <?if($val['state']=='0') echo 'selected';?>>�����</option>
				<option value="1" <?if($val['state']=='1') echo 'selected';?>>ͨ��</option>
				<option value="-1" <?if($val['state']=='-1') echo 'selected';?>>��ͨ��</option>
			</select>
			</td>
			<td>
				<div id="unpass<?=$val['join_id']?>" style="display:none">
					<form target="frm" method="post" action="do.php?cmd=shop_join_state&join_id=<?=$val['join_id']?>&state=-1"> 
						<textarea id="unpass_note" name="unpass_note" rows="3" cols="" placeholder="���벻ͨ��������..." ></textarea>
						<br/>
						<input type="submit" value="�ύ" onclick="" class="btn btn-small btn-info">
					</form>
				</div>
				<?if($val['unpass_note']!=''){?>
				<div class="alert"><?=$val['unpass_note']?></div>
				<?}?>
			</td> 
			<td>
				<a href="./?cmd=<?=base64_encode('shop_join_view.php')?>&join_id=<?=$val['join_id']?>" ><img src="static/image/view.gif"/></a> 
				&nbsp;
				<a href="do.php?cmd=shop_join_del&join_id=<?=$val['join_id']?>" onclick="return confirm('ȷ��ɾ����')" ><img src="static/image/delete.gif"/></a>  
			</td>
		  </tr> 
		  <?	 
		  }
		  ?>
	</table>  
	<?}else{?>
	<div class="alert">�Բ���û�в�ѯ�������Ϣ��</div>
	<?}?>