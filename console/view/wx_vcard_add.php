<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>
 
<ul class="nav nav-tabs" id="myTab"> 
   
	<li <?if(nav_active('wx_vcard.php')){?>class="active"<?}?> style="padding-left:20px;">
		<a href="?cmd=<?=base64_encode('wx_vcard.php')?>">���ι���</a>
	</li> 

	<li <?if(nav_active('wx_vcard_add.php')){?>class="active"<?}?>>
		<a href="?cmd=<?=base64_encode('wx_vcard_add.php')?>">��������</a>
	</li>    
</ul>
  
  
		<form target="frm" method="post" action="do.php?cmd=vcard_add" enctype="multipart/form-data"> 
			<table width="100%"> 
				<tr>
					<td width="80" align="right"><font color="red">*</font> �� ����</td>
					<td><input name="username" type="text" id="username" size="10" required/></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> ͷ ��</td>
					<td> 
					<input name="avatar" type="file" size="10" required/> ���100���� / �߶�100����
					</td>
				</tr>  
				<tr>
					<td align="right">�����ʼ���</td>
					<td><input name="email" type="email" size="25" /></td>
				</tr>
				<tr>
					<td align="right">QQ�ţ�</td>
					<td><input name="qq" type="number" size="25" /></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> �ֻ��ţ�</td>
					<td><input name="mobile" type="number" size="11" required/></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> �ŵ꣺</td>
					<td><input name="store" type="text" required/></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> ��ַ��</td>
					<td><input name="address" type="text" required/></td>
				</tr>
				<tr>
					<td align="right"><font color="red">*</font> ��飺</td>
					<td><textarea name="note" rows="3" class="span6" required></textarea></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="ȷ��" class="btn btn-danger" /> </td>
				</tr>
			</table> 
		</form>  