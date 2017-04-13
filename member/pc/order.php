<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?> 

<div class="bar_title">
	<strong>我的订单 (<?=$total_order_number?>)</strong>
</div> 
<?
if(notnull($order_list)){
?>
<table width="100%" class="table " style="font-size:12px">  
	<thead>
	<tr> 
		<td><strong>订单号</strong></td>
		<td><strong>下单时间</strong></td> 
		<td><strong>服务商</strong></td> 
		<td style="width:300px"><strong>产品名称</strong></td>   
		<td><strong>人数</strong></td> 
		<td><strong>金额</strong></td> 
		<td><strong>支付方式</strong></td> 
		<td><strong>状态</strong></td> 
		<td width="50"><strong>详情</strong></td>
	</tr>
	</thead>
	<?   
	foreach ($order_list as $val){   
		$total_fee   = $val['pay_price']-$val['subtract_price']; 
		$goods		 = unserialize($val['goods_snapshot']);  
		$tourist_cnt = get_tourist_count($val['order_code']);
		$my_traffic  = get_traffic_detail_by_id($val['traffic_id']);
		$state		 = $val['state'];
	?>  
	  <tr> 
		<td><?=$val['order_code']?></td>
		<td><?=$val['addtime']?></td> 
		<td><?=$val['shop_name']?></td>  
		<td><a href="/product/detail-<?=$val['goods_id']?>.html" target="_blank"> <?=$val['goods_name']?></a></td> 
		<td style="text-align:center"><?=$val['adult_num']+$val['kid_num']?></td>
		<td>&yen;<?=$val['real_price']?></td>
		<td><?=$g_gateway[$val['pay_type']]?></td>
		<td><span class="label label-warning"><?=$g_order_state[$val['state']]?></span></td>	
		<td><a href="<?=url('order_detail.php')?>&order_code=<?=$val['order_code']?>" target="_top">详情</a></td>
	  </tr> 
	  <!--
	  <tr> 
	    <td>
	    <table width="100%">
			<tr>
				<td width="500"> 
					<?  
					if($my_traffic['traffic_id']!=''){
					?>
						<?=$my_traffic['recv_name']?>，<?=$my_traffic['recv_tel']?>
						<br/>
						<?=$my_traffic['recv_province']?> <?=$my_traffic['recv_city']?> <?=$my_traffic['recv_area']?>，<?=$my_traffic['recv_address']?> 
					<?}?> 
				</td> 
				<td style="color:#FF6633">
				总计：<b>&yen;<?=number_format($total_fee, 2, '.', '');?></b>
				</td>
				<td width="120" style="text-align:center;color:#FF6633;">
					<? 
					if($state==1){   
					?>
						<div><a href="pay.gateway?order_code=<?=$val['order_code']?>&price=<?=$total_fee?>&user=<?=$g_userid?>&pay_type=<?=$val['pay_type']?>" target="_blank"  class="btn btn-small btn-warning">在线支付</a>
						</div>
						<div style="margin:5px 0 5px 0">
						<span class="label label-important"> 等待买家付款 </span>
						</div>
						<div>
						<a href="do?ac=order_close&order_code=<?=$val['order_code']?>" onclick="return confrim('确认关闭交易吗？')" class="btn btn-small">关闭交易</a>
						</div>
					<?
					}
					else if($state==2){
						echo '<span class="label label-important">等待卖家执行订单</span>';
					}
					else if($state==3){
						echo '<span class="label label-important">卖家已执行订单</span>';
					?>
					<a href="do?ac=receiving&order_code=<?=$val['order_code']?>" class="btn btn-info btn-mini" onclick="return confrim('确认执行订单吗？')">确认执行订单</a>
					<?
					}
					else if($state==4){
						echo "交易已成功";
					}
					else if($state==5){
						echo "交易已关闭";
					}
					?>	
					<?
					if($state==4){
						$sql = "SELECT COUNT(*) FROM `t_goods_comment` WHERE `goods_id`='".$val['goods_id']."' AND `user_id`='$g_userid'";
						$cnt = $db->get_value($sql); 
					?>
						<br/>
						<?if($cnt>0){?>
						<a href="<?=url('comment.php')?>">查看评价</a>
						<?}else{?>
						<a href="<?=url('comment.php')?>&ac=comment&goods_id=<?=$val['goods_id']?>&goods_name=<?=$val['goods_name']?>" class="btn btn-mini btn-warning">评价</a>
						<?}?>
					<?}?>
				</td> 
			</tr>
		</table>
		</td>
	  </tr> 
	  -->
<?	
	} 
?>
</table>
<?} else {
?>
	<div class="alert" style="margin-top:20px"> 
	  <b>亲！</b> 没有查询到您的订单信息，马上去 <a href="javascript:window.top.location.replace('/')"><?=$g_sitename?></a> 选购您所需求的产品！
	</div> 
<?
}
?> 