<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>
  

<div class="bar_title">
	<strong>我的地址</strong>
</div> 

<?  
if(notnull($address_list)){
?>
<table width="100%" class="table table-hover"> 
	  <thead>
	  <tr> 
		<th>联系人</th>
		<th>省份</th>
		<th>市区</th> 
		<th>区县</th> 
		<th>详细地址</th> 
		<th>邮编</th> 
		<th>固定电话</th> 
		<th>手机号</th> 
		<th>操作</th> 
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
<p align="center">暂时没有登记信息！</p>
<?}?> 
