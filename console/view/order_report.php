<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<ul class="nav nav-tabs" id="myTab"> 
  <li class="active" style="padding-left:20px"><a href="#tabs-1">�̼ҽ��㱨��</a></li> 

  <a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul>
 
		<form name="q_from" method="GET" action="" class="form-inline">  
			<input name="cmd" type="hidden" value="<?=base64_encode('order_report.php')?>"/>   
			<select name="is_settle" style="width:150px">  
				<option value=""> == ����״̬ == </option> 
				<option value="0" <?if('0'==req('is_settle')){echo 'selected';}?>>δ����</option>  
				<option value="1" <?if('1'==req('is_settle')){echo 'selected';}?>>�ѽ���</option> 
			</select> 
			<select name="report_ym" style="width:150px"> 
				<option value=""> == �����·� == </option>  
				<?   
				if(notnull($ym_rows)){
					foreach ($ym_rows as $val){  
				?>
				<option value="<?=$val['ym']?>" <?if($val['ym']==req('report_ym')){echo 'selected';}?>><?=$val['ym_text']?></option> 
				<?
					}
				}
				?> 
			</select> 

			<input type="image" src="static/image/find.gif" class="input_img"/>  

			<a href="./?cmd=<?=base64_encode('order_report_xls.php')?>&modal=true&report_ym=<?=req('report_ym')?>" class="btn btn-info pull-right" style="color:white" target="_blank">����</a>
		</form> 
		
		<?if(notnull($query_rows)){?>
		<table width="100%" class="table "> 
			<tr bgcolor="#efefef">
				<td><b>�̼�����</b></td>��
				<td><b>������</b></td>
				<td><b>�µ�����</b></td> 
				<td><b>�ͻ�</b></td> 
				<td><b>��Ʒ����</b></td>  
				<td><b>��������</b></td>
				<td><b>����</b></td>
				<td><b>���</b></td> 
				<td><b>��Ӷ</b></td>
				<td><b>������</b></td>
				<td><b>����״̬</b></td>
			</tr>   
			<?
			foreach ($query_rows as $val){
				// ���� 
				$shop = get_shop_detail_by_id($val['shop_id']); 

				// �ͻ� 
				$user = get_user_detail_by_id($val['user_id']);  
				 
				// ��Ʒ  
				$goods = unserialize($val['goods_snapshot']);
				
				// ʵ�ʳɽ����
				$total_real_price = $val['real_price']; 
			?>
			<tr> 
				<td >
					<?if($shop['shop_name']!=''){?>
						<?=$shop['shop_name']?>    
					<?}else{?>
						��Ӫ
					<?}?>
				</td>

				<td >
					 <?=$val['order_code']?>  
				</td>

				<td > 
					<b><?=date('Y-m-d', strtotime($val['addtime']))?></b>  
				</td>

				<td ><b><?=$user['account']?></b></td>

				<td >
					 <?=$goods['goods_name']?>  
				</td>
  
				<td >
					 <?=$val['departdate']?>  
				</td>

				<td >
					 <?=$val['adult_num']+$val['kid_num']?>  
				</td> 
 
				<td align="center" >
					<strong>&yen;<?=$val['real_price']?></strong>
				</td>
				<td> 
					<?if($val['is_settle']=='1'){?>
						<span style="color:red">&yen;<?=$shop['fee_rate'] * $total_real_price / 100;?></span> 
					<?}else{?>  
						&yen;<?=$val['settle_money']?>
					<?}?> 
				</td>
				<td>
					<?if($val['is_settle']=='1'){?>
						&yen;<?=$total_real_price - $val['settle_money']?>
					<?}?>
				</td>
				<td>
					<?if($val['is_settle']!='1'){?>
					<a href="do.php?cmd=order_settle&order_code=<?=$val['order_code']?>&settle_money=<?=$shop['fee_rate'] * $total_real_price / 100;?>" class="btn btn-info btn-small" style="color:white" onclick="return confirm('ȷ�Ͻ�����')">����</a>
					<?}else{?>
					�ѽ���
					<?}?>
				</td>
			  </tr>   
			 <?	  
			 } 
			 ?>
			 <tr bgcolor="#efefef"> 
				<td colspan="11" style="font-size:14px;padding:3px;text-align:center;"> 
				�ܳɽ���������<strong><?=$order_stat['cnt_order_number']?></strong>
				&nbsp;
				�ܳɽ������<strong>&yen;<?=$order_stat['sum_real_price']?></strong>
				</td>
			 </tr>
		</table>  
		<div style="text-align:right;padding-right:10px;">  
			<br/>
			����<b><?=$total_number?></b>�� &nbsp;
			<a href="./?cmd=<?=base64_encode('order_report.php')?>&state=<?=req('state')?>&kw=<?=req('kw')?>&p=1">��ҳ</a>
			<a href="./?cmd=<?=base64_encode('order_report.php')?>&state=<?=req('state')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">��һҳ</a> 
			��<?=$now_page?> / <?=$total_page?>ҳ 
			<a href="./?cmd=<?=base64_encode('order_report.php')?>&state=<?=req('state')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">��һҳ</a>
			<a href="./?cmd=<?=base64_encode('order_report.php')?>&state=<?=req('state')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">βҳ</a>
		</div>
		<?} else {?>
		<div class="alert"> 
		  <strong>û�в�ѯ����ض�����Ϣ��</strong> 
		</div>
		<?}?>
 