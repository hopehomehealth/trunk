<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>   

<ul class="nav nav-tabs">   
	<li <?if(nav_active('comment_list.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('comment_list.php')?>">会员评价</a>
	</li>   
	<li <?if(nav_active('comment_add.php')){?>class="active"<?}?> >
		<a href="?cmd=<?=base64_encode('comment_add.php')?>">发布评价</a>
	</li>   

	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">刷新</a>
</ul> 

<form id="myform" method="post" action="do.php?cmd=comment_add" target="_top"> 
	<table width="100%" > 
		<tr>
			<td width="90" align="right">产品ID：</td>
			<td><textarea name="goods_ids" rows="6" cols="60" class="span6" placeholder="一行一个ID" required></textarea></td>
		</tr> 
		<tr>
			<td align="right">随机会员ID：</td>
			<td><textarea name="user_ids" rows="6" cols="60" class="span6" placeholder="一行一个ID" required></textarea></td>
		</tr> 
		<tr>
			<td align="right">评价等级：</td>
			<td>
			<label class="radio inline">
				<input type="radio" name="comment_level" value="A" checked>好评
			</label> 
			<label class="radio inline">
				<input type="radio" name="comment_level" value="B">中评
			</label> 
			<label class="radio inline">
				<input type="radio" name="comment_level" value="C">差评
			</label> 
			</td>
		</tr>
		<tr>
			<td align="right">评 分：</td>
			<td>
			<label class="radio inline">
				<input type="radio" name="comment_star" value="5" checked>
				5分
			</label> 
			<label class="radio inline">
				<input type="radio" name="comment_star" value="4">
				4分
			</label>
			<label class="radio inline">
				<input type="radio" name="comment_star" value="3">
				3分
			</label>
			<label class="radio inline">
				<input type="radio" name="comment_star" value="2">
				2分
			</label>
			<label class="radio inline">
				<input type="radio" name="comment_star" value="1" >
				1分 
			</label>
			</td>
		</tr>
		<tr>
			<td align="right">评论内容：</td>
			<td><textarea name="content" rows="6" cols="60" class="span6" required></textarea></td>
		</tr> 
		<tr>
		  <td align="right">&nbsp;</td>
		  <td> <input type="submit" value="提交" class="btn btn-warning"/> </td>
		</tr> 
	</table> 
</form>  
   
  