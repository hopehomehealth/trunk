<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
?> 
 


<div class="bar_title">
	<strong>�˻���ȫ</strong>
</div> 

<form id="myform" method="post" action="do?ac=passwd"> 
  <table width="100%" border="0" cellpadding="5" cellspacing="0" >
    <tr>
		<td width="120" align="right"> </td>
	    <td><h4>��������</h4></td>
	</tr>
	<tr>
		<td align="right">����ԭ���룺</td>
	    <td><input id="oldpassword" name="oldpassword" type="password" required></td>
	</tr>
	<tr>
		<td align="right">���������룺</td>
		<td><input id="newpassword" name="newpassword" type="password" required></td>
	</tr>
	<tr>
		<td align="right">ȷ�������룺</td>
		<td><input id="renewpassword" name="renewpassword" type="password" required></td>
	</tr>
	<tr>
	  <td align="right">&nbsp;</td>
	  <td><input type="submit" value="����" class="btn btn-info "/></td> 
	</tr>
  </table> 
</form>   