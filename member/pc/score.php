<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}  
?>
  
<div class="bar_title">
	<strong>我的积分</strong>

	<span class="pull-right">累计积分：<b><?=$total_score_number?></b></span>
</div> 
 
<?  
if(notnull($rows)){
?> 
<table width="100%" class="table table-hover"> 
	<thead>
      <tr> 
        <td height="25"><strong>积分项</strong></td> 
		<td><strong>积分数</strong></td>
        <td><strong>发生日期</strong></td> 
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
	  <b>亲！</b> 没有查询到您的积分记录！
</div>  
<?}?> 
