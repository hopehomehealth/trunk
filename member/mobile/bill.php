<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>

<section class="m-frm-top">
    <div class="num"><span><?=sizeof($logs)?></span>�ҵ�֧����¼</div>
    <i class="line"></i> 
    <a href="./" class="m-frm-top-btn" style="width:60px"> �� ��</a>
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
					������ţ�
					<?=$val['site_order_code']?> 
					<br/>

					֧����
					<strong style="font-size:18px">&yen;<?=number_format($val['total_fee'], 2, '.', '');?></strong>
					<br/>
					
					֧�����أ�
					<?=$g_gateway[$val['gateway_name']]?>
					<br/>

					���ص��ţ�
					<?=$val['gateway_order_code']?> 
				  </div> 
				  <div class="info">  
					֧��ʱ�䣺 <?=$val['addtime']?>  
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
