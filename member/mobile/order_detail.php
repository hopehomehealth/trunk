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
    <div class="num"><span>订单详情</span><?=$g_order_state[$detail['state']]?></div>
    <i class="line"></i> 
    <a href="<?=url('order.php')?>" class="m-frm-top-btn" style="width:60px"> 返 回</a>
</section>

<section class="container"> 
  <section class="m-frm-list "> 
  <li>
	<div class="company" style="height:auto;padding-top:10px">
		<table width="100%" >  
		<?     
		// 订单状态
		$state = $detail['state']; 

		// 店铺详情
		$shop = get_shop_detail_by_id($detail['shop_id']); 
 
		// SKU
		$goods_sku = get_goods_sku_by_id($detail['sku_id']);
				 
		// 产品详情
		$goods = unserialize($detail['goods_snapshot']); 
		?>  
		<thead>
		<tr>
			<td width="70" style="text-align:right"><strong>订单号：</strong></td>
			<td><?=$detail['order_code']?></td>
		</tr>
		</thead>
		<tr>
			<td style="text-align:right"><strong>订单状态：</strong></td>
			<td>
				<span class="label label-warning"><?=$g_order_state[$state]?></span> 
			</td>
		</tr>

		<tr>
			<td style="text-align:right"><strong>下单时间：</strong></td>
			<td><?=$detail['addtime']?></td>
		</tr> 

		<tr>
			<td style="text-align:right"><strong>服务商：</strong></td>
			<td> 
				<?
				if($shop['shop_name']!=''){ 
				?> 
				<strong><?=$shop['shop_name']?></strong>
				<?}else{?>
				<strong>自营</strong>
				<?}?>
			</td>
		</tr> 

		<tr>
			<td style="text-align:right"><strong>名称/编码：</strong></td>
			<td>
				<?=$detail['goods_name']?><br/><?=$detail['goods_code']?></a> 
			</td>
		</tr>
		
		<?if($goods['goods_type']!='3'){?>
		<tr>
			<td style="text-align:right"><strong>出发日期：</strong></td>
			<td><?=$detail['departdate']?></td>
		</tr>
		<?}?>

		<tr>
			<td style="text-align:right"><strong>人 数：</strong></td>
			<td>  
				<?if($detail['adult_num']>0){?>
				<?=$detail['adult_num']?>人 
				<?}?>

				<?if($detail['kid_num']>0){?>
				<?=$detail['kid_num']?>儿童 
				<?}?> 	   
			</td>
		</tr>
 
		<tr>
			<td style="text-align:right"><strong>金 额：</strong></td>
			<td> 
				&yen;<?=$detail['real_price']?>	  
			</td>
		</tr>  

		<tr>
			<td style="text-align:right"><strong>支付方式：</strong></td>
			<td>
				<?=$g_gateway[$detail['pay_type']]?>
				<?if($detail['state']=='1'){?>
				<?if($detail['pay_type']!='default'){?>
				&nbsp;
				<a href="pay.gateway?order_code=<?=$detail['order_code']?>&price=<?=$detail['real_price']?>&user=<?=$g_userid?>&pay_type=<?=$detail['pay_type']?>" target="_blank" class="btn btn-small btn-info">立即支付</a>
				<?}?>
				<?}?>
			</td>
		</tr> 
		<tr> 
			<td style="text-align:right"><strong>联系方式：</strong></td>
			<td> 
				<?=$detail['linker']?> <?=$detail['mobile']?> <?=$detail['address']?> 
			</td>
		</tr>  
		<tr>
			<td style="text-align:right"><strong>订单留言：</strong></td>
			<td>
				<?if($detail['order_note']!=''){?>
				<?=$detail['order_note']?>
				<?}else{?>
				未填写
				<?}?>
			</td>
		</tr>
		
		<?if(in_array($state, array(1,3,4))){?>
		<tr>
			<td style="text-align:right" height="50"></td> 
			<td>  
				<?if($state=='1'){?>
				<a href="do?ac=order_close&order_code=<?=$detail['order_code']?>" onclick="return confrim('确认关闭交易吗？')" class="btn-more" target="_top">取消订单</a>
				&nbsp;
				<?}?>
				 
				<?if($state=='3'){?>
					<a href="do?ac=order_success&order_code=<?=$detail['order_code']?>" class="btn btn-info " onclick="return confrim('确认回团吗？')" target="_top">确认回团</a>
				<?}?>

				<?if($state=='4'){?>
					<?if($comment_count>0){?>
						<a href="<?=url('comment.php')?>" target="_top">查看评价</a>
					<?}else{?>
						<a href="<?=url('comment.php')?>&ac=comment&goods_id=<?=$detail['goods_id']?>&goods_name=<?=$detail['goods_name']?>" class="btn btn-warning" target="_top">立即评价</a>
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