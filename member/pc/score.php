<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}  
?>
  
<div class="bar_title">
	<strong>�ҵĻ���</strong>

	<span class="pull-right">�ۼƻ��֣�<b><?=$total_score_number?></b></span>
</div> 
 
<?  
if(notnull($rows)){
?> 
<table width="100%" class="table table-hover"> 
	<thead>
      <tr> 
        <td height="25"><strong>������</strong></td> 
		<td><strong>������</strong></td>
        <td><strong>��������</strong></td> 
      </tr>  
	</thead>
<?
	foreach ($rows as $val){  	
?>
	  <tr> 		 
        <td><?=$val['score_note']?></td> 
		<td><span class="label label-warning"><?=$val['score_number']?></span></td> 
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
	  <b>�ף�</b> û�в�ѯ�����Ļ��ּ�¼��
</div>  
<?}?> 
