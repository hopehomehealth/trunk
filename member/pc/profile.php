<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?> 
 
  

<div class="bar_title">
	<strong>��������</strong>
</div> 


<form id="myform" method="post" action="do?ac=profile"> 
  <table width="100%" > 
    <tr>
		<td width="100">�û��� </td>
	    <td height="40"><b style="color:red;font-size:18px"><?=$profile['account']?><b></td>
	</tr>
	<tr>
		<td >��ʵ���� <font color="red">*</font> </td>
	    <td><input id="username" name="username" type="text" size="35"  class="span6" value="<?=$profile['username']?>" placeholder="��ʵ����..." required></td>
	</tr>
	<tr>
		<td >�� ��</td>
		<td><input id="nickname" name="nickname" type="text" size="35" class="span6" value="<?=$profile['nickname']?>" placeholder="�� ��..."></td>
	</tr>
	<tr>
		<td >�� �� <font color="red">*</font> </td>
		<td height="30">  
		<input id="sex" name="sex" type="radio" value="��" <?if($profile['sex']=='��'){echo 'checked';}?> required> �� 
		<input id="sex" name="sex" type="radio" value="Ů" <?if($profile['sex']=='Ů'){echo 'checked';}?> required> Ů 
		</td>
	</tr> 
	<tr>
		<td >�������� <font color="red">*</font> </td>
		<td><input id="birthday" name="birthday" type="date" size="35" class=" span6" value="<?=$profile['birthday']?>" placeholder="YYYY-MM-DD" placeholder="��������..." required></td>
	</tr>  
	<tr>
		<td >�ֻ��� <font color="red">*</font> </td>
		<td><input id="mobile" name="mobile" type="text" size="35" class=" span6" pattern="^1[3-9]\d{9}$" value="<?=$profile['mobile']?>" maxlength="11" placeholder="�ֻ���..." required></td>
	</tr>
	<tr>
		<td >�̶��绰</td>
		<td><input id="tel" name="tel" type="text" size="35" class=" span6" pattern="\d{3,4}-\d{7,8}|\d{3,4}-\d{7,8}-\d{2,5}" value="<?=$profile['tel']?>" placeholder="�̶��绰..." maxlength="20"></td>
	</tr>
	<tr>
		<td >QQ��</td>
		<td><input id="qq" name="qq" type="number" size="35" class=" span6" placeholder="QQ��..."  value="<?=$profile['qq']?>"></td>
	</tr> 
	<tr>
		<td >�����ʼ� <font color="red">*</font> </td>
		<td><input id="email" name="email" type="email" size="35" placeholder="�����ʼ�..." class="span6 " value="<?=$profile['email']?>" required></td>
	</tr>
	<tr>
	  <td >&nbsp;</td>
	  <td><input type="submit" value="�� ��" class="btn btn-info  "/></td> 
	</tr>
  </table> 
</form>   