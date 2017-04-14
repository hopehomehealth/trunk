<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>

<div class="bar_title">
	<strong>订单详情</strong>
	<a href="javascript:history.back()" class="pull-right btn btn-small">返回</a>
</div> 


<table width="100%" class="table" >  
		<?     
		// 订单状态
		$state = $detail['state']; 

		// 店铺详情
		$shop = get_shop_detail_by_id($detail['shop_id']); 

		// 客户详情
		$user = get_user_detail_by_id($detail['user_id']); 
				
		// SKU
		$goods_sku = get_goods_sku_by_id($detail['sku_id']);
				 
		// 产品详情
		$goods = unserialize($detail['goods_snapshot']); 
		?>  
		<thead>
		<tr>
			<td width="100" style="text-align:right"><strong>订单号：</strong></td>
			<td><?=$detail['order_code']?></td>
		</tr>
		</thead>

		<tr>
			<td style="text-align:right"><strong>下单时间：</strong></td>
			<td><?=$detail['addtime']?></td>
		</tr>

		<tr> 
			<td style="text-align:right"><strong>客 户：</strong></td>
			<td><?=$user['account']?></td>
		</tr>

		<tr>
			<td style="text-align:right"><strong>商 家：</strong></td>
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
				<a href="preview.php?ac=goods&goods_id=<?=$detail['goods_id']?>" target="_blank"><?=$detail['goods_name']?><br/><?=$detail['goods_code']?></a> 
			</td>
		</tr>

		<tr>
			<td style="text-align:right"><strong>出发日期：</strong></td>
			<td><?=$detail['departdate']?></td>
		</tr>

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
				<strong style="font-size:18px;color:red;">&yen;<?=$detail['real_price']?></strong>	  

				<?if($detail['state']<2){?>
				<form target="frm" id="subtract<?=$detail['order_id']?>" method="post" action="do.php?cmd=order_subtract_price&order_code=<?=$detail['order_code']?>" class="form-inline" style="float:right;margin:0px;">
					<div class="input-prepend input-append">
					  <span class="add-on">减</span>
					  <input class="input-small" type="number" name="subtract_price" value="<?=$detail['subtract_price']?>" title="减价输入正数，加价输入负数">
					  <span class="add-on">元</span>
					</div> 
					<input type="submit" value="改价" class="btn btn-danger" onclick="return confirm('确认改价吗？')"> 
				</form> 
				<?}else{?>
					<?if($detail['subtract_price']>0){?>
					<span class="label label-info">
						减 <b><?=$detail['subtract_price']?></b> 元
					</span>
					<?}?>
					<?if($detail['subtract_price']<0){?>
					<span class="label label-info">
						加 <b><?=-$detail['subtract_price']?></b> 元
					</span>
					<?}?>
				<?}?>
			</td>
		</tr> 

		<tr>
			<td style="text-align:right"><strong>支付方式：</strong></td>
			<td>
				<?=$g_gateway[$detail['pay_type']]?>
			</td>
		</tr>
		
		<tr>
			<td style="text-align:right"><strong>状 态：</strong></td>
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
					<input type="submit" value="确认收款" class="btn btn-info" onclick="return confirm('确认收款吗？')">  
				</form>  
				<?
				}  
				?>		

				<?
				if($state==2){ 
				?>  
				<form target="frm" method="post" action="do.php?cmd=order_confirm&order_code=<?=$detail['order_code']?>"> 
					<input type="submit" value="订单确认" class="btn btn-info" onclick="return confirm('确认确认吗？')">  
				</form>  
				<?
				}  
				?>	
			</td>  
		</tr>
		<?}?>
				 
		<tr> 
			<td style="text-align:right"><strong>联系信息：</strong></td>
			<td> 
				<?=$detail['linker']?>
				<?=$detail['mobile']?>
				<?=$detail['address']?>   
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
		<tr>
			<td style="text-align:right"><strong>出游名单：</strong></td>
			<td>   
				<?if(notnull($tourist)){?>	 
				<table class="table table-hover table-bordered"> 
					  <thead>
					  <tr>  
						<td width="120"><strong>游客姓名</strong></td> 
						<td width="120"><strong>游客身份证</strong></td> 
						<td width="80"><strong>游客年龄</strong></td>  
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
						<?=$val['user_age']?>岁
						</td>  
					  </tr>
					  </form>
					  <?	 
					  }  
					  ?>
				</table>  
				<?} else {?>
				<div >尚未填写游客信息</div>
				<?}?>
			</td>
		</tr>
</table>   