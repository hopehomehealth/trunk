<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>

<section class="m-frm-top">
    <div class="num"><span><?=sizeof($address_list)?></span>�ҵĳ��õ�ַ</div>
    <i class="line"></i> 
    <a href="./" class="m-frm-top-btn" style="width:60px"> �� ��</a>
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
							��ϵ�ˣ� <?=$val['recv_name']?>��
						<?}?>  
						
						<?if($val['recv_address']!=''){?>
							��ϸ��ַ�� <?=$val['recv_province']?> <?=$val['recv_city']?> <?=$val['recv_area']?> <?=$val['recv_address']?>��
						<?}?>

						<?if($val['recv_zip']!=''){?>
							�ʱࣺ <?=$val['recv_zip']?>��
						<?}?>

						
						<?if($val['recv_tel']!=''){?>
							�绰�� <?=$val['recv_tel']?>
						<?}?> 
					</div> 
					<div class="info"> 
						<?if($val['recv_mobile']!=''){?>
							�ֻ��ţ� <?=$val['recv_mobile']?> 
						<?}?>
						<a href="do?ac=address_del&traffic_id=<?=$val['traffic_id']?>" class="btn btn-warning btn-mini" style="font-size:12px">ɾ��</a> 
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
			<p>�ˣ�����û���ҵ������������Ϣ :)</p>
		</section>
		<?}?>  
</section>
