<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?> 

<div class="bar_title">
	<strong>��������</strong>
	<a href="javascript:history.back()" class="pull-right btn btn-small" target="_top">����</a>
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
			<td><input type="radio" name="comment_level" value="A" checked>���� <input type="radio" name="comment_level" value="B">���� <input type="radio" name="comment_level" value="C">����</td>
		</tr>
		<tr>
			<td align="right">����</td>
			<td><textarea name="content" rows="6" cols="60" class="span6"></textarea></td>
		</tr> 
		<tr>
		  <td align="right">&nbsp;</td>
		  <td>
		  <input type="hidden" name="goods_id" value="<?=req('goods_id')?>">
		  <input type="submit" value="�ύ" class="btn btn-warning"/></td>
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
		<th>��Ʒ����</th>
		<th>����</th>
		<th>����</th>
		<th>����ʱ��</th>
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