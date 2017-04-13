<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>

<section class="m-frm-top">
    <div class="num"><span><?=sizeof($logs)?></span>我的支付记录</div>
    <i class="line"></i> 
    <a href="./" class="m-frm-top-btn" style="width:60px"> 返 回</a>
</section>

<section class="container"> 
		
		<?  
		if(notnull($logs)){ 
		?>
		<section class="m-frm-list "> 
			<ul>
			<? 
			foreach ($logs as $val){  	
			?>
				<li>
				  <div class="company" style="height:auto">
					订单编号：
					<?=$val['site_order_code']?> 
					<br/>

					支付金额：
					<strong style="font-size:18px">&yen;<?=number_format($val['total_fee'], 2, '.', '');?></strong>
					<br/>
					
					支付网关：
					<?=$g_gateway[$val['gateway_name']]?>
					<br/>

					网关单号：
					<?=$val['gateway_order_code']?> 
				  </div> 
				  <div class="info">  
					支付时间： <?=$val['addtime']?>  
				  </div> 
				</li> 
			<?
				} 
			?>
			</ul> 
		</section>
		<?
		} else {
		?>
		<section class="m-frm-null" >
			<img src="/member/static/mobile/null.png">
			<p>嗨，这里没有找到与您的相关信息 :)</p>
		</section>
		<?}?>  
</section>
