<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?> 
 


<div class="bar_title">
	<strong>账户安全</strong>
</div> 

<form id="myform" method="post" action="do?ac=passwd"> 
  <table width="100%" border="0" cellpadding="5" cellspacing="0" >
    <tr>
		<td width="120" align="right"> </td>
	    <td><h4>更改密码</h4></td>
	</tr>
	<tr>
		<td align="right">输入原密码：</td>
	    <td><input id="oldpassword" name="oldpassword" type="password" required></td>
	</tr>
	<tr>
		<td align="right">输入新密码：</td>
		<td><input id="newpassword" name="newpassword" type="password" required></td>
	</tr>
	<tr>
		<td align="right">确认新密码：</td>
		<td><input id="renewpassword" name="renewpassword" type="password" required></td>
	</tr>
	<tr>
	  <td align="right">&nbsp;</td>
	  <td><input type="submit" value="更新" class="btn btn-info "/></td> 
	</tr>
  </table> 
</form>   