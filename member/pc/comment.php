<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?> 

<div class="bar_title">
	<strong>评价详情</strong>
	<a href="javascript:history.back()" class="pull-right btn btn-small" target="_top">返回</a>
</div> 
    
<?
if(req('ac')=='comment'){
?> 
	<form id="myform" method="post" action="do?ac=comment" target="_top"> 
	  <table width="100%" class="table table-hover">
		<tr>
			<td width="12%" align="right"></td>
			<td><?=req('goods_name')?></td>
		</tr>
		<tr>
			<td align="right"></td>
			<td><input type="radio" name="comment_level" value="A" checked>好评 <input type="radio" name="comment_level" value="B">中评 <input type="radio" name="comment_level" value="C">差评</td>
		</tr>
		<tr>
			<td align="right">评论</td>
			<td><textarea name="content" rows="6" cols="60" class="span6"></textarea></td>
		</tr> 
		<tr>
		  <td align="right">&nbsp;</td>
		  <td>
		  <input type="hidden" name="goods_id" value="<?=req('goods_id')?>">
		  <input type="submit" value="提交" class="btn btn-warning"/></td>
		</tr> 
	  </table> 
	</form>  
<?}?> 


<?  
if(notnull($comments)){
?>
<table class="table">
	<thead>
	<tr>
		<th>产品名称</th>
		<th>评价</th>
		<th>内容</th>
		<th>评价时间</th>
	</tr> 
	</thead>
	<?
	foreach ($comments as $val){   
	?> 
	<tr>
		<td><?=$val['goods_name']?></td>
		<td><?=$g_comment_level[$val['comment_level']]?></td>
		<td><?=$val['content']?></td>
		<td><?=$val['addtime']?></td>
	</tr> 
	<?
	}
	?>
</table>
<?
} 
?>