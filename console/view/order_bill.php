<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>



<ul class="nav nav-tabs">   
	<li class="active" style="padding-left:20px;">
		<a href="#">֧����¼</a>
	</li>  
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul>  

    
		<form name="q_from" method="GET" action="" class="form-inline">  

			<input name="cmd" type="hidden" value="<?=base64_encode('order_bill.php')?>"/>

			<input name="kw" type="text" id="kw" class="span4" value="<?=req('kw')?>" placeholder="�����š���Ʒ�ؼ��ʡ�" required/> 
				 
			<input type="image" src="static/image/find.gif" class="input_img" title="����"/> 
				 
		</form> 

		<?  
		if(notnull($query_rows)){
		?> 
		<table width="100%" class="table table-hover"> 
			<thead>
			  <tr> 
			    <td height="25"><strong>�û���</strong></td> 
				<td height="25"><strong>��Ʒ������</strong></td> 
				<td width="100" style="text-align:center"><strong>֧������</strong></td>
				<td><strong>֧�����ض�����</strong></td>
				<td><strong>֧�����</strong></td> 
				<td><strong>֧���ɹ�ʱ��</strong></td> 
			  </tr>  
			</thead>
		<?
			foreach ($query_rows as $val){  	
		?>
			  <tr> 
			    <td><?=$val['account']?></td> 
				<td><?=$val['site_order_code']?></td> 
				<td style="text-align:center"> <?=$g_gateway[$val['gateway_name']]?></td>
				<td><?=$val['gateway_order_code']?></td>
				<td><strong>&yen;<?=number_format($val['total_fee'], 2, '.', '')?></strong></td>
				<td><?=$val['addtime']?></td> 
			  </tr> 
		<?
			}
		?>
		</table>

		<div style="padding-right:10px;">  
			<span class="pull-left">
			�ۼ��ܶ<strong style="font-size:18px">&yen;<?=number_format($total_fee, 2, '.', '')?></strong>
			</span>
			<span class="pull-right">
			����<b><?=$total_number?></b>�� &nbsp;
			<a href="./?cmd=<?=base64_encode('order_bill.php')?>&kw=<?=req('kw')?>&p=1">��ҳ</a>
			<a href="./?cmd=<?=base64_encode('order_bill.php')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">��һҳ</a> 
			��<?=$now_page?> / <?=$total_page?>ҳ 
			<a href="./?cmd=<?=base64_encode('order_bill.php')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">��һҳ</a>
			<a href="./?cmd=<?=base64_encode('order_bill.php')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">βҳ</a>
			</span>
		</div>
		<?
		} else {
		?>
		<div class="alert">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  û�в�ѯ�����֧����¼��
		</div>  
		<?}?> 
 