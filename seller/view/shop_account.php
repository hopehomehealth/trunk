<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>


<div class="bar_title">
	<strong>��������</strong> 
</div> 

 
			<form target="frm" method="post" action="do.php?cmd=shop_passwd"> 
				<table>
					<tr>
						<td align="right"><font color="red">*</font> ����ԭ���룺</td>
						<td><input name="srcpassword" type="password" id="srcpassword" size="15" required autocomplete="off"/></td>
					</tr>
					<tr>
						<td align="right"><font color="red">*</font> ���������룺</td>
						<td><input name="newpassword" type="password" id="newpassword" size="15" required autocomplete="off"/></td>
					</tr>
					<tr>
						<td align="right"><font color="red">*</font> ȷ�������룺</td>
						<td><input name="repassword" type="password" id="repassword" size="15" required autocomplete="off"/></td>
					</tr>
					<tr>
						<td></td>
						<td>
						<input type="hidden" name="account_id" value="<?=$_COOKIE['CLOOTA_B2B2C_SHOP_UUID']?>">
						<input type="submit" value="ȷ��" class="btn btn-danger" /> </td>
					</tr>
				</table>
			</form> 