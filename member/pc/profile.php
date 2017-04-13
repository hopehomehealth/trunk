<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?> 
 
  

<div class="bar_title">
	<strong>个人资料</strong>
</div> 


<form id="myform" method="post" action="do?ac=profile"> 
  <table width="100%" > 
    <tr>
		<td width="100">用户名 </td>
	    <td height="40"><b style="color:red;font-size:18px"><?=$profile['account']?><b></td>
	</tr>
	<tr>
		<td >真实姓名 <font color="red">*</font> </td>
	    <td><input id="username" name="username" type="text" size="35"  class="span6" value="<?=$profile['username']?>" placeholder="真实姓名..." required></td>
	</tr>
	<tr>
		<td >昵 称</td>
		<td><input id="nickname" name="nickname" type="text" size="35" class="span6" value="<?=$profile['nickname']?>" placeholder="昵 称..."></td>
	</tr>
	<tr>
		<td >性 别 <font color="red">*</font> </td>
		<td height="30">  
		<input id="sex" name="sex" type="radio" value="男" <?if($profile['sex']=='男'){echo 'checked';}?> required> 男 
		<input id="sex" name="sex" type="radio" value="女" <?if($profile['sex']=='女'){echo 'checked';}?> required> 女 
		</td>
	</tr> 
	<tr>
		<td >出生日期 <font color="red">*</font> </td>
		<td><input id="birthday" name="birthday" type="date" size="35" class=" span6" value="<?=$profile['birthday']?>" placeholder="YYYY-MM-DD" placeholder="出生日期..." required></td>
	</tr>  
	<tr>
		<td >手机号 <font color="red">*</font> </td>
		<td><input id="mobile" name="mobile" type="text" size="35" class=" span6" pattern="^1[3-9]\d{9}$" value="<?=$profile['mobile']?>" maxlength="11" placeholder="手机号..." required></td>
	</tr>
	<tr>
		<td >固定电话</td>
		<td><input id="tel" name="tel" type="text" size="35" class=" span6" pattern="\d{3,4}-\d{7,8}|\d{3,4}-\d{7,8}-\d{2,5}" value="<?=$profile['tel']?>" placeholder="固定电话..." maxlength="20"></td>
	</tr>
	<tr>
		<td >QQ号</td>
		<td><input id="qq" name="qq" type="number" size="35" class=" span6" placeholder="QQ号..."  value="<?=$profile['qq']?>"></td>
	</tr> 
	<tr>
		<td >电子邮件 <font color="red">*</font> </td>
		<td><input id="email" name="email" type="email" size="35" placeholder="电子邮件..." class="span6 " value="<?=$profile['email']?>" required></td>
	</tr>
	<tr>
	  <td >&nbsp;</td>
	  <td><input type="submit" value="保 存" class="btn btn-info  "/></td> 
	</tr>
  </table> 
</form>   