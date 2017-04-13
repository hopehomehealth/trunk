<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>

<section class="container">
	<section class="user-head">
		<div class="user-tab">
			<ul>
				<li <?if(req('state')==''){?>class="on"<?}?> data-type="0"><a href="<?=url('order.php')?>"><span><?=$total_order_number?></span><br>
						全部</a></li>
				<li <?if(req('state')=='1'){?>class="on"<?}?> data-type="1"><a href="<?=url('order.php')?>&state=1"><span><?=get_order_count(1)?></span><br>
						待支付</a></li>
				<li <?if(req('state')=='2'){?>class="on"<?}?> data-type="2"><a href="<?=url('order.php')?>&state=2"><span><?=get_order_count(2)?></span><br>
						待确认</a></li>
				<li <?if(req('state')=='3'){?>class="on"<?}?> data-type="4"><a href="<?=url('order.php')?>&state=3"><span><?=get_order_count(3)?></span><br>
						待回团</a></li>
				<li <?if(req('state')=='4'){?>class="on"<?}?> data-type="5"><a href="<?=url('order.php')?>&state=4"><span><?=get_order_count(4)?></span><br>
						已完成</a></li>
			</ul>
		</div>
	</section>

	<?if(notnull($order_list)){?>
	<section class="m-frm-list">
		<ul>
			<?   
			foreach ($order_list as $val){   
				$goods		= unserialize($val['goods_snapshot']);  
				$state		= $val['state'];
				$total_fee  = $val['real_price'];
			?> 
			<li>
				<div class="company"> 
					<i><?=$g_order_state[$state]?></i>    
					<span>订单编号: <?=$val['order_code']?></span> 
				</div>
				<div class="item">
						<div class="title"><a href="/product/detail-<?=$val['goods_id']?>.html"><?=$val['goods_name']?></a></div>
						<div class="price" style="font-size:12px">
						  <?=$val['adult_num']+$val['kid_num']?>人  
						</div>
						<div class="hotel">  
						  <span class="refund-status">&yen;<?=$val['real_price']?> </span> 
						</div>
				</div> 
				<div class="info"> 
					<a href="<?=url('order_detail.php')?>&order_code=<?=$val['order_code']?>" class="btn btn-info btn-small" >详情</a> 
					<?
					if($state==4){ 
						$comment_count = get_comment_count($val['goods_id']);
					?> 
						<?if($comment_count>0){?>
						<a href="<?=url('comment.php')?>&order_code=<?=$val['order_code']?>">我的评价</a>
						<?}else{?>
						<a href="<?=url('comment.php')?>&ac=comment&goods_id=<?=$val['goods_id']?>&goods_name=<?=$val['goods_name']?>" class="btn btn-small btn-warning">评价</a>
						<?}?>
					<?}?>
					<a href="<?=url('order_tourist.php')?>&order_code=<?=$val['order_code']?>">报名名单</a>
				</div> 
			</li> 
			<?	
			} 
			?> 
		</ul>
	</section>

	<?} else {?> 
	<div class="alert"> 
	  <p><br/>没有查询到相关订单信息~~</p>
	</div>  
	<?}?>

</section>