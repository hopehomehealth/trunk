<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>


<ul class="nav nav-tabs">   
	<li <?if(nav_active('order.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('order.php')?>">��������</a>
	</li>  
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul>  

 
		<form name="q_from" method="GET" action="" class="form-inline">  
			<input name="cmd" type="hidden" value="<?=base64_encode('order.php')?>"/> 

			<input name="kw" type="text" id="kw" class="span6" value="<?=req('kw')?>" placeholder="���붩���š��̼ҡ��ֻ��š���ϵ�ˡ���Ʒ�ؼ��ʡ�"/>
			<select name="state" class="span2">
				<option value="">����״̬</option>
				<option value="1" <?if(req('state')=='1'){?>selected<?}?>>������</option>
				<option value="2" <?if(req('state')=='2'){?>selected<?}?>>�Ѹ���</option>
				<option value="3" <?if(req('state')=='3'){?>selected<?}?>>�����</option>
				<option value="4" <?if(req('state')=='4'){?>selected<?}?>>�����</option>
				<option value="5" <?if(req('state')=='5'){?>selected<?}?>>��ȡ��</option>
				<option value="9" <?if(req('state')=='9'){?>selected<?}?>>���δͨ��</option>
			</select>

			<input type="image" src="static/image/find.gif" class="input_img"/>  
		</form> 
		
		<?if(notnull($query_rows)){?>
		<table width="100%" class="table table-condensed" style="font-size:12px">  
			<tr> 
				<td><strong>������</strong></td>
				<td><strong>�µ�ʱ��</strong></td>
				<td><strong>�ͻ�</strong></td>
				<td><strong>�̼�</strong></td> 
				<td><strong>����/����</strong></td> 
				<td><strong>��������</strong></td> 
				<td><strong>����</strong></td> 
				<td><strong>���</strong></td> 
				<td><strong>֧����ʽ</strong></td> 
				<td><strong>״̬</strong></td> 
				<td width="50"><strong>����</strong></td>
			</tr>  
		<?
		foreach ($query_rows as $val){   
			// ����״̬
			$state = $val['state'];

			// ��ϵ������
			$traffic = unserialize($val['traffic_snapshot']); 

			// ��������
			$shop = get_shop_detail_by_id($val['shop_id']); 

			// �ͻ�����
			$user = get_user_detail_by_id($val['user_id']); 
					
			// SKU
			$goods_sku = get_goods_sku_by_id($val['sku_id']);
					 
			// ��Ʒ����
			$goods = unserialize($val['goods_snapshot']);

            //��Ʒ����
            $type = $val['goods_type'];

            //¿�����Ʒid
            $lv_product_id = $val['lv_product_id'];
		?> 
			
			<tr>
				<td><?=$val['order_code']?></td>

				<td><?=$val['addtime']?></td>

				<td><?=$user['account']?></td>

				<td>
					<?
					if($shop['shop_name']!=''){ 
					?> 
					<strong><?=$shop['shop_name']?></strong>
					<?}else{?>
					<strong>��Ӫ</strong>
					<?}?>
				</td> 

				<td>
                    <?if ($type == '4'){?>
                        <a href="<?=$g_self_domain?>/menpiao/ticket_detail-<?=$lv_product_id?>-<?=$val['lv_scenic_id']?>.html" target="_blank"><?=$val['goods_name']?><br/><?=$val['goods_code']?></a>
                    <?}else if($type == '1'){ ?>
                        <a href="<?=$g_self_domain?>/product/detail-<?=$val['goods_id']?>-<?=$val['lv_product_id']?>.html" target="_blank"><?=$val['goods_name']?><br/><?=$val['goods_code']?></a>
                    <?}else{?>
					<a href="preview.php?ac=goods&goods_id=<?=$val['goods_id']?>" target="_blank"><?=$val['goods_name']?><br/><?=$val['goods_code']?></a>
                    <?}?>
				</td>

				<td><?=$val['departdate']?></td>

				<td>  
					<?if($val['adult_num']>0){?>
					<?=$val['adult_num']?>�� 
					<?}?>

					<?if($val['kid_num']>0){?>
					<?=$val['kid_num']?>��ͯ 
					<?}?> 	   
				</td>

				<td> 
					&yen;<?=$val['real_price']?>	  
				</td> 

				<td>
					<?=$g_gateway[$val['pay_type']]?> 
				</td>
							 
				<td>
					<span class="label label-warning"><?=$g_order_state[$state]?></span> 
				</td>  

				<td>
					<a href="<?=url('order_detail.php')?>&order_code=<?=$val['order_code']?>" target="_top" class="btn btn-small btn-info">����</a> 

			</tr> 
			<?}?>
		</table>  

		<div style="text-align:right;padding-right:10px;">  
				<br/>
				����<b><?=$total_number?></b>�� &nbsp;
				<a href="./?cmd=<?=base64_encode('order.php')?>&state=<?=req('state')?>&kw=<?=req('kw')?>&p=1" target="_top">��ҳ</a>
				<a href="./?cmd=<?=base64_encode('order.php')?>&state=<?=req('state')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>" target="_top">��һҳ</a> 
				��<?=$now_page?> / <?=$total_page?>ҳ 
				<a href="./?cmd=<?=base64_encode('order.php')?>&state=<?=req('state')?>&kw=<?=req('kw')?>&p=<?=$next_number?>" target="_top">��һҳ</a>
				<a href="./?cmd=<?=base64_encode('order.php')?>&state=<?=req('state')?>&kw=<?=req('kw')?>&p=<?=$total_page?>" target="_top">βҳ</a>
		</div>

		<?} else {?>

		<div class="alert"> 
			<strong>û�в�ѯ����ض�����Ϣ��</strong> 
		</div>

		<?}?>
 