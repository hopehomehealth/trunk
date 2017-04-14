<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<div class="bar_title">
	<strong>��������</strong>
	<a href="javascript:history.back()" class="pull-right btn btn-small">����</a>
</div> 


<table width="100%" class="table" >  
		<?     
		// ����״̬
		$state = $detail['state']; 

		// ��������
		$shop = get_shop_detail_by_id($detail['shop_id']); 

		// �ͻ�����
		$user = get_user_detail_by_id($detail['user_id']); 
				
		// SKU
		$goods_sku = get_goods_sku_by_id($detail['sku_id']);
				 
		// ��Ʒ����
		$goods = unserialize($detail['goods_snapshot']); 
		?>  
		<thead>
		<tr>
			<td width="100" style="text-align:right"><strong>�����ţ�</strong></td>
			<td><?=$detail['order_code']?></td>
		</tr>
		</thead>

		<tr>
			<td style="text-align:right"><strong>�µ�ʱ�䣺</strong></td>
			<td><?=$detail['addtime']?></td>
		</tr>

		<tr> 
			<td style="text-align:right"><strong>�� ����</strong></td>
			<td><?=$user['account']?></td>
		</tr>

		<tr>
			<td style="text-align:right"><strong>�� �ң�</strong></td>
			<td> 
				<?
				if($shop['shop_name']!=''){ 
				?> 
				<strong><?=$shop['shop_name']?></strong>
				<?}else{?>
				<strong>��Ӫ</strong>
				<?}?>
			</td>
		</tr> 

		<tr>
			<td style="text-align:right"><strong>����/���룺</strong></td>
			<td>
				<a href="preview.php?ac=goods&goods_id=<?=$detail['goods_id']?>" target="_blank"><?=$detail['goods_name']?><br/><?=$detail['goods_code']?></a> 
			</td>
		</tr>

		<tr>
			<td style="text-align:right"><strong>�������ڣ�</strong></td>
			<td><?=$detail['departdate']?></td>
		</tr>

		<tr>
			<td style="text-align:right"><strong>�� ����</strong></td>
			<td>  
				<?if($detail['adult_num']>0){?>
				<?=$detail['adult_num']?>�� 
				<?}?>

				<?if($detail['kid_num']>0){?>
				<?=$detail['kid_num']?>��ͯ 
				<?}?> 	   
			</td>
		</tr>
 
		<tr>
			<td style="text-align:right"><strong>�� �</strong></td>
			<td> 
				<strong style="font-size:18px;color:red;">&yen;<?=$detail['real_price']?></strong>	  

				<?if($detail['state']<2){?>
				<form target="frm" id="subtract<?=$detail['order_id']?>" method="post" action="do.php?cmd=order_subtract_price&order_code=<?=$detail['order_code']?>" class="form-inline" style="float:right;margin:0px;">
					<div class="input-prepend input-append">
					  <span class="add-on">��</span>
					  <input class="input-small" type="number" name="subtract_price" value="<?=$detail['subtract_price']?>" title="���������������Ӽ����븺��">
					  <span class="add-on">Ԫ</span>
					</div> 
					<input type="submit" value="�ļ�" class="btn btn-danger" onclick="return confirm('ȷ�ϸļ���')"> 
				</form> 
				<?}else{?>
					<?if($detail['subtract_price']>0){?>
					<span class="label label-info">
						�� <b><?=$detail['subtract_price']?></b> Ԫ
					</span>
					<?}?>
					<?if($detail['subtract_price']<0){?>
					<span class="label label-info">
						�� <b><?=-$detail['subtract_price']?></b> Ԫ
					</span>
					<?}?>
				<?}?>
			</td>
		</tr> 

		<tr>
			<td style="text-align:right"><strong>֧����ʽ��</strong></td>
			<td>
				<?=$g_gateway[$detail['pay_type']]?>
			</td>
		</tr>
		
		<tr>
			<td style="text-align:right"><strong>״ ̬��</strong></td>
			<td>
				<span class="label label-warning"><?=$g_order_state[$state]?></span> 
			</td>
		</tr> 
		
		<?
		if(in_array($state, array(1,2))){ 
		?> 
		<tr>
			<td style="text-align:right"></td> 
			<td>
				<?
				if($state==1){ 
				?>  
				<form target="frm" method="post" action="do.php?cmd=order_payed&order_code=<?=$detail['order_code']?>"> 
					<input type="submit" value="ȷ���տ�" class="btn btn-info" onclick="return confirm('ȷ���տ���')">  
				</form>  
				<?
				}  
				?>		

				<?
				if($state==2){ 
				?>  
				<form target="frm" method="post" action="do.php?cmd=order_confirm&order_code=<?=$detail['order_code']?>"> 
					<input type="submit" value="����ȷ��" class="btn btn-info" onclick="return confirm('ȷ��ȷ����')">  
				</form>  
				<?
				}  
				?>	
			</td>  
		</tr>
		<?}?>
				 
		<tr> 
			<td style="text-align:right"><strong>��ϵ��Ϣ��</strong></td>
			<td> 
				<?=$detail['linker']?>
				<?=$detail['mobile']?>
				<?=$detail['address']?>   
			</td>
		</tr>  
		<tr>
			<td style="text-align:right"><strong>�������ԣ�</strong></td>
			<td>
				<?if($detail['order_note']!=''){?>
				<?=$detail['order_note']?>
				<?}else{?>
				δ��д
				<?}?>
			</td>
		</tr>
		<tr>
			<td style="text-align:right"><strong>����������</strong></td>
			<td>   
				<?if(notnull($tourist)){?>	 
				<table class="table table-hover table-bordered"> 
					  <thead>
					  <tr>  
						<td width="120"><strong>�ο�����</strong></td> 
						<td width="120"><strong>�ο����֤</strong></td> 
						<td width="80"><strong>�ο�����</strong></td>  
					  </tr> 
					  </thead>
					  <?   
					  foreach ($tourist as $val){    	
					  ?>
					  <form target="frm" id="f<?=$val['tourist_id']?>" method="post" action="" >
					  <tr>  
						<td> 
						<?=$val['user_name']?>
						</td> 

						<td> 
						<?=$val['user_idcard']?>
						</td> 

						<td> 
						<?=$val['user_age']?>��
						</td>  
					  </tr>
					  </form>
					  <?	 
					  }  
					  ?>
				</table>  
				<?} else {?>
				<div >��δ��д�ο���Ϣ</div>
				<?}?>
			</td>
		</tr>
</table>   