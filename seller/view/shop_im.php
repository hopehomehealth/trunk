<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>
 
<div class="bar_title">
	<strong>�ͷ�����</strong> 
</div> 

 
		<form target="frm" method="post" action="do.php?cmd=shop_im" enctype="multipart/form-data" >
			<table width="100%">  
			  <tr>
				<td width="100" align="right">����QQ�б�</td>
				<td><textarea name="im_qq" rows="5" cols="20" class="span6" placeholder="һ��һ��QQ��"><?=$g_shop['im_qq']?></textarea></td>
			  </tr>
			  <tr>
				<td align="right">���������б�</td>
				<td><textarea name="im_ww" rows="5" cols="20" class="span6" placeholder="һ��һ��������"><?=$g_shop['im_ww']?></textarea></td>
			  </tr>
			  <tr>
				<td></td>
				<td><input type="submit" value="ȷ��" class="btn btn-danger" /></td>
			  </tr>   
			</table>
		</form>
 