<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>   

<ul class="nav nav-tabs">   
	<li <?if(nav_active('comment_list.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('comment_list.php')?>">��Ա����</a>
	</li>   
	<li <?if(nav_active('comment_add.php')){?>class="active"<?}?> >
		<a href="?cmd=<?=base64_encode('comment_add.php')?>">��������</a>
	</li>   

	<a href="javascript:void(0)" onclick="location.reload()" class="pull-right btn btn-small">ˢ��</a>
</ul> 

<form id="myform" method="post" action="do.php?cmd=comment_add" target="_top"> 
	<table width="100%" > 
		<tr>
			<td width="90" align="right">��ƷID��</td>
			<td><textarea name="goods_ids" rows="6" cols="60" class="span6" placeholder="һ��һ��ID" required></textarea></td>
		</tr> 
		<tr>
			<td align="right">�����ԱID��</td>
			<td><textarea name="user_ids" rows="6" cols="60" class="span6" placeholder="һ��һ��ID" required></textarea></td>
		</tr> 
		<tr>
			<td align="right">���۵ȼ���</td>
			<td>
			<label class="radio inline">
				<input type="radio" name="comment_level" value="A" checked>����
			</label> 
			<label class="radio inline">
				<input type="radio" name="comment_level" value="B">����
			</label> 
			<label class="radio inline">
				<input type="radio" name="comment_level" value="C">����
			</label> 
			</td>
		</tr>
		<tr>
			<td align="right">�� �֣�</td>
			<td>
			<label class="radio inline">
				<input type="radio" name="comment_star" value="5" checked>
				5��
			</label> 
			<label class="radio inline">
				<input type="radio" name="comment_star" value="4">
				4��
			</label>
			<label class="radio inline">
				<input type="radio" name="comment_star" value="3">
				3��
			</label>
			<label class="radio inline">
				<input type="radio" name="comment_star" value="2">
				2��
			</label>
			<label class="radio inline">
				<input type="radio" name="comment_star" value="1" >
				1�� 
			</label>
			</td>
		</tr>
		<tr>
			<td align="right">�������ݣ�</td>
			<td><textarea name="content" rows="6" cols="60" class="span6" required></textarea></td>
		</tr> 
		<tr>
		  <td align="right">&nbsp;</td>
		  <td> <input type="submit" value="�ύ" class="btn btn-warning"/> </td>
		</tr> 
	</table> 
</form>  
   
  