<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>

<section class="m-frm-top">
    <div class="num"><span><?=sizeof($address_list)?></span>我的常用地址</div>
    <i class="line"></i> 
    <a href="./" class="m-frm-top-btn" style="width:60px"> 返 回</a>
</section>

<section class="container"> 
		<?  
		if(notnull($address_list)){ 
		?>
		<section class="m-frm-list "> 
			<ul>
			<? 
			foreach ($address_list as $val){  	
			?>
				<li>
				  <div class="company">
						<?if($val['recv_name']!=''){?>
							联系人： <?=$val['recv_name']?>，
						<?}?>  
						
						<?if($val['recv_address']!=''){?>
							详细地址： <?=$val['recv_province']?> <?=$val['recv_city']?> <?=$val['recv_area']?> <?=$val['recv_address']?>，
						<?}?>

						<?if($val['recv_zip']!=''){?>
							邮编： <?=$val['recv_zip']?>，
						<?}?>

						
						<?if($val['recv_tel']!=''){?>
							电话： <?=$val['recv_tel']?>
						<?}?> 
					</div> 
					<div class="info"> 
						<?if($val['recv_mobile']!=''){?>
							手机号： <?=$val['recv_mobile']?> 
						<?}?>
						<a href="do?ac=address_del&traffic_id=<?=$val['traffic_id']?>" class="btn btn-warning btn-mini" style="font-size:12px">删除</a> 
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
