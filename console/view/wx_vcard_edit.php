<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

$profiles = unserialize($detail['profiles']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="static/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="static/image/style.css" rel="stylesheet" type="text/css" />
 
</head>

<body style="padding:30px">
<form target="frm" method="post" action="do.php?cmd=vcard_edit" enctype="multipart/form-data"> 
<input type="hidden" name="vcard_id" value="<?=$detail['vcard_id']?>">
<table> 
	<tr>
		<td align="right" width="100"><font color="red">*</font> �� ����</td>
		<td><input name="username" type="text" id="username" size="10" value="<?=$profiles['username']?>" required/></td>
	</tr>
	<tr>
		<td align="right"><font color="red">*</font> ͷ ��</td>
		<td>
		<?
		if($detail['avatar']!=''){
			$avatar = "/upfiles/$g_siteid/".$detail['avatar'];
		?>
		<img src="<?=$avatar?>" style="width:80px;height:80px" class="img-circle"><br/><br/>
		<?}?>
		<input name="avatar" type="file" size="10" />
		
		���100���� / �߶�100����
		</td>
	</tr>  
	<tr>
		<td align="right">�����ʼ���</td>
		<td><input name="email" type="email" size="25" value="<?=$profiles['email']?>"/></td>
	</tr>
	<tr>
		<td align="right">QQ�ţ�</td>
		<td><input name="qq" type="number" size="25" value="<?=$profiles['qq']?>"/></td>
	</tr>
	<tr>
		<td align="right"><font color="red">*</font> �ֻ��ţ�</td>
		<td><input name="mobile" type="number" size="11" value="<?=$profiles['mobile']?>" required/></td>
	</tr>
	<tr>
		<td align="right"><font color="red">*</font> �ŵ꣺</td>
		<td><input name="store" type="text" value="<?=$profiles['store']?>" required/></td>
	</tr>
	<tr>
		<td align="right"><font color="red">*</font> ��ַ��</td>
		<td><input name="address" type="text" value="<?=$profiles['address']?>" required/></td>
	</tr>
	<tr>
		<td align="right"><font color="red">*</font> �� �飺</td>
		<td><textarea name="note" rows="3" class="span6" required><?=$profiles['note']?></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="ȷ��" class="btn btn-danger" /> </td>
	</tr>
</table> 
</form> 
</body>
</html>