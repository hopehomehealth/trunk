<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>

<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<section class="m-frm-top">
    <div class="num"><span>��������</span><?=$g_order_state[$detail['state']]?></div>
    <i class="line"></i> 
    <a href="<?=url('order.php')?>" class="m-frm-top-btn" style="width:60px"> �� ��</a>
</section>

<section class="container"> 
  <section class="m-frm-list "> 
  <li>
	<div class="company" style="height:auto;padding-top:10px">
		<table width="100%" >  
		<?     
		// ����״̬
		$state = $detail['state']; 

		// ��������
		$shop = get_shop_detail_by_id($detail['shop_id']); 
 
		// SKU
		$goods_sku = get_goods_sku_by_id($detail['sku_id']);
				 
		// ��Ʒ����
		$goods = unserialize($detail['goods_snapshot']); 
		?>  
		<thead>
		<tr>
			<td width="70" style="text-align:right"><strong>�����ţ�</strong></td>
			<td><?=$detail['order_code']?></td>
		</tr>
		</thead>
		<tr>
			<td style="text-align:right"><strong>����״̬��</strong></td>
			<td>
				<span class="label label-warning"><?=$g_order_state[$state]?></span> 
			</td>
		</tr>

		<tr>
			<td style="text-align:right"><strong>�µ�ʱ�䣺</strong></td>
			<td><?=$detail['addtime']?></td>
		</tr> 

		<tr>
			<td style="text-align:right"><strong>�����̣�</strong></td>
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
				<?=$detail['goods_name']?><br/><?=$detail['goods_code']?></a> 
			</td>
		</tr>
		
		<?if($goods['goods_type']!='3'){?>
		<tr>
			<td style="text-align:right"><strong>�������ڣ�</strong></td>
			<td><?=$detail['departdate']?></td>
		</tr>
		<?}?>

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
				&yen;<?=$detail['real_price']?>	  
			</td>
		</tr>  

		<tr>
			<td style="text-align:right"><strong>֧����ʽ��</strong></td>
			<td>
				<?=$g_gateway[$detail['pay_type']]?>
				<?if($detail['state']=='1'){?>
				<?if($detail['pay_type']!='default'){?>
				&nbsp;
				<a href="pay.gateway?order_code=<?=$detail['order_code']?>&price=<?=$detail['real_price']?>&user=<?=$g_userid?>&pay_type=<?=$detail['pay_type']?>" target="_blank" class="btn btn-small btn-info">����֧��</a>
				<?}?>
				<?}?>
			</td>
		</tr> 
		<tr> 
			<td style="text-align:right"><strong>��ϵ��ʽ��</strong></td>
			<td> 
				<?=$detail['linker']?> <?=$detail['mobile']?> <?=$detail['address']?> 
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
		
		<?if(in_array($state, array(1,3,4))){?>
		<tr>
			<td style="text-align:right" height="50"></td> 
			<td>  
				<?if($state=='1'){?>
				<a href="do?ac=order_close&order_code=<?=$detail['order_code']?>" onclick="return confrim('ȷ�Ϲرս�����')" class="btn-more" target="_top">ȡ������</a>
				&nbsp;
				<?}?>
				 
				<?if($state=='3'){?>
					<a href="do?ac=order_success&order_code=<?=$detail['order_code']?>" class="btn btn-info " onclick="return confrim('ȷ�ϻ�����')" target="_top">ȷ�ϻ���</a>
				<?}?>

				<?if($state=='4'){?>
					<?if($comment_count>0){?>
						<a href="<?=url('comment.php')?>" target="_top">�鿴����</a>
					<?}else{?>
						<a href="<?=url('comment.php')?>&ac=comment&goods_id=<?=$detail['goods_id']?>&goods_name=<?=$detail['goods_name']?>" class="btn btn-warning" target="_top">��������</a>
					<?}?>
					&nbsp;
				<?}?>	
			</td>  
		</tr>  
		<?}?>
 
			</td>
		</tr>
		</table>
	  </div>
	</li> 
  </section>
</section>