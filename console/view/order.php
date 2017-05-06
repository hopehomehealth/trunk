<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>


<ul class="nav nav-tabs">   
	<li <?if(nav_active('order.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('order.php')?>">订单管理</a>
	</li>  
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul>  

 
		<form name="q_from" method="GET" action="" class="form-inline">  
			<input name="cmd" type="hidden" value="<?=base64_encode('order.php')?>"/> 

			<input name="kw" type="text" id="kw" class="span6" value="<?=req('kw')?>" placeholder="输入订单号、商家、手机号、联系人、产品关键词…"/>
			<select name="state" class="span2">
				<option value="">订单状态</option>
				<option value="1" <?if(req('state')=='1'){?>selected<?}?>>待付款</option>
				<option value="2" <?if(req('state')=='2'){?>selected<?}?>>已付款</option>
				<option value="3" <?if(req('state')=='3'){?>selected<?}?>>待完成</option>
				<option value="4" <?if(req('state')=='4'){?>selected<?}?>>已完成</option>
				<option value="5" <?if(req('state')=='5'){?>selected<?}?>>已取消</option>
				<option value="9" <?if(req('state')=='9'){?>selected<?}?>>审核未通过</option>
			</select>

			<input type="image" src="static/image/find.gif" class="input_img"/>  
		</form> 
		
		<?if(notnull($query_rows)){?>
		<table width="100%" class="table table-condensed" style="font-size:12px">  
			<tr> 
				<td><strong>订单号</strong></td>
				<td><strong>下单时间</strong></td>
				<td><strong>客户</strong></td>
				<td><strong>商家</strong></td> 
				<td><strong>名称/编码</strong></td> 
				<td><strong>出发日期</strong></td> 
				<td><strong>人数</strong></td> 
				<td><strong>金额</strong></td> 
				<td><strong>支付方式</strong></td> 
				<td><strong>状态</strong></td> 
				<td width="50"><strong>详情</strong></td>
			</tr>  
		<?
		foreach ($query_rows as $val){   
			// 订单状态
			$state = $val['state'];

			// 联系人详情
			$traffic = unserialize($val['traffic_snapshot']); 

			// 店铺详情
			$shop = get_shop_detail_by_id($val['shop_id']); 

			// 客户详情
			$user = get_user_detail_by_id($val['user_id']); 
					
			// SKU
			$goods_sku = get_goods_sku_by_id($val['sku_id']);
					 
			// 产品详情
			$goods = unserialize($val['goods_snapshot']);

            //产品类型
            $type = $val['goods_type'];

            //驴妈妈产品id
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
					<strong>自营</strong>
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
					<?=$val['adult_num']?>人 
					<?}?>

					<?if($val['kid_num']>0){?>
					<?=$val['kid_num']?>儿童 
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
					<a href="<?=url('order_detail.php')?>&order_code=<?=$val['order_code']?>" target="_top" class="btn btn-small btn-info">详情</a> 

			</tr> 
			<?}?>
		</table>  

		<div style="text-align:right;padding-right:10px;">  
				<br/>
				共计<b><?=$total_number?></b>条 &nbsp;
				<a href="./?cmd=<?=base64_encode('order.php')?>&state=<?=req('state')?>&kw=<?=req('kw')?>&p=1" target="_top">首页</a>
				<a href="./?cmd=<?=base64_encode('order.php')?>&state=<?=req('state')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>" target="_top">上一页</a> 
				第<?=$now_page?> / <?=$total_page?>页 
				<a href="./?cmd=<?=base64_encode('order.php')?>&state=<?=req('state')?>&kw=<?=req('kw')?>&p=<?=$next_number?>" target="_top">下一页</a>
				<a href="./?cmd=<?=base64_encode('order.php')?>&state=<?=req('state')?>&kw=<?=req('kw')?>&p=<?=$total_page?>" target="_top">尾页</a>
		</div>

		<?} else {?>

		<div class="alert"> 
			<strong>没有查询到相关订单信息！</strong> 
		</div>

		<?}?>
 