<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>
  
<div class="bar_title">
	<strong>֧����¼</strong>
</div> 


<?  
if(notnull($rows)){
?> 
<table width="100%" class="table table-hover"> 
	<thead>
      <tr> 
        <td height="25"><strong>��Ʒ������</strong></td> 
		<td width="100" style="text-align:center"><strong>֧������</strong></td>
        <td><strong>֧�����ض�����</strong></td>
        <td><strong>֧�����</strong></td> 
        <td><strong>֧���ɹ�ʱ��</strong></td> 
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
	  <b>�ף�</b> û�в�ѯ������֧����¼��
</div>  
<?}?> 
