<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?> 

<div class="bar_title">
	<strong>�ҵĶ��� (<?=$total_order_number?>)</strong>
</div> 
<?
if(notnull($order_list)){
?>
<table width="100%" class="table " style="font-size:12px">  
	<thead>
	<tr> 
		<td><strong>������</strong></td>
		<td><strong>�µ�ʱ��</strong></td> 
		<td><strong>������</strong></td> 
		<td style="width:300px"><strong>��Ʒ����</strong></td>   
		<td><strong>����</strong></td> 
		<td><strong>���</strong></td> 
		<td><strong>֧����ʽ</strong></td> 
		<td><strong>״̬</strong></td> 
		<td width="50"><strong>����</strong></td>
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
		<td><a href="<?=url('order_detail.php')?>&order_code=<?=$val['order_code']?>" target="_top">����</a></td>
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
						<?=$my_traffic['recv_name']?>��<?=$my_traffic['recv_tel']?>
						<br/>
						<?=$my_traffic['recv_province']?> <?=$my_traffic['recv_city']?> <?=$my_traffic['recv_area']?>��<?=$my_traffic['recv_address']?> 
					<?}?> 
				</td> 
				<td style="color:#FF6633">
				�ܼƣ�<b>&yen;<?=number_format($total_fee, 2, '.', '');?></b>
				</td>
				<td width="120" style="text-align:center;color:#FF6633;">
					<? 
					if($state==1){   
					?>
						<div><a href="pay.gateway?order_code=<?=$val['order_code']?>&price=<?=$total_fee?>&user=<?=$g_userid?>&pay_type=<?=$val['pay_type']?>" target="_blank"  class="btn btn-small btn-warning">����֧��</a>
						</div>
						<div style="margin:5px 0 5px 0">
						<span class="label label-important"> �ȴ���Ҹ��� </span>
						</div>
						<div>
						<a href="do?ac=order_close&order_code=<?=$val['order_code']?>" onclick="return confrim('ȷ�Ϲرս�����')" class="btn btn-small">�رս���</a>
						</div>
					<?
					}
					else if($state==2){
						echo '<span class="label label-important">�ȴ�����ִ�ж���</span>';
					}
					else if($state==3){
						echo '<span class="label label-important">������ִ�ж���</span>';
					?>
					<a href="do?ac=receiving&order_code=<?=$val['order_code']?>" class="btn btn-info btn-mini" onclick="return confrim('ȷ��ִ�ж�����')">ȷ��ִ�ж���</a>
					<?
					}
					else if($state==4){
						echo "�����ѳɹ�";
					}
					else if($state==5){
						echo "�����ѹر�";
					}
					?>	
					<?
					if($state==4){
						$sql = "SELECT COUNT(*) FROM `t_goods_comment` WHERE `goods_id`='".$val['goods_id']."' AND `user_id`='$g_userid'";
						$cnt = $db->get_value($sql); 
					?>
						<br/>
						<?if($cnt>0){?>
						<a href="<?=url('comment.php')?>">�鿴����</a>
						<?}else{?>
						<a href="<?=url('comment.php')?>&ac=comment&goods_id=<?=$val['goods_id']?>&goods_name=<?=$val['goods_name']?>" class="btn btn-mini btn-warning">����</a>
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
	  <b>�ף�</b> û�в�ѯ�����Ķ�����Ϣ������ȥ <a href="javascript:window.top.location.replace('/')"><?=$g_sitename?></a> ѡ����������Ĳ�Ʒ��
	</div> 
<?
}
?> 