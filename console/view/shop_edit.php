<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

$sql = "SELECT * FROM `t_user` WHERE `site_id`='$g_siteid' AND `shop_id`='".$detail['shop_id']."' AND `shop_id`>0 ";
$acc = $db->get_one($sql);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="static/image/style.css" rel="stylesheet" type="text/css" /> 
<link href="static/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
 
</head>
<body>   
	<form method="post" action="do.php?cmd=shop_edit" enctype="multipart/form-data" target="frm">
		<input type="hidden" name="shop_id" value="<?=req('shop_id')?>">
		<input type="hidden" name="user_id" value="<?=$acc['user_id']?>">
		<table width="100%"> 
			  <tr>
				<td align="right" width="150"> </td>
				<td><h4>�༭�̼���Ϣ</h4></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> �̼����ƣ�</td>
				<td><input name="shop_name" type="text" id="shop_name" class="span4" value="<?=$detail['shop_name']?>" required/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> �û�����</td>
				<td><input name="account" type="text" id="account" class="span4" value="<?=$detail['account']?>" disabled/></td>
			  </tr> 
			  <tr>
				<td align="right"><font color="red">*</font> ���룺</td>
				<td><input name="password" type="password" id="password" class="span4" /> <em>����������˴�������</em></td>
			  </tr> 
			  <tr>
				<td align="right">Ӷ����ʣ�</td>
				<td>
				<input name="fee_rate" type="number" id="fee_rate" class="span4" value="<?=$detail['fee_rate']?>" /> <strong>%</strong></td>
			  </tr>   
			  <tr>
				<td align="right"><font color="red">*</font> �������֤��</td>
				<td><input name="cert_code" type="text" id="cert_code" class="span4" value="<?=$detail['cert_code']?>" required/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> Ӫҵ��Χ��</td>
				<td><input name="cert_scope" type="text" id="cert_scope" class="span4" value="<?=$detail['cert_scope']?>" required/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> ��������ǰ׺��</td>
				<td><input name="shop_domain" type="text" id="shop_domain" class="span4" value="<?=$detail['shop_domain']?>" required/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> �̼�LOGO��</td>
				<td>
				<?if($detail['shop_ico']!=''){?>
				<div style="margin-bottom:5px"><img src="/upfiles/<?=$g_siteid?>/<?=$detail['shop_ico']?>" style="height:30px"  class="img-polaroid"></div>
				<?}?>
				<input name="shop_ico" type="file" id="shop_ico" value="<?=$detail['shop_ico']?>"/></td>
			  </tr> 
			  <tr>
				<td align="right"><font color="red">*</font> �ͷ����ߣ�</td>
				<td><input name="hotline" type="text" id="hotline" class="span4" value="<?=$detail['hotline']?>" required/></td>
			  </tr> 
			  <tr>
				<td align="right"><font color="red">*</font> ��ϵ�ˣ�</td>
				<td><input name="linker" type="text" id="linker" class="span4" value="<?=$detail['linker']?>" required/></td>
			  </tr>
			  <tr>
				<td align="right"><font color="red">*</font> �ֻ����룺</td>
				<td><input name="mobile" type="number" id="mobile" class="span4" value="<?=$detail['mobile']?>" required/></td>
			  </tr>
			  <tr>
				<td align="right"> QQ���룺</td>
				<td><input name="qq" type="number" id="qq" class="span4" value="<?=$detail['qq']?>" /></td>
			  </tr>
			  <tr>
				<td align="right"> ������룺</td>
				<td><input name="fax" type="text" id="fax" class="span4" value="<?=$detail['fax']?>" /></td>
			  </tr>
			  <tr>
				<td align="right"> �̶��绰��</td>
				<td><input name="tel" type="text" id="tel" class="span4" value="<?=$detail['tel']?>" /></td>
			  </tr>
			  <tr>
				<td align="right"> �������֣�</td>
				<td><input name="auth_score" type="number" id="auth_score" step="0.1" min="1.0" max="5.0" class="span4" value="<?=$detail['auth_score']?>" />1.0-5.0��</td>
			  </tr>
			  <tr>
				<td align="right"> ���õȼ���</td>
				<td><input name="auth_level" type="number" id="auth_level" min="1" max="10" class="span4" value="<?=$detail['auth_level']?>" />1-10��</td>
			  </tr>
			  <tr>
				<td align="right">������ţ�</td>
				<td>
				<input name="order_id" type="number" id="order_id" class="span4" value="<?=$detail['order_id']?>" /></td>
			  </tr>
			  <tr>
				<td align="right">�̼�������</td>
				<td><textarea name="shop_note" rows="3" cols="20" class="span6"><?=$detail['shop_note']?></textarea></td>
			  </tr>
			  <tr>
				<td align="right"> ��Ʒ��ˣ�</td>
				<td><label><input name="is_verify_goods" type="checkbox" id="is_verify_goods" value="1" <?if($detail['is_verify_goods']=='1'){?>checked<?}?>/> ƽ̨��˲�Ʒ</label></td>
			  </tr>
			  <tr>
				<td align="right">�Ƿ����ã�</td>
				<td>
				<label><input name="state" type="checkbox" id="state" value="1" <?if($detail['state']=='1'){?>checked<?}?> /> �����̼��˻�</label></td>
			  </tr>
			  <tr>
				<td></td>
				<td><input type="submit" value="ȷ��" class="btn btn-danger" /></td>
			  </tr>   
		</table>
	</form> 
</body>
</html>