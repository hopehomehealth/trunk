<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>



<ul class="nav nav-tabs">   
	<li class="active" style="padding-left:20px;">
		<a href="#">支付记录</a>
	</li>  
	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul>  

    
		<form name="q_from" method="GET" action="" class="form-inline">  

			<input name="cmd" type="hidden" value="<?=base64_encode('order_bill.php')?>"/>

			<input name="kw" type="text" id="kw" class="span4" value="<?=req('kw')?>" placeholder="订单号、产品关键词…" required/> 
				 
			<input type="image" src="static/image/find.gif" class="input_img" title="搜索"/> 
				 
		</form> 

		<?  
		if(notnull($query_rows)){
		?> 
		<table width="100%" class="table table-hover"> 
			<thead>
			  <tr> 
			    <td height="25"><strong>用户名</strong></td> 
				<td height="25"><strong>产品订单号</strong></td> 
				<td width="100" style="text-align:center"><strong>支付网关</strong></td>
				<td><strong>支付网关订单号</strong></td>
				<td><strong>支付金额</strong></td> 
				<td><strong>支付成功时间</strong></td> 
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
			累计总额：<strong style="font-size:18px">&yen;<?=number_format($total_fee, 2, '.', '')?></strong>
			</span>
			<span class="pull-right">
			共计<b><?=$total_number?></b>条 &nbsp;
			<a href="./?cmd=<?=base64_encode('order_bill.php')?>&kw=<?=req('kw')?>&p=1">首页</a>
			<a href="./?cmd=<?=base64_encode('order_bill.php')?>&kw=<?=req('kw')?>&p=<?=$prev_number?>">上一页</a> 
			第<?=$now_page?> / <?=$total_page?>页 
			<a href="./?cmd=<?=base64_encode('order_bill.php')?>&kw=<?=req('kw')?>&p=<?=$next_number?>">下一页</a>
			<a href="./?cmd=<?=base64_encode('order_bill.php')?>&kw=<?=req('kw')?>&p=<?=$total_page?>">尾页</a>
			</span>
		</div>
		<?
		} else {
		?>
		<div class="alert">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  没有查询到相关支付记录！
		</div>  
		<?}?> 
 