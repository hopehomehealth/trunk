<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="static/image/style.css" rel="stylesheet" type="text/css" /> 
<link href="static/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
 
</head>

<body>  
		<form target="frm" method="post" action="do.php?cmd=user_edit" >
			<input type="hidden" name="user_id" value="<?=req('user_id')?>"> 
			<table width="100%">
				<tr>
				<td align="right" width="150"> </td>
				<td><h4>�༭��Ա��Ϣ</h4></td>
			  </tr>
				<tr>
					<td align="right"> <font color="red">*</font> �û�����</td>
					<td><input name="account" type="text" id="account" class="span4" required pattern=".{5,100}" placeholder="�ֻ���/����..." value="<?=$detail['account']?>"/></td>
				</tr>
				<tr>
					<td align="right" ><font color="red">*</font> ���룺</td>
					<td><input name="password" type="password" id="password" class="span4" pattern=".{5,18}" placeholder="5-18λ�ַ���..."/> <em>����������˴�������</em> </td>
				</tr>
				<tr>
					<td align="right" ><font color="red">*</font> ��ʵ������</td>
					<td><input name="username" type="text" id="username" class="span4" required value="<?=$detail['username']?>"/></td>
				</tr>
				<tr>
					<td align="right" >��Ա���ţ�</td>
					<td><input name="vip_no" type="text" id="vip_no" class="span4" value="<?=$detail['vip_no']?>"/></td>
				</tr>
				<tr>
					<td align="right" ><font color="red">*</font> �Ա�</td>
					<td>
						<select name="sex" class="span4" required>
							<option value="��" <?if($detail['sex']=='��'){?>selected<?}?>>��</option>
							<option value="Ů" <?if($detail['sex']=='Ů'){?>selected<?}?>>Ů</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" >���գ�</td>
					<td><input name="birthday" type="date" id="birthday" class="span4" value="<?=$detail['birthday']?>"/></td>
				</tr>
				<tr>
					<td align="right" >���֤��</td>
					<td><input name="idcard" type="text" id="idcard" class="span4" pattern=".{15,18}" value="<?=$detail['idcard']?>"/></td>
				</tr>
				<tr>
					<td align="right" ><font color="red">*</font> �ֻ��ţ�</td>
					<td><input name="mobile" type="number" id="mobile" class="span4" required  pattern=".{11,11}" value="<?=$detail['mobile']?>"/></td>
				</tr>
				<tr>
					<td align="right" >QQ�ţ�</td>
					<td><input name="qq" type="number" id="qq" class="span4" pattern=".{5,15}" value="<?=$detail['qq']?>"/></td>
				</tr> 
				<tr>
					<td align="right" >�����ʼ���</td>
					<td><input name="email" type="email" id="email" class="span4" value="<?=$detail['email']?>"/></td>
				</tr> 
				<tr>
					<td align="right">��Ա�ȼ���</td>
					<td>  
					<select name="user_level" class="span4">
					<?
					if(notnull($user_level_list)){
						foreach ($user_level_list as $val){    	
					?>
						<option value="<?=$val['level_type']?>" <?if($val['level_type']==$detail['user_level']){?>selected<?}?> ><?=$val['level_name']?></option>
					<?
						}
					}
					?>
					</select>
					</td>
				</tr> 
				<tr>
					<td align="right">״̬��</td>
					<td><label class="checkbox inline"><input name="state" type="checkbox" id="state" value="1" <?if($detail['state']=='1'){?>checked<?}?> /> ����</label></td>
				</tr>
				<tr>
					<td></td>
					<td><br/><input type="submit" value="ȷ��" class="btn btn-info"></td>
				</tr>
			</table> 
		</form>   
</body>
</html>