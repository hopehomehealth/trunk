<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>
  
<div class="bar_title">
	<strong>支付记录</strong>
</div> 


<?  
if(notnull($rows)){
?> 
<table width="100%" class="table table-hover"> 
	<thead>
      <tr> 
        <td height="25"><strong>产品订单号</strong></td> 
		<td width="100" style="text-align:center"><strong>支付网关</strong></td>
        <td><strong>支付网关订单号</strong></td>
        <td><strong>支付金额</strong></td> 
        <td><strong>支付成功时间</strong></td> 
      </tr>  
	</thead>
<?
	foreach ($rows as $val){  	
?>
	  <tr> 
        <td><?=$val['site_order_code']?></td> 
		<td style="text-align:center"> <?=$g_gateway[$val['gateway_name']]?> </td>
        <td><?=$val['gateway_order_code']?></td>
        <td>&yen;<?=number_format($val['total_fee'], 2, '.', '');?></td>
		<td><?=$val['addtime']?></td> 
      </tr> 
<?
	}
?>
</table>
<?
} else {
?>
<div class="alert"> 
	  <b>亲！</b> 没有查询到您的支付记录！
</div>  
<?}?> 
