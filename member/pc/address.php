<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>
  

<div class="bar_title">
	<strong>�ҵĵ�ַ</strong>
</div> 

<?  
if(notnull($address_list)){
?>
<table width="100%" class="table table-hover"> 
	  <thead>
	  <tr> 
		<th>��ϵ��</th>
		<th>ʡ��</th>
		<th>����</th> 
		<th>����</th> 
		<th>��ϸ��ַ</th> 
		<th>�ʱ�</th> 
		<th>�̶��绰</th> 
		<th>�ֻ���</th> 
		<th>����</th> 
	  </tr>  
	  </thead>
<?   
	foreach ($address_list as $val){ 
?>   
	  <tr> 
		<td><?=$val['recv_name']?></td>
		<td><?=$val['recv_province']?></td>
		<td><?=$val['recv_city']?></td> 
		<td><?=$val['recv_area']?></td> 
		<td><?=$val['recv_address']?></td> 
		<td><?=$val['recv_zip']?></td> 
		<td><?=$val['recv_tel']?></td> 
		<td><?=$val['recv_mobile']?></td> 
		<td><a href="do?ac=address_del&traffic_id=<?=$val['traffic_id']?>"><img src="images/delete.gif"/></a></td> 
	  </tr>  
<?	
	} 
?> 
</table>
<?
} else {
?>
<p align="center">��ʱû�еǼ���Ϣ��</p>
<?}?> 
