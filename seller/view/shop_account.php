<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?>


<div class="bar_title">
	<strong>更改密码</strong> 
</div> 

 
			<form target="frm" method="post" action="do.php?cmd=shop_passwd"> 
				<table>
					<tr>
						<td align="right"><font color="red">*</font> 输入原密码：</td>
						<td><input name="srcpassword" type="password" id="srcpassword" size="15" required autocomplete="off"/></td>
					</tr>
					<tr>
						<td align="right"><font color="red">*</font> 输入新密码：</td>
						<td><input name="newpassword" type="password" id="newpassword" size="15" required autocomplete="off"/></td>
					</tr>
					<tr>
						<td align="right"><font color="red">*</font> 确认新密码：</td>
						<td><input name="repassword" type="password" id="repassword" size="15" required autocomplete="off"/></td>
					</tr>
					<tr>
						<td></td>
						<td>
						<input type="hidden" name="account_id" value="<?=$_COOKIE['CLOOTA_B2B2C_SHOP_UUID']?>">
						<input type="submit" value="确定" class="btn btn-danger" /> </td>
					</tr>
				</table>
			</form> 